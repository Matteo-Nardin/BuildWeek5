<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Lista utenti') }}
        </h2>
    </x-slot>


    <main class="container mt-5 shadow p-3 bg-white">
        <h2 class="h2">Gestisci utenti!</h2>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome utente</th>
                    <th scope="col">Email</th>
                    <th scope="col">Ruolo</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($userList as $user)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->user_role}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $userList->links() }}

    </main>

</x-app-layout>