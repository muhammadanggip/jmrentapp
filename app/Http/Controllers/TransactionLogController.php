<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionLogController extends Controller
{
    public function index()
    {
        $rentals = Rental::with(['returns', 'car', 'user'])->get();

        $transactionLogs = [];

        foreach ($rentals as $rental) {
            if ($rental->car && $rental->user) {
                $transactionLogs[] = [
                    'transaction_type' => 'Rental',
                    'user' => $rental->user->name, 
                    'car' => $rental->car->brand . ' ' . $rental->car->model,
                    'license_plate' => $rental->car->license_plate,
                    'start_date' => $rental->start_date,
                    'end_date' => $rental->end_date,
                    'total_cost' => $rental->total_cost ?? 0, 
                ];
            } else {
                $transactionLogs[] = [
                    'transaction_type' => 'Rental',
                    'user' => $rental->user ? $rental->user->name : 'User information not available',
                    'car' => $rental->car ? $rental->car->brand . ' ' . $rental->car->model : 'Car information not available',
                    'license_plate' => $rental->car->license_plate,
                    'start_date' => $rental->start_date,
                    'end_date' => $rental->end_date,
                    'total_cost' => $rental->total_cost ?? 0,
                ];
            }

            foreach ($rental->returns as $return) {
                if ($return->rental && $return->rental->car) {
                    $transactionLogs[] = [
                        'transaction_type' => 'Return',
                        'user' => $return->rental->user ? $return->rental->user->name : 'User information not available',
                        'car' => $return->rental->car->brand . ' ' . $return->rental->car->model,
                        'license_plate' => $rental->car->license_plate,
                        'return_date' => $return->return_date,
                        'total_cost' => $return->total_cost,
                    ];
                } else {
                    $transactionLogs[] = [
                        'transaction_type' => 'Return',
                        'user' => 'User information not available',
                        'car' => 'Car information not available',
                        'license_plate' => 'Car information not available',
                        'return_date' => $return->return_date,
                        'total_cost' => $return->total_cost,
                    ];
                }
            }
        }

        return view('transaction_logs.index', compact('transactionLogs'));
    }
}
