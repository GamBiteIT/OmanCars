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
    public function index()
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cars $cars)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cars $cars)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cars $cars)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cars $cars)
    {
        //
    }
}
