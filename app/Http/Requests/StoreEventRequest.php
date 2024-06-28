<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:150|min:2',
            'meeting_room_id' => 'required|exists:meeting_rooms,id',
            'description' => 'required|min:5',
            'start_date' => 'required|date|after:yesterday',
            'end_date' => 'required|date|after:yesterday',
            'cover_image' => 'nullable|image|max:1024',
        ];
    }

    // FUNZIONE CHE RESTITUISCE I MESSAGGI PERSONALIZZATI PER GLI ERRORI
    public function messages()
    {
        return [
            'title.required' => 'Il nome dell\'evento è obbligatorio.',
            'title.max' => 'Il nome dell\'evento deve contere al massimo 150 caratteri.',
            'title.min' => 'Il nome dell\'evento deve contere almeno 2 caratteri.',
            'meeting_room_id.required' => 'L\'evento deve essere associato ad una sala meeting.',
            'meeting_room_id.exists' => 'La sala meeting che stai cercando non esiste.',
            'description.required' => 'La descrizione è obbligatoria.',
            'description.min' => 'La descrizione deve contenere almeno 5 caratteri.',
            'start_date.required' => 'La data di inizio è obbligatoria.',
            'start_date.date' => 'La data di inizio deve essere in formato data.',
            'start_date.after' => 'La data di inizio deve essere uguale o successiva alla data odierna.',
            'end_date.required' => 'La data di fine è obbligatoria.',
            'end_date.date' => 'La data di fine deve essere in formato data.',
            'end_date.after' => 'La data di fine deve essere uguale o successiva alla data di inizio dell\evento.',
            'cover_image.image' => 'Il file selezionato deve essere una immagine in formato valido (.jph, .jpeg, .webp, .png)',
            'cover_image.max' => 'Il file selezionato supera le dimensioni massime di 1024 Kb. Riprova.',
        ];
    }
}
