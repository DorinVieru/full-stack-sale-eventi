@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 d-flex justify-content-center align-items-center">
            <h1 class="fw-bold color-title">Modifica la Sala Meeting cod: {{ $room->id }}</h1>  
        </div>
        <div class="col-7 mt-5">
            {{-- Condizione per ciclare gli errori da mostrare --}}
             @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
             @endif
             {{-- Condizione per l'errore della duplicazione del titolo --}}
             @if ($error_message != '')
                <div class="alert alert-danger">
                    {{ $error_message }}
                </div> 
             @endif
             {{-- FORM --}}
            <form action="{{ route('admin.rooms.update', $room->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="control-label">Nome Sala Meeting</label>
                    <input type="text" name="name" class="form-control @error ('name') is-invalid @enderror" id="name" placeholder="Nome Sala Meeting" required value="{{ old('name') ?? $room->name }}">
                    @error ('name')
                        <div class="text-danger fw-semibold">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="control-label">Descrizione</label>
                    <textarea name="description" class="form-control @error ('description') is-invalid @enderror" id="description" rows="5" placeholder="Descrizione" required>{{ old('description') ?? $room->description }}</textarea>
                    @error ('description')
                        <div class="text-danger fw-semibold">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="num_of_places_available" class="control-label">Capienza massima</label>
                    <input type="text" name="num_of_places_available" class="form-control @error ('num_of_places_available') is-invalid @enderror" id="num_of_places_available" placeholder="Capienza massima" required value="{{ old('num_of_places_available') ?? $room->num_of_places_available }}">
                    @error ('num_of_places_available')
                        <div class="text-danger fw-semibold">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    @if ($room->cover_image != null)
                        <img id="preview-image" class="rounded-3 mb-3" src="{{ asset('/storage/' . $room->cover_image) }}" alt="{{ $room->name }}" width="250">
                    @else
                        <img id="preview-image" class="rounded-3" src="" alt="" width="250">
                        <h6 class="fw-bold">Immagine di copertina non impostata</h6>
                    @endif

                    <input type="file" name="cover_image" class="form-control @error ('cover_image') is-invalid @enderror" id="cover_image" placeholder="Immagine di copertina" value="{{ old('cover_image') ?? $room->cover_image }}">
                    @error ('cover_image')
                        <div class="text-danger fw-semibold">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-center mb-5">
                    <button type="submit" class="btn btn-warning px-5 fs-4">Modifica Sala Meeting</button>
                </div>
            </form>
        </div>
        <div class="col-10 text-center mt-5">
            <a href="/admin/rooms" > <button class="btn btn-secondary">Torna indietro</button></a>
        </div>
    </div>
</div>
@endsection
