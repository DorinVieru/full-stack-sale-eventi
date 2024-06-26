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
                            {{-- TIPO DI PROGETTO --}}
                            {{-- <li class="list-group-item"><strong>Tipo di progetto:</strong> {{ $room->type != null ? $room->type->name : 'Non assegnato' }}</li> --}}
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
                        {{-- DELETE BUTTON --}}
                        {{-- <form action="{{ route('admin.rooms.destroy', ['room' => $room->id]) }}" method="POST" onsubmit="return confirm('Sei sicuro di voler cancellare {{ $room->title }}?')">
                        @csrf
                        @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Cancella il progetto</button>
                        </form> --}}
                        {{-- MODALE --}}
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
