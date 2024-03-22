<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book Detail') }}
        </h2>
    </x-slot>

    <main class="container mt-5 shadow p-3 bg-white">
        <h2 class="h2">Our amazing library!</h2>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Book Title</th>
                    <th scope="col">Author</th>
                    <th scope="col">Aviable Copies</th>
                    <th scope="col">Description</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td>{{$book->title}}</td>
                        <td>{{$book->author}}</td>
                        <td>{{$book->copies_available}}</td>
                        <td>{{$book->description}}</td>
                        <td>
                            @if ($user && !$reservation)
                                <form method="POST" action="{{ route('reservation.store') }}">
                                    @csrf
                                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                                    <button type="submit" class="btn btn-primary">Prenota</button>
                                </form>
                            @elseif ($reservation)
                                <p>Libro già prenotato.</p>
                            @elseif ($reservation->status == 'cancellata')
                                <form method="POST" action="{{ route('reservation.update') }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="reservation_id" value="{{ $book->id }}">
                                    <button type="submit" class="btn btn-primary">Prenota</button>
                                </form>
                            @else
                                <p>Please login to book this course.</p>
                            @endif
                        </td>
                        <td>
                            <form method="post" action="/book/{{$book->id}}">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="copies_available" value="{{ $book->copies_available-1 }}">
                                <button type="submit" class="btn btn-primary">chat</button>
                            </form>
                        </td>
                    </tr>
            </tbody>
        </table>
    </main>


</x-app-layout>


