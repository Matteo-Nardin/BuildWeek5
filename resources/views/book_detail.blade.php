<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dettagli libro') }}
        </h2>
    </x-slot>

    <main class="container mt-5 shadow p-3 bg-white">
        <a href="/book"><i class="bi bi-arrow-left"></i></a>
        <h2 class="h2">Dettaglio: {{ $book->title }}!</h2>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Titolo libro</th>
                    <th scope="col">Autore</th>
                    <th scope="col">Copie disponibili</th>
                    <th scope="col">Descrizione</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td>{{$book->title}}</td>
                        <td>{{$book->author}}</td>
                        <td class="text-center">{{$book->copies_available}}</td>
                        <td>{{$book->description}}</td>
                        <td>
                            @if (!$reservation)
                                <form method="POST" action="{{ route('reservation.store') }}">
                                    @csrf
                                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                                    <button type="submit" class="btn btn-primary">Prenota</button>
                                </form>
                            @elseif ($reservation)
                                @if($reservation->status == 'effettuata')
                                    <td><form method="POST" action="{{ route('reservation.update', ['reservation' => $reservation->id]) }}">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="reservation" value="{{ $reservation->id }}">
                                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                                        <button type="submit" class="btn btn-danger">Annulla prenotazione</button>
                                    </form><td>
                                @else
                                <form method="POST" action="{{ route('reservation.update', ['reservation' => $reservation->id]) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="reservation" value="{{ $reservation->id }}">
                                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                                    <button type="submit" class="btn btn-primary">Prenota</button>
                                </form>
                                @endif
                            @endif
                        </td>
                    </tr>
            </tbody>
        </table>
    </main>


</x-app-layout>


