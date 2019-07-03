<?php

namespace App\Services;


class BillTransactions
{
    protected $transactions;
    
    /**
     * BillTransactions constructor.
     */
    public function __construct()
    {
        $this->transactions = array();
    }


    /**
     * @param array $bill
     * @return array $this->transactions
     */
    public function calcEqual($bill)
    {
        $participants = $bill->billParticipantsSumExpenses->toArray();
        $howManyParticipants = count($participants);
        $sumOfExpensesInBill = 0;

        usort($participants, function($a, $b) {
            return $a['amount'] <=> $b['amount'];
        });


        for($i = 0; $i < $howManyParticipants; $i++) {
            $sumOfExpensesInBill += $participants[$i]['amount'];
        }

        $averageExpensePerParticipant = $sumOfExpensesInBill / $howManyParticipants;

        $j = 0;
        for ($i = $howManyParticipants - 1; $i >= 0; $i--) { 
            if ($i != $howManyParticipants - 1) {
                if ($amountShouldGet > 0) {
                    $i++;
                } else {
                    $amountShouldGet = $participants[$i]['amount'] - $averageExpensePerParticipant;
                }
                if ($amountShouldPay == 0) {
                    $amountShouldPay = $averageExpensePerParticipant - $participants[$j]['amount'];   
                } 
            } else {
                $amountShouldPay = $averageExpensePerParticipant - $participants[$j]['amount'];
                $amountShouldGet = $participants[$i]['amount'] - $averageExpensePerParticipant;
            }
            

            if ($amountShouldPay <= 0) {
                break;
            }

            if ($amountShouldGet <= 0) {
                continue;
            } else {
                if ($amountShouldGet >= $amountShouldPay) {
                    array_push($this->transactions, [
                        'bill_participant_id_from' => $participants[$j]['id'],
                        'bill_participant_id_to' => $participants[$i]['id'],
                        'name_from' => $participants[$j]['name'],
                        'name_to' => $participants[$i]['name'],
                        'amount' => $amountShouldPay
                    ]);
    
                    $amountShouldGet -= $amountShouldPay;
                    $amountShouldPay = 0;
                    $j++;

                } else {
                    array_push($this->transactions, [
                        'bill_participant_id_from' => $participants[$j]['id'],
                        'bill_participant_id_to' => $participants[$i]['id'],
                        'name_from' => $participants[$j]['name'],
                        'name_to' => $participants[$i]['name'],
                        'amount' => $amountShouldGet
                    ]);

                    $amountShouldPay -= $amountShouldGet;
                    $amountShouldGet = 0;
                }
            }
        }
        $bill->billTransactions()->createMany($this->transactions);
        return $this->transactions;


    }

}
