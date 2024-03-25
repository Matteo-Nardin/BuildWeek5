<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Reservation;
use Exception;
use Illuminate\Http\Request; // Per `Request`
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log; // Per `Log`

use Illuminate\Support\Facades\Response; // Opzionale, solo se vuoi usare Response::json(), ma `response()` helper è disponibile globalmente


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //libri con le prenotazioni formato API
        //return Book::with('bookReservation')->get();

        //solo i libri formati API
        //return Book::get();


        

        //libri passati alla vista book, tramite varibalile bookList
        $bookList = Book::paginate(8);
        return view('books' , ['bookList' => $bookList]);

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
    public function store(StoreBookRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        $user = auth()->user();
        $reservation = $book->bookReservation()->where('user_id', $user->id)->first();
        return view('book_detail', ['book' => $book, 'user' => $user, 'reservation' => $reservation]);

        // $book=Book::with('bookReservation')->get();
        // return view('book_detail' , ['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        //bisogna fare -1 alle copie disponibili
        $user_id = auth()->user()->id;
        //$copies_available->decremet('copies_available');

        $book['copies_available'] = $request->copies_available;

        $book->update();

        return redirect()->back()->with('success', 'Reservation has been made successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }

    public function reserveBook(Request $request, $bookId) {
        // Avvia una transazione
        DB::transaction(function () use ($bookId) {
            $book = Book::findOrFail($bookId);

            if ($book->copies_available <= 0) {
                // Gestire la situazione in cui non ci sono più copie disponibili
                throw new Exception('Non ci sono più copie disponibili per questo libro.');
            }

            // Decrementa il numero di copie disponibili
            $book->decrement('copies_available');

            // Crea la prenotazione
            $reservation = new Reservation;
            $reservation->user_id = auth()->id();
            $reservation->book_id = $bookId;
            $reservation->status = 'reserved';
            $reservation->save();

            // Altre logiche...
        });

        // Restituisci una risposta di successo
        return back()->with('success', 'Libro prenotato con successo!');
    }



    public function search(Request $request) {
        $query = $request->input('query');
        Log::info("Query ricevuta: {$query}"); // Aggiunto per debug
    
        if (!empty($query)) {
            $books = Book::where('title', 'LIKE', "%{$query}%")
                         ->orWhere('author', 'LIKE', "%{$query}%")
                         ->get();
        } else {
            $books = []; // Restituisci un array vuoto se non c'è una query
        }
        
        Log::info("Libri trovati: " . json_encode($books));
        
        return response()->json($books); // Aggiungi questa linea
    }
    

}
