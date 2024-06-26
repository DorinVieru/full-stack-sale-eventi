<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\MeetingRoom;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::orderByDesc('id')->get();

        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // RECUPERO LE SALE MEETING PER POTERLE INSERIRE NELLA SELECT
        $rooms = MeetingRoom::all();
        
        // Genero una condizione per mostrarmi nell'edit e nel create un messaggio di errore personalizzato per la duplicazione di un titolo
        $error_message = '';
        if (!empty($request->all())) {
            $messages = $request->all();
            $error_message = $messages['error_message'];
        }

        return view('admin.events.create', compact('rooms', 'error_message'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request, Event $event)
    {
        $form_rooms = $request->all();

        // Controlla se ci sono eventi sovrapposti
        $overlappingEvents = Event::where('meeting_room_id', $form_rooms['meeting_room_id'])
        ->where(function ($query) use ($form_rooms) {
            $query->whereBetween('start_date', [$form_rooms['start_date'], $form_rooms['end_date']])
            ->orWhereBetween('end_date', [$form_rooms['start_date'], $form_rooms['end_date']])
            ->orWhereRaw('? BETWEEN start_date AND end_date', [$form_rooms['start_date']])
            ->orWhereRaw('? BETWEEN start_date AND end_date', [$form_rooms['end_date']]);
        })->exists();

        if ($overlappingEvents) {
            $error_message = 'La sala meeting è già prenotata nelle date selezionate.';
            return redirect()->route('admin.events.create', compact('event', 'error_message'));
        }

        // Creare una query per la modifica di un evento con lo stesso titolo
        $exists = Event::where('title', 'LIKE', $form_rooms['title'])->where('id', '!=', $event->id)->get();
        // Condizione che segue la medisma logica per duplicazione titolo Sala Meeting.
        if (count($exists) > 0) {
            $error_message = 'Hai inserito un titolo già assegnato ad un altro Evento.';
            return redirect()->route('admin.events.create', compact('event', 'error_message'));
        }

        // CREO LA NUOVA ISTANZA PER EVENTO PER SALVARLO NEL DATABASE
        $event = new Event();

        // VERIFICO SE LA RICHIESTA CONTIENE IL CAMPO cover_image
        if ($request->hasFile('cover_image')) {
            // Eseguo l'upload del file e recupero il path
            $path = Storage::disk('public')->put('event_image', $form_rooms['cover_image']);
            $form_rooms['cover_image'] = $path;
        }

        // LO SLUG LO RECUPERO IN UN SECONDO MOMENTO, IN QUANTO NON LO PASSO NEL FORM
        $form_rooms['slug'] = Str::slug($form_rooms['title'], '-');
        // RECUPERO I DATI TRAMITE IL FILL
        $event->fill($form_rooms);

        // SALVO I DATI
        $event->save();

        // FACCIO IL REDIRECT ALLA PAGINA SHOW 
        return redirect()->route('admin.events.show', ['event' => $event]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return view('admin.events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event, Request $request)
    {
        // Genero una condizione per mostrarmi nell'edit e nel create un messaggio di errore personalizzato per la duplicazione di un titolo
        $error_message = '';
        if (!empty($request->all())) {
            $messages = $request->all();
            $error_message = $messages['error_message'];
        }

        // RECUPERO LE SALE MEETING
        $rooms = MeetingRoom::all();

        return view('admin.events.edit', compact('event', 'rooms', 'error_message'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $form_rooms = $request->all();

        // Creare una query per la modifica di un Evento con lo stesso titolo
        $exists = Event::where('title', 'LIKE', $form_rooms['title'])->where('id', '!=', $event->id)->get();
        // Condizione che segue la medisma logica per duplicazione titolo Sala Meeting.
        if (count($exists) > 0) {
            $error_message = 'Hai inserito un titolo già presente in un altro Evento.';
            return redirect()->route('admin.events.edit', compact('event', 'error_message'));
        }

        // VERIFICO SE LA RICHIESTA CONTIENE IL CAMPO cover_image
        if ($request->hasFile('cover_image')) {
            // Se la Sala Meeting ha un'immagine
            if ($event->cover_image != null) {
                Storage::disk('public')->delete($event->cover_image);
            }

            // Eseguo l'upload del file e recupero il path
            $path = Storage::disk('public')->put('event_image', $form_rooms['cover_image']);
            $form_rooms['cover_image'] = $path;
        }

        // LO SLUG LO RECUPERO IN UN SECONDO MOMENTO, IN QUANTO NON LO PASSO NEL FORM
        $form_rooms['slug'] = Str::slug($form_rooms['title'], '-');

        // SALVO I DATI
        $event->update($form_rooms);

        // FACCIO IL REDIRECT ALLA PAGINA SHOW 
        return redirect()->route('admin.events.show', ['event' => $event]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        // CANCELLO L'IMMAGINE
        if ($event->cover_image != null) {
            Storage::disk('public')->delete($event->cover_image);
        }

        $event->delete();

        return redirect()->route('admin.events.index');
    }
}
