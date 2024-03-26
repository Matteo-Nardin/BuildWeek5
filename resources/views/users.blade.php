<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Lista utenti') }}
        </h2>
    </x-slot>


    <main class="container mt-5 shadow p-3 bg-white">
        <h2 class="h2">Gestisci utenti!</h2>

        <a href="/user/create" class="btn btn-primary">Aggiungi utente</a>

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
                @php
                    $adminCount = $userList->where('user_role', 'admin')->count();
                @endphp

                @foreach ($userList as $user)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->user_role}}</td>
                        <td class="">
                            @if($user->user_role == "admin")
                                @if($adminCount > 1)
                                <form method="POST" action="{{ route('user.update', ['user' => $user->id]) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    <button type="submit" class="btn btn-danger">Rendi utente normale</button>
                                </form>
                                @endif
                            @elseif($user->user_role == "user")
                                <div class="d-flex">
                                    <form method="POST" action="{{ route('user.update', ['user' => $user->id]) }}">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                        <button type="submit" class="btn btn-primary">Rendi admin</button>
                                    </form>
                                    <form method="POST" action="{{ route('user.destroy', ['user' => $user->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger ms-5"><i class="bi bi-trash text-light"></i></button>
                                    </form>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $userList->links() }}

    </main>

</x-app-layout>