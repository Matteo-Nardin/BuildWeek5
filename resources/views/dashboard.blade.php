<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            @if($bookReservations->count() > 0)
    <div class="list-group">
        @foreach($bookReservations as $reservation)
                    <a href="/book/{{ $reservation->reservationBook->id }}" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h4 class="mb-1 fw-bold">{{ $reservation->reservationBook->title }}</h4>
                            <small>Data Prenotazione: {{ $reservation->created_at->format('d/m/Y') }}</small>
                        </div>
                        <div class="d-flex w-100 justify-content-between">
                            <small>Stato: <span class="fw-bold"> {{ $reservation->status }} </span> </small>
                        </div>
                        
                    </a>
                @endforeach
            </div>
        @else
            <h5 class="text-center m-5 h5">Non ci sono prenotazioni da mostrare...</h5>
        @endif
            </div>
        </div>
    </div>
</x-app-layout>
