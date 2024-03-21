<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books</title>
</head>
<body> -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book List') }}
        </h2>
    </x-slot>

    <main class="container mt-5 shadow p-3 bg-white">
        <h2 class="h2">Our amazing library!</h2>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Book Title</th>
                    <th scope="col">Author</th>
                    <th scope="col">Aviable Copies</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookList as $book)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{$book->title}}</td>
                        <td>{{$book->author}}</td>
                        <td>{{$book->copies_available}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>


</x-app-layout>
</body>
</html>
