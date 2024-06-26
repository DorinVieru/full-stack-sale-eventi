<?php

namespace App\Http\Controllers;

use App\Models\MeetingRoom;
use App\Models\Event;
use App\Http\Requests\StoreMeetingRoomRequest;
use App\Http\Requests\UpdateMeetingRoomRequest;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MeetingRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $meeting_rooms = MeetingRoom::orderByDesc('id')->get();

        return view('admin.rooms.index', compact('meeting_rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Genero una condizione per mostrarmi nell'edit e nel create un messaggio di errore personalizzato per la duplicazione di un titolo
        $error_message = '';
        if (!empty($request->all())) {
            $messages = $request->all();
            $error_message = $messages['error_message'];
        }

        return view('admin.rooms.create', compact('error_message'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMeetingRoomRequest $request, MeetingRoom $room)
    {
        $form_rooms = $request->all();

        // Creare una query per la modifica di una Sala Meeting con lo stesso titolo
        $exists = MeetingRoom::where('name', 'LIKE', $form_rooms['name'])->where('id', '!=', $room->id)->get();
        // Condizione che mi permette di modificare un progetto mantenendo lo stesso titolo. Ma se cambio titolo e ne inserisco uno già presente in un altro progetto, mi mostra l'errore impostato.
        if (count($exists) > 0) {
            $error_message = 'Hai inserito un titolo già assegnato ad un altra Sala Meeting.';
            return redirect()->route('admin.rooms.create', compact('room', 'error_message'));
        }

        // CREO LA NUOVA ISTANZA PER SALA MEETING PER SALVARLO NEL DATABASE
        $room = new MeetingRoom();

        // VERIFICO SE LA RICHIESTA CONTIENE IL CAMPO cover_image
        if ($request->hasFile('cover_image')) {
            // Eseguo l'upload del file e recupero il path
            $path = Storage::disk('public')->put('room_image', $form_rooms['cover_image']);
            $form_rooms['cover_image'] = $path;
        }

        // LO SLUG LO RECUPERO IN UN SECONDO MOMENTO, IN QUANTO NON LO PASSO NEL FORM
        $form_rooms['slug'] = Str::slug($form_rooms['name'], '-');
        // RECUPERO I DATI TRAMITE IL FILL
        $room->fill($form_rooms);

        // SALVO I DATI
        $room->save();

        // FACCIO IL REDIRECT ALLA PAGINA SHOW 
        return redirect()->route('admin.rooms.show', ['room' => $room]);
    }

    /**
     * Display the specified resource.
     */
    public function show(MeetingRoom $room)
    {
        return view('admin.rooms.show', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MeetingRoom $room, Request $request)
    {
        // Genero una condizione per mostrarmi nell'edit e nel create un messaggio di errore personalizzato per la duplicazione di un titolo
        $error_message = '';
        if (!empty($request->all())) {
            $messages = $request->all();
            $error_message = $messages['error_message'];
        }

        return view('admin.rooms.edit', compact('room', 'error_message'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMeetingRoomRequest $request, MeetingRoom $room)
    {
        $form_rooms = $request->all();

        // Creare una query per la modifica di una Sala Meeting con lo stesso titolo
        $exists = MeetingRoom::where('name', 'LIKE', $form_rooms['name'])->where('id', '!=', $room->id)->get();
        // Condizione che mi permette di modificare una Sala Meeting mantenendo lo stesso titolo. Ma se cambio titolo e ne inserisco uno già presente in un'altra Sala Meeting, mi mostra l'errore impostato.
        if (count($exists) > 0) {
            $error_message = 'Hai inserito un titolo già presente in un altra Sala Meeting.';
            return redirect()->route('admin.rooms.edit', compact('room', 'error_message'));
        }

        // VERIFICO SE LA RICHIESTA CONTIENE IL CAMPO cover_image
        if ($request->hasFile('cover_image')) {
            // Se la Sala Meeting ha un'immagine
            if ($room->cover_image != null) {
                Storage::disk('public')->delete($room->cover_image);
            }

            // Eseguo l'upload del file e recupero il path
            $path = Storage::disk('public')->put('room_image', $form_rooms['cover_image']);
            $form_rooms['cover_image'] = $path;
        }

        // LO SLUG LO RECUPERO IN UN SECONDO MOMENTO, IN QUANTO NON LO PASSO NEL FORM
        $form_rooms['slug'] = Str::slug($form_rooms['name'], '-');

        // SALVO I DATI
        $room->update($form_rooms);

        // FACCIO IL REDIRECT ALLA PAGINA SHOW 
        return redirect()->route('admin.rooms.show', ['room' => $room]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MeetingRoom $room)
    {
        // CANCELLO L'IMMAGINE
        if ($room->cover_image != null) {
            Storage::disk('public')->delete($room->cover_image);
        }

        $room->delete();

        return redirect()->route('admin.rooms.index');
    }
}
