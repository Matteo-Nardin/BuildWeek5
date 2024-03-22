<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Reservation;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->user_role === 'admin') {
        $reservation = Reservation::with('reservationBook', 'reservationUser')->get();
        return view("viewReservation", ['reservation' => $reservation]);
        } else {
            return redirect()->route('book.index')->with('error', 'You are not authorized to access this page.');
        }
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
    public function store(StoreReservationRequest $request)
    {
        $user_id = auth()->user()->id;

        $reservation = new Reservation();
        $reservation->status = 'effettuata';
        $reservation->book_id = $request->book_id;
        $reservation->user_id = $user_id;
        $reservation->save();

        return redirect()->back()->with('success', 'Reservation has been made successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {
        $user_id = auth()->user()->id;

        $reservation['reservation_id'] = $request->status = 'effettuata';

        $reservation->update();

        return redirect()->back()->with('success', 'Reservation has been made successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
