<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Lista utenti') }}
        </h2>
    </x-slot>


    <main class="container mt-5 shadow p-3 bg-white">
        <h2 class="h2">Aggiungi utente!</h2>
        <form method="POST" action="/user">
            @csrf
            <div class="mb-3">
                <label for="exampleInputName" class="form-label">Nome</label>
                <input type="text" name="name" class="form-control" id="exampleInputName" aria-describedby="nameHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="exampleRole" class="form-label">Ruolo utente <span class="text-danger">*</span></label>
                <select name="user_role" class="form-control" id="exampleRole">
                    <option value="user">Utente Normale</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Crea</button>
        </form>
    </main>

</x-app-layout>