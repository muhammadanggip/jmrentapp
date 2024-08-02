<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Car;
use App\Models\Rental;
use App\Models\RentalReturn;
use App\Models\User;
use Carbon\Carbon;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Dashboard Admin
        $user = Auth::user();
        $userCount = User::count();
        $carCount = Car::count();
        $availableCarCount = Car::where('available', true)->count();
        $rentedCarCount = Car::where('available', false)->count();
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $monthlyRevenue = RentalReturn::whereMonth('return_date', $currentMonth)
            ->whereYear('return_date', $currentYear)
            ->sum('total_cost');

        $latestCars = Car::orderBy('created_at', 'desc')->limit(3)->get();
        $latestRentals = Rental::orderBy('created_at', 'desc')->limit(3)->with('car')->get();

        // Dashboard User
    
        $lastRental = Rental::where('user_id', Auth::id())
        ->orderBy('created_at', 'desc')
        ->first();

        switch ($user->role) {
            case 'admin':
                return view('dashboard_admin', compact('userCount', 'carCount','monthlyRevenue', 'availableCarCount','rentedCarCount','latestCars','latestRentals'));
            case 'user':
                return view('dashboard_user', compact('lastRental'));
            default:
                return abort(403, 'Unauthorized action.');
        }
    }

    public function root(Request $request)
    {
        if (view()->exists($request->path())) {
            return view($request->path());
        } else {
            return abort(404);
        }
    }
}
