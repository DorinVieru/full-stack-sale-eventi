@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 d-flex justify-content-center align-items-center">
            <h1 class="fw-bold color-title">Aggiungi una Sala Meeting!</h1>  
        </div>
        <div class="col-7 mt-5">
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
            <form action="{{ route('admin.rooms.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <input type="text" name="name" class="form-control @error ('name') is-invalid @enderror" id="name" placeholder="Nome Sala Meeting" required value="{{ old('name') }}">
                    @error ('name')
                        <div class="text-danger fw-semibold">{{ $message }}</div>
                    @enderror
                        <div class="text-danger fw-semibold">{{ $error_message }}</div>
                </div>
                    <div class="mb-3">
                    <textarea name="description" class="form-control @error ('description') is-invalid @enderror" id="description" rows="5" placeholder="Descrizione" required>{{ old('description') }}</textarea>
                    @error ('description')
                        <div class="text-danger fw-semibold">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="text" name="num_of_places_available" class="form-control @error ('num_of_places_available') is-invalid @enderror" id="num_of_places_available" placeholder="Capienza massima" required value="{{ old('num_of_places_available') }}">
                    @error ('num_of_places_available')
                        <div class="text-danger fw-semibold">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <div id="preview" class="mb-2">
                        <img id="preview-image" class="rounded-3" src="" alt="" width="250">
                    </div>
                    <input type="file" name="cover_image" class="form-control @error ('cover_image') is-invalid @enderror" id="cover_image" placeholder="Immagine di copertina" value="{{ old('cover_image') }}">
                    @error ('cover_image')
                        <div class="text-danger fw-semibold">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-center mt-4 mb-5">
                    <button type="submit" class="btn btn-primary px-5 fs-4">Crea Ora!</button>
                </div>
            </form>
        </div>
        <div class="col-10 text-center mt-5">
            <a href="/admin/rooms" > <button class="btn btn-secondary">Torna indietro</button></a>
        </div>
    </div>
</div>
@endsection
