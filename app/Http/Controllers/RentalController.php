<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Rental;
use App\Models\RentalReturn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;



class RentalController extends Controller
{

    public function index()
    {
        $cars = Car::where('available', true)->get();
        // $rentals = Rental::with(['returns', 'car', 'user'])->get();
        $rentals = Rental::with(['returns', 'car', 'user'])
            ->where('user_id', Auth::id())
            ->get();


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

        return view('rentals.index', compact('cars', 'transactionLogs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        $car = Car::find($request->car_id);
        $rented = Rental::where('car_id', $car->id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                    ->orWhereBetween('end_date', [$request->start_date, $request->end_date])
                    ->orWhere(function ($query) use ($request) {
                        $query->where('start_date', '<=', $request->start_date)
                            ->where('end_date', '>=', $request->end_date);
                    });
            })
            ->exists();

        if ($rented) {
            return redirect()->back()->withErrors(['Car is already rented during the selected period.']);
        }

        Rental::create([
            'car_id' => $request->car_id,
            'user_id' => Auth::id(),
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        $car->update(['available' => false]);

        return redirect()->route('rentals.index');
    }

    public function return(Request $request)
    {
        $request->validate([
            'license_plate' => 'required|string',
            'return_date' => 'required|date|after_or_equal:today',
        ]);

        $car = Car::where('license_plate', $request->license_plate)->first();
        if (!$car) {
            return redirect()->back()->withErrors(['Car with this license plate does not exist.']);
        }

        $rental = Rental::where('car_id', $car->id)
            ->where('user_id', Auth::id())
            ->whereDoesntHave('returns')
            ->first();

        if (!$rental) {
            return redirect()->back()->withErrors(['Car is not rented by you or has already been returned.']);
        }

        $start_date = Carbon::parse($rental->start_date);
        $end_date = Carbon::parse($request->return_date);
        $days = $start_date->diffInDays($end_date);

        $total_cost = $days * $car->rental_rate_per_day;

        RentalReturn::create([
            'rental_id' => $rental->id,
            'return_date' => $request->return_date,
            'total_cost' => $total_cost,
        ]);

        $car->update(['available' => true]);

        return redirect()->route('rentals.index');
    }

    public function getRentalRate(Request $request)
    {
        $licensePlate = $request->license_plate;
        $car = Car::where('license_plate', $licensePlate)->first();

        if ($car) {
            $rental = Rental::where('car_id', $car->id)
                ->where('user_id', Auth::id())
                ->whereDoesntHave('returns')
                ->first();

            if ($rental) {
                return response()->json([
                    'success' => true,
                    'rental_rate_per_day' => $car->rental_rate_per_day,
                    'start_date' => $rental->start_date,
                ]);
            }
        }

        return response()->json(['success' => false]);
    }
}
