@extends('layouts.admin')

@section('content')
{{-- MAIN --}}
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-12 d-flex justify-content-center">
                <div class="card my-card" style="width: 44rem;">
                    <img src="{{ $room->cover_image != null ?  asset('/storage/' . $room->cover_image) : asset('/img/no-image.jpg') }}" alt="{{ $room->name }}" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title text-capitalize fw-bold color-title">{{ $room->name}}</h5>
                        <p class="card-text">{{ $room->description }}</p>
                    </div>
                        <ul class="list-group list-group-flush">
                            {{-- EVENTO ASSEGNATO --}}
                            <li class="list-group-item"> <strong>Eventi in programma</strong> 
                                @foreach ($room->events as $item)
                                    <div class="list-group">
                                        <a href="{{ route('admin.events.show', ['event' => $item->id]) }}" class="list-group-item list-group-item-action">
                                            <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-2 fw-bold">{{ $item->title }}</h5>
                                            <small>Iniazia il: {{ \Carbon\Carbon::parse($item->start_date)->format('d/m/Y') }}</small>
                                            </div>
                                            <p class="mb-1"> Stato evento:
                                                @if (\Carbon\Carbon::now()->setTimezone('Europe/Rome') >= $item->start_date && \Carbon\Carbon::now()->setTimezone('Europe/Rome') <= $item->end_date)
                                                    <span class="text-success fw-bold"><i class="fa-solid fa-user-tie"></i> In corso </span>
                                                @elseif (\Carbon\Carbon::now()->setTimezone('Europe/Rome') > $item->end_date)
                                                    <span class="text-danger fw-bold"><i class="fa-solid fa-ban"></i> Finito </span>
                                                @elseif (\Carbon\Carbon::now()->setTimezone('Europe/Rome') < $item->start_date)
                                                    <span class="text-warning fw-bold"><i class="fa-solid fa-hourglass-start"></i> In programma </span>
                                                @endif
                                            </p>
                                            <small>Termina il: {{ \Carbon\Carbon::parse($item->end_date)->format('d/m/Y') }}</small>
                                        </a>
                                    </div>
                                @endforeach
                            </li>
                            {{-- POSTI DISPONIBILI --}}
                            <li class="list-group-item"><strong><i class="fa-solid fa-chair"></i> Capienza Sala:</strong> {{ $room->num_of_places_available }} posti a sedere</li>
                            {{-- SLUG --}}
                            <li class="list-group-item"><strong><i class="fa-solid fa-globe"></i> Slug:</strong> {{ $room->slug }}</li>
                        </ul>
                    <div class="card-body">
                        <a href="{{ $room->cover_image !== null ? asset('/storage/' . $room->cover_image) : asset('/img/another-image.jpg') }}" target="_blank" class="btn btn-success"><i class="fa-solid fa-download"></i> Scarica l'immagine</a>
                        {{-- EDIT BUTTON --}}
                        <a href="{{ route('admin.rooms.edit', ['room' => $room['id']]) }}" class="text-decoration-none">
                            <button type="button" class="btn btn-warning mx-2"><i class="fas fa-edit"></i> Modifica Sala Meeting</button>
                        </a>
                        {{-- DELETE MODALE --}}
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal_room_delete-{{ $room->id }}"><i class="fas fa-trash"></i> Cancella Sala Meeting</button> 
                    </div>  
                </div>
            </div>
            <div class="col-12 text-center mt-5">
                <a href="/admin/rooms" > <button class="btn btn-secondary ms-5"><i class="fa-solid fa-door-open"></i> Torna indietro</button></a>
            </div>
        </div>
</div>
{{-- POP-UP MODALE --}}
@include('admin.rooms.modal_delete')
@endsection
