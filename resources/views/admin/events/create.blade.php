@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 d-flex justify-content-center align-items-center">
            <h1 class="fw-bold color-title">Aggiungi un nuovo Evento!</h1>  
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
            <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <input type="text" name="title" class="form-control @error ('title') is-invalid @enderror" id="title" placeholder="Titolo Evento" required value="{{ old('title') }}">
                    @error ('title')
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
                    <div id="preview" class="mb-2">
                        <img id="preview-image" class="rounded-3" src="" alt="" width="250">
                    </div>
                    <input type="file" name="cover_image" class="form-control @error ('cover_image') is-invalid @enderror" id="cover_image" placeholder="Immagine di copertina" value="{{ old('cover_image') }}">
                    @error ('cover_image')
                        <div class="text-danger fw-semibold">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <input type="date" name="start_date" class="form-control @error ('start_date') is-invalid @enderror" id="startDate" placeholder="Data Inizio" required value="{{ old('start_date') }}">
                        @error ('start_date')
                            <div class="text-danger fw-semibold">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <input type="date" name="end_date" class="form-control @error ('end_date') is-invalid @enderror" id="endDate" placeholder="Data Fine" required value="{{ old('end_date') }}">
                        @error ('end_date')
                            <div class="text-danger fw-semibold">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                {{-- CERCA SALE MEETING DISPONIBILI --}}
                <div class="mb-3">
                    <input type="hidden" name="meetingRoomId" id="meetingRoomId">
                    <input type="text" name="meetingRoomName" class="form-control mb-2" id="meetingRoomName" placeholder="Sala Meeting Selezionata" readonly>
                    <button type="button" id="searchRoomBtn" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#meetingRoomModal" disabled>Cerca Sale Meeting Disponibili</button>
                </div>

                <div class="d-flex justify-content-center mt-4 mb-5">
                    <button type="submit" class="btn btn-primary px-5 fs-4" id="createEventBtn" style="display: none">Crea Ora!</button>
                </div>
            </form>
        </div>
        <div class="col-10 text-center mt-5">
            <a href="/admin/events" > <button class="btn btn-secondary">Torna indietro</button></a>
        </div>
    </div>
</div>

<!-- Modale Rooms -->
@include('admin.events.modal_rooms')

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

{{-- SCRIPT PER MODALE, DATATABLE E GESTIONE DATE --}}
<script>
    $(document).ready(function() {
        const searchRoomBtn = $('#searchRoomBtn');
        const meetingRoomList = $('#meeting-room-list');
        const meetingRoomIdInput = $('#meetingRoomId');
        const meetingRoomNameInput = $('#meetingRoomName');
        const createEventBtn = $('#createEventBtn');

        // Funzione per abilitare o disabilitare pulsante ricerca
        function enableSearchRoomButton() {
            const startDate = $('#startDate').val();
            const endDate = $('#endDate').val();
            if (startDate && endDate) {
                searchRoomBtn.prop('disabled', false);
                resetMeetingRoomSelection();
            } else {
                searchRoomBtn.prop('disabled', true);
            }
        }

        // Funzione per resettare pulsante di ricerca al cambio di data
        function resetMeetingRoomSelection() {
            meetingRoomNameInput.val('');
            meetingRoomIdInput.val('');
            createEventBtn.css('display', 'none');
        }

        $('#startDate').on('change', enableSearchRoomButton);
        $('#endDate').on('change', enableSearchRoomButton);

        searchRoomBtn.on('click', function() {
            const startDate = $('#startDate').val();
            const endDate = $('#endDate').val();

            axios.get('/admin/events/available-rooms', {
                params: {
                    start_date: startDate,
                    end_date: endDate
                }
            })
            .then(response => {
                const data = response.data;
                meetingRoomList.empty();
                data.forEach(room => {
                    const row = `
                        <tr>
                            <td class="fw-bold">${room.id}</td>
                            <td class="text-capitalize">${room.name}</td>
                            <td>${room.description.substring(0, 20)}...</td>
                            <td>${room.num_of_places_available}</td>
                            <td><img src="${room.cover_image ? `/storage/${room.cover_image}` : '/img/no-image.jpg'}" alt="${room.name}" class="rounded-3"></td>
                            <td>
                                <button type="button" class="btn btn-primary select-room-btn" data-room-id="${room.id}" data-room-name="${room.name}">Seleziona</button>
                            </td>
                        </tr>
                    `;
                    meetingRoomList.append(row);
                });

                // Inizializza DataTables
                $('#table-rooms-modal').DataTable({
                    responsive: true,
                    language: {
                        url: '/it-IT.json'
                    },
                    "columns": [
                        {
                            "sortable": true
                        },
                        {
                            "sortable": true
                        },
                        {
                            "sortable": true
                        },
                        {
                            "sortable": true
                        },
                        {
                            "sortable": false
                        },
                        {
                            "sortable": false
                        },
                    ]
                });

                // Aggiungi event listener ai pulsanti di selezione
                $('.select-room-btn').on('click', function() {
                    const roomId = $(this).data('room-id');
                    const roomName = $(this).data('room-name');
                    meetingRoomIdInput.val(roomId);
                    meetingRoomNameInput.val(roomName);
                    createEventBtn.css('display', 'block');
                    $('#meetingRoomModal').modal('hide');
                });
            })
            .catch(error => console.error('Errore:', error));
        });
        // Imposta le date minime per gli input di data
        const todayDate = new Date().toISOString().split('T')[0];
        $('#startDate').attr('min', todayDate);
        $('#endDate').attr('min', todayDate);
    });
</script>

@endsection
