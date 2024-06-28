@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 d-flex justify-content-center align-items-center">
            <h1 class="fw-bold color-title">Eventi in programma</h1>
            <a href="{{ route('admin.events.create') }}" > <button class="btn btn-primary ms-5">Aggiungi un nuovo evento</button></a>
            
        </div>
        <div class="col-12 mt-5 table-responsive">
            <table id="table-project" class="table table-striped border align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>ID</th>
                        <th>Sala</th>
                        <th>Titolo</th>
                        <th>Descrizione</th>
                        <th>Data Inizio</th>
                        <th>Data Fine</th>
                        <th>IMG</th>
                        <th>Stato</th>
                        <th>TOOLS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $event)
                        <tr>
                            <td class="fw-bold">{{ $event->id }}</td>
                            <td> <a href="{{ route('admin.rooms.show', ['room' => $event->meeting_room_id]) }}"> {{ $event->meeting_room_id }} </a> </td>
                            <td class="text-capitalize">{{ $event->title }}</td>
                            <td class="">{{ Str::limit($event->description, 20, '...') }}</td>
                            <td>{{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($event->end_date)->format('d/m/Y') }}</td>
                            <td><img src="{{ $event->cover_image != null ?  asset('/storage/' . $event->cover_image) : asset('/img/no-image.jpg') }}" alt="{{ $event->name }}" class="rounded-3"></td>
                            <td>
                                @if (\Carbon\Carbon::now()->setTimezone('Europe/Rome') >= $event->start_date && \Carbon\Carbon::now()->setTimezone('Europe/Rome') <= $event->end_date)
                                    <span class="text-success fw-bold fs-4"><i class="fa-solid fa-user-tie"></i></span>
                                @elseif (\Carbon\Carbon::now()->setTimezone('Europe/Rome') > $event->end_date)
                                    <span class="text-danger fw-bold fs-4"><i class="fa-solid fa-ban"></i></span>
                                @elseif (\Carbon\Carbon::now()->setTimezone('Europe/Rome') < $event->start_date)
                                    <span class="text-warning fw-bold fs-4"><i class="fa-solid fa-hourglass-start"></i></span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex">
                                    {{-- VIEW BUTTON --}}
                                    <a href="{{ route('admin.events.show', ['event' => $event->id]) }}" class="btn btn-sm square btn-primary" title="Visualizza Sala Meeting"><i class="fas fa-eye"></i></a>
                                    {{-- EDIT BUTTON --}}
                                    <a href="{{ route('admin.events.edit', ['event' => $event->id]) }}" class="btn btn-sm square btn-warning mx-2" title="Modifica Sala Meeting"><i class="fas fa-edit"></i></a>
                                    {{-- DELETE MODALE --}}
                                    <button class="btn btn-sm square btn-danger" data-bs-toggle="modal" data-bs-target="#modal_event_delete-{{ $event->id }}" title="Elimina Sala Meeting"><i class="fas fa-trash"></i></button> 
                                </div>
                            </td>
                        </tr>
                        {{-- POP-UP MODALE --}}
                        @include('admin.events.modal_delete')
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
