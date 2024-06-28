@extends('layouts.admin')

@section('content')
{{-- MAIN --}}
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-12 d-flex justify-content-center">
                <div class="card my-card" style="width: 44rem;">
                    <img src="{{ $event->cover_image != null ?  asset('/storage/' . $event->cover_image) : asset('/img/no-image.jpg') }}" alt="{{ $event->title }}" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title text-capitalize fw-bold color-title">{{ $event->title}}</h5>
                        <p class="card-text">{{ $event->description }}</p>
                    </div>
                        <ul class="list-group list-group-flush">
                            {{-- SALA ASSEGNATA --}}
                            <li class="list-group-item"><strong><i class="fa-solid fa-chair"></i> Sala assegnata:</strong> <a href="{{ route('admin.rooms.show', ['room' => $event->meeting_room_id]) }}"> {{ $event->meeting_room_id }} </a> </li>
                            {{-- DATA INIZIO E FINE --}}
                            <li class="list-group-item"><strong><i class="fa-solid fa-calendar-check"></i> Data di inizio:</strong> {{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y') }}</li>
                            <li class="list-group-item"><strong><i class="fa-solid fa-calendar-xmark"></i> Data fine:</strong> {{ \Carbon\Carbon::parse($event->end_date)->format('d/m/Y') }}</li>
                            {{-- DISPONIBILITA' SALA --}}
                            <li class="list-group-item"> <strong>Stato evento:</strong>
                                @if (\Carbon\Carbon::now()->setTimezone('Europe/Rome') >= $event->start_date && \Carbon\Carbon::now()->setTimezone('Europe/Rome') <= $event->end_date)
                                    <span class="text-success fw-bold"><i class="fa-solid fa-user-tie"></i> In corso </span>
                                @elseif (\Carbon\Carbon::now()->setTimezone('Europe/Rome') > $event->end_date)
                                    <span class="text-danger fw-bold"><i class="fa-solid fa-ban"></i> Finito </span>
                                @elseif (\Carbon\Carbon::now()->setTimezone('Europe/Rome') < $event->start_date)
                                    <span class="text-warning fw-bold"><i class="fa-solid fa-hourglass-start"></i> In programma </span>
                                @endif
                            </li>
                            {{-- SLUG --}}
                            <li class="list-group-item"><strong><i class="fa-solid fa-globe"></i> Slug:</strong> {{ $event->slug }}</li>
                        </ul>
                    <div class="card-body">
                        <a href="{{ $event->cover_image !== null ? asset('/storage/' . $event->cover_image) : asset('/img/another-image.jpg') }}" target="_blank" class="btn btn-success"><i class="fa-solid fa-download"></i> Scarica l'immagine</a>
                        {{-- EDIT BUTTON --}}
                        <a href="{{ route('admin.events.edit', ['event' => $event['id']]) }}" class="text-decoration-none">
                            <button type="button" class="btn btn-warning mx-2"><i class="fas fa-edit"></i> Modifica Sala Meeting</button>
                        </a>
                        {{-- DELETE MODALE --}}
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal_event_delete-{{ $event->id }}"><i class="fas fa-trash"></i> Cancella Sala Meeting</button> 
                    </div>  
                </div>
            </div>
            <div class="col-12 text-center mt-5">
                <a href="/admin/events" > <button class="btn btn-secondary ms-5"><i class="fa-solid fa-door-open"></i> Torna indietro</button></a>
            </div>
        </div>
</div>
{{-- POP-UP MODALE --}}
@include('admin.events.modal_delete')
@endsection
