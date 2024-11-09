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
                    'name' => $car->Name,
                    'registration_number' => $car->registration_number,
                    'color' => $car->color,
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
            'Name' => ['required', 'max:50'],
            'color' => ['required', 'max:10'],
            'registration_number' => ['required', 'max:50', Rule::unique('cars')],
            'photo' => ['nullable', 'image'],
        ]);

        Auth::user()->account->cars()->create([
            'Name' => Request::get('Name'),
            'registration_number' => Request::get('registration_number'),
            'color' => Request::get('color'),
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
                'Name' => $car->Name,
                'color' => $car->color,
                'registration_number' => $car->registration_number,
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
            'Name' => ['required', 'max:50'],
            'color' => ['required', 'max:50'],
            'registration_number' => ['required', 'max:50', Rule::unique('cars')->ignore($car->id)],
            'photo' => ['nullable', 'image'],
        ]);

        $car->update(Request::only('Name', 'color', 'registration_number'));

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
