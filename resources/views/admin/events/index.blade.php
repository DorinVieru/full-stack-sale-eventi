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
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Sala Assegnata</th>
                        <th>Titolo</th>
                        <th>Descrizione</th>
                        <th>Data Inizio</th>
                        <th>Data Fine</th>
                        <th>IMG</th>
                        <th>TOOLS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $event)
                        <tr>
                            <td class="fw-bold">{{ $event->id }}</td>
                            <td class="text-capitalize">{{ $event->meeting_room_id }}</td>
                            <td class="text-capitalize">{{ $event->title }}</td>
                            <td class="">{{ Str::limit($event->description, 20, '...') }}</td>
                            <td>{{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($event->end_date)->format('d/m/Y') }}</td>
                            <td><img src="{{ $event->cover_image != null ?  asset('/storage/' . $event->cover_image) : asset('/img/no-image.jpg') }}" alt="{{ $event->name }}" class="w-25 rounded-3"></td>
                            <td>
                                <div class="d-flex">
                                    {{-- VIEW BUTTON --}}
                                    <a href="{{ route('admin.events.show', ['event' => $event->id]) }}" class="btn btn-sm square btn-primary" title="Visualizza Sala Meeting"><i class="fas fa-eye"></i></a>
                                    {{-- EDIT BUTTON --}}
                                    <a href="{{ route('admin.events.edit', ['event' => $event->id]) }}" class="btn btn-sm square btn-warning mx-2" title="Modifica Sala Meeting"><i class="fas fa-edit"></i></a>
                                    {{-- DELETE BUTTON --}}
                                    {{-- <form action="{{ route('admin.projects.destroy', ['project' => $project->id]) }}" method="POST" onsubmit="return confirm('Sei sicuro di voler cancellare {{ $project->title }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm square btn-danger"><i class="fas fa-trash"></i></button>
                                    </form> --}}

                                    {{-- MODALE --}}
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
