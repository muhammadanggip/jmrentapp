<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        return view('cars.index', compact('cars'));
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'brand' => ['required', 'max:50'],
            'model' => ['required', 'max:50'],
            'license_plate' => ['required', 'max:20', 'unique:cars,license_plate'],
            'rental_rate_per_day' => ['required', 'numeric'],
            'available' => ['required', 'boolean']
        ]);

        Car::create($attributes);

        return redirect()->route('cars.index');
    }

    public function edit(Car $car)
    {
        return response()->json($car);
    }

    public function update(Request $request, Car $car)
    {
        $attributes = $request->validate([
            'brand' => ['required', 'max:50'],
            'model' => ['required', 'max:50'],
            'license_plate' => ['required', 'max:20', 'unique:cars,license_plate,' . $car->id],
            'rental_rate_per_day' => ['required', 'numeric'],
            'available' => ['required', 'boolean']
        ]);

        $car->update($attributes);

        return redirect()->route('cars.index');
    }

    public function destroy(Car $car)
    {
        $car->delete();

        return redirect()->route('cars.index');
    }
}
