@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 d-flex justify-content-center align-items-center">
            <h1 class="fw-bold color-title">Sale Meeting</h1>
            <a href="{{ route('admin.rooms.create') }}" > <button class="btn btn-primary ms-5">Aggiungi una nuova Sala Meeting</button></a>
            
        </div>
        <div class="col-12 mt-5 table-responsive">
            <table id="table-project" class="table table-striped border align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Descrizione</th>
                        <th>Capienza</th>
                        <th>IMG</th>
                        <th>TOOLS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($meeting_rooms as $room)
                        <tr>
                            <td class="fw-bold">{{ $room->id }}</td>
                            <td class="text-capitalize">{{ $room->name }}</td>
                            <td class="">{{ Str::limit($room->description, 20, '...') }}</td>
                            <td>{{ $room->num_of_places_available }}</td>
                            <td><img src="{{ $room->cover_image != null ?  asset('/storage/' . $room->cover_image) : asset('/img/no-image.jpg') }}" alt="{{ $room->name }}" class="w-25 rounded-3"></td>
                            <td>
                                <div class="d-flex">
                                    {{-- VIEW BUTTON --}}
                                    <a href="{{ route('admin.rooms.show', ['room' => $room->id]) }}" class="btn btn-sm square btn-primary" title="Visualizza Sala Meeting"><i class="fas fa-eye"></i></a>
                                    {{-- EDIT BUTTON --}}
                                    <a href="{{ route('admin.rooms.edit', ['room' => $room->id]) }}" class="btn btn-sm square btn-warning mx-2" title="Modifica Sala Meeting"><i class="fas fa-edit"></i></a>
                                    {{-- DELETE BUTTON --}}
                                    {{-- <form action="{{ route('admin.projects.destroy', ['project' => $project->id]) }}" method="POST" onsubmit="return confirm('Sei sicuro di voler cancellare {{ $project->title }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm square btn-danger"><i class="fas fa-trash"></i></button>
                                    </form> --}}

                                    {{-- MODALE --}}
                                    <button class="btn btn-sm square btn-danger" data-bs-toggle="modal" data-bs-target="#modal_room_delete-{{ $room->id }}" title="Elimina Sala Meeting"><i class="fas fa-trash"></i></button> 
                                </div>
                            </td>
                        </tr>
                        {{-- POP-UP MODALE --}}
                        @include('admin.rooms.modal_delete')
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
