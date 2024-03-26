<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    public function index() {
        $userId = Auth::id(); // Recupera l'utente loggato
        $bookReservations = Reservation::with('reservationUser', 'reservationBook')
                            ->where('user_id', '=', $userId)
                            ->get();
    
        return view('dashboard', compact('bookReservations'));
    }
}
