<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : Response
    {
        return Inertia::render('Cars/Index', [
            'filters' => Request::all('search'),
            'cars' => Auth::user()->account->cars()
                ->orderByName()
                ->filter(Request::only('search'))
                ->get()
                ->transform(fn ($car) => [
                    'id' => $car->id,
                    'brand' => $car->brand,
                    'model' => $car->model,
                    'registration_number' => $car->registration_number,
                    'color' => $car->color,
                    'year'=>$car->year,
                    'price_per_day'=>$car->price_per_day,
                    'price_per_week'=>$car->price_per_week,
                    'price_per_month'=>$car->price_per_month,
                    'km_day'=>$car->km_day,
                    'km_week'=>$car->km_week,
                    'km_month'=>$car->km_month,
                    'rent_out_price'=>$car->rent_out_price,
                    'photo' => $car->photo_path ? URL::route('image', ['path' => $car->photo_path, 'w' => 50, 'h' => 40, 'fit' => 'crop']) : null,

                ]),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Cars/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store() : RedirectResponse
    {
        Request::validate([
            'brand' => ['required', 'max:50'],
            'model' => ['required', 'max:50'],
            'color' => ['required', 'max:10'],
            'registration_number' => ['required', 'max:50', Rule::unique('cars')],
            'year' => ['required', 'integer', 'between:2010,2025'],
            'price_per_day' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'price_per_week' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'price_per_month' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'km_day' => ['required', 'numeric', 'min:0', 'regex:/^\d+(\.\d{1,2})?$/'],
            'km_week' => ['required', 'numeric', 'min:0', 'regex:/^\d+(\.\d{1,2})?$/'],
            'km_month' => ['required', 'numeric', 'min:0', 'regex:/^\d+(\.\d{1,2})?$/'],
            'rent_out_price' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'photo' => ['nullable', 'image'],
        ]);

        Auth::user()->account->cars()->create([
            'brand' => Request::get('brand'),
            'model' => Request::get('model'),
            'registration_number' => Request::get('registration_number'),
            'color' => Request::get('color'),
            'year' => Request::get('year'),
            'price_per_day' => Request::get('price_per_day'),
            'price_per_week' => Request::get('price_per_week'),
            'price_per_month' => Request::get('price_per_month'),
            'km_day' => Request::get('km_day'),
            'km_week' => Request::get('km_week'),
            'km_month' => Request::get('km_month'),
            'rent_out_price' => Request::get('rent_out_price'),
            'photo_path' => Request::file('photo') ? Request::file('photo')->store('cars') : null,
        ]);

        return Redirect::route('cars')->with('success', 'Car created.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cars $car) :Response
    {
        return Inertia::render('Cars/Edit', [
            'car' => [
                'id' => $car->id,
                'brand' => $car->brand,
                'model' => $car->model,
                'color' => $car->color,
                'registration_number' => $car->registration_number,
                'year' => $car->year,
                'price_per_day' => $car->price_per_day,
                'price_per_week' => $car->price_per_week,
                'price_per_month' => $car->price_per_month,
                'km_day' => $car->km_day,
                'km_week' => $car->km_week,
                'km_month' => $car->km_month,
                'rent_out_price' => $car->rent_out_price,
                'photo' => $car->photo_path ? URL::route('image', ['path' => $car->photo_path, 'fit' => 'crop']) : null,
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Cars $car) : RedirectResponse
    {
        Request::validate([
            'brand' => ['required', 'max:50'],
            'model' => ['required', 'max:50'],
            'color' => ['required', 'max:50'],
            'registration_number' => ['required', 'max:50', Rule::unique('cars')->ignore($car->id)],
            'year' => ['required', 'integer', 'between:2010,2025'],
            'price_per_day' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'price_per_week' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'price_per_month' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'km_day' => ['required', 'numeric', 'min:0', 'regex:/^\d+(\.\d{1,2})?$/'],
            'km_week' => ['required', 'numeric', 'min:0', 'regex:/^\d+(\.\d{1,2})?$/'],
            'km_month' => ['required', 'numeric', 'min:0', 'regex:/^\d+(\.\d{1,2})?$/'],
            'rent_out_price' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'photo' => ['nullable', 'image'],
        ]);

        $car->update(Request::only('Name', 'color', 'registration_number','year','price_per_day','price_per_week','price_per_month','km_day','km_week','km_month','rent_out_price'));

        if (Request::file('photo')) {
            $car->update(['photo_path' => Request::file('photo')->store('cars')]);
        }

        return Redirect::back()->with('success', 'Car updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cars $cars)
    {
        //
    }
}
