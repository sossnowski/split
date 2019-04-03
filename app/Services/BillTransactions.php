<?php

namespace App\Services;

use App\Repositories\BillParticipantRepository;
use Log;

class BillTransactions
{
    protected $billParticipantRepository;
    protected $transactions;
    
    /**
     * BillTransactions constructor.
     * @param BillParticipantRepository $billParticipantRepository
     */
    public function __construct(BillParticipantRepository $billParticipantRepository)
    {
        $this->billParticipantRepository = $billParticipantRepository;
        $this->transactions = array();
    }


    /**
     * @param integer $id
     * @return array $this->transactions
     */
    public function calcEqual($id)
    {
        $participants = $this->billParticipantRepository->getParticipants($id);
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

            if ($amountShouldGet == 0) {
                continue;
            } else {
                if ($amountShouldGet >= $amountShouldPay) {
                    array_push($this->transactions, [
                        'bill_participant_id_from' => $participants[$j]['id'],
                        'bill_participant_id_to' => $participants[$i]['id'],
                        'amount' => $amountShouldPay
                    ]);
    
                    $amountShouldGet -= $amountShouldPay;
                    $amountShouldPay = 0;
                    $j++;

                } else {
                    array_push($this->transactions, [
                        'bill_participant_id_from' => $participants[$j]['id'],
                        'bill_participant_id_to' => $participants[$i]['id'],
                        'amount' => $amountShouldGet
                    ]);

                    $amountShouldPay -= $amountShouldGet;
                    $amountShouldGet = 0;
                }
            }
        }
        return $this->transactions;

        
    }

}