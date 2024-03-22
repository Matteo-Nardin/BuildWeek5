<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Prenotazioni') }}
        </h2>
    </x-slot>

    <main class="container mt-5 shadow p-3 bg-white">
        <h2 class="h2">Accept, cancel or reject reservation!</h2>
        
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Book Title</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservation as $res)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $res->reservationBook->title }}</td>
                        <td>{{ $res->reservationUser->name }}</td>
                        <td>{{ $res->status }}</td>
                        <td><form method="POST" action="/reservation/{{$res->id}}}">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="reservation" value="{{ $res->id }}">
                                <input type="hidden" name="book_id" value="{{ $res->reservationBook->id }}">
                                <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                            </form><td>
                        <td>
                        <form method="POST" action="{{ route('reservation.destroy', $res->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Sei sicuro di voler eliminare definitivamente questa prenotazione?')">!Destroy!</button>
                            </form>
                        </td>
                        </tr>
                @endforeach
            </tbody>
        </table>
    </main>
    
</x-app-layout>
