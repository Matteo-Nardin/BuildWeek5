<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Lista libri') }}
        </h2>
    </x-slot>

    <section>

    </section>

    <main class="container mt-5 shadow p-3 bg-white">
        <h2 class="h2">Esplora la libreria!</h2>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Titolo Libro</th>
                    <th scope="col">Autore</th>
                    <th scope="col" style="text-align: center;">Copie disponibili</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookList as $book)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{$book->title}}</td>
                        <td>{{$book->author}}</td>
                        <td class="text-center">{{$book->copies_available}}</td>
                        <td><a href="/book/{{$book->id}}"><i class="bi bi-ticket-detailed"></i></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $bookList->links() }}
    </main>


</x-app-layout>

