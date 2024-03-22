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
        $reservation = Reservation::with('reservationBook', 'reservationUser')->paginate(4);
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
        $book = Book::find($request->book_id);

        if ($book->copies_available > 0) {
        $reservation = new Reservation();
        $reservation->status = 'effettuata';
        $reservation->book_id = $book->id;
        $reservation->user_id = $user_id;
        $reservation->save();

        $book->decrement('copies_available');

        return redirect()->back()->with('success', 'Reservation has been made successfully.');

        } else {
            return redirect()->back()->with('error', 'No copies available for reservation.');
        }
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

        $book = Book::find($request->book_id);

        if($reservation->status == 'cancellata') {

            $reservation->status = 'effettuata';
            $reservation->save();
            $book->decrement('copies_available');

        } else {

            $reservation->status = 'cancellata';
            $reservation->save();
            $book->increment('copies_available');

        }
        return redirect()->back()->with('success', 'Reservation has been made successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
{
    // Assicurati che l'utente abbia il diritto di cancellare la prenotazione
    if (Auth::id() == $reservation->user_id || Auth::user()->user_role === 'admin') {
        $book = Book::find($reservation->book_id);
        $book->increment('copies_available');
        $reservation->delete();

        return redirect()->back()->with('success', 'Reservation has been successfully deleted.');
    } else {
        return redirect()->back()->with('error', 'You do not have permission to delete this reservation.');
    }
}
}
