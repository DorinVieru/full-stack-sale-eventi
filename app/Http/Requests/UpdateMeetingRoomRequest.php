<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMeetingRoomRequest extends FormRequest
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
            'name' => 'required|max:150|min:2',
            'description' => 'required|min:5',
            'num_of_places_available' => 'required|integer|numeric|max:8000',
            'cover_image' => 'nullable|image|max:1024',
        ];
    }

    // FUNZIONE CHE RESTITUISCE I MESSAGGI PERSONALIZZATI PER GLI ERRORI
    public function messages()
    {
        return [
            'name.required' => 'Il nome della sala meeting è obbligatorio.',
            'name.max' => 'Il nome della sala meeting deve contere al massimo 150 caratteri.',
            'name.min' => 'Il nome della sala meeting deve contere almeno 2 caratteri.',
            'description.required' => 'La descrizione è obbligatoria.',
            'description.min' => 'La descrizione deve contenere almeno 5 caratteri.',
            'num_of_places_available.required' => 'La capienza della sala bisogna specificarla.',
            'num_of_places_available.integer' => 'Il valore inserito deve essere un numero intero, senza virgole o punti.',
            'num_of_places_available.numeric' => 'Il valore inserito deve essere un numero.',
            'num_of_places_available.max' => 'La capienza massima consentita è di 8000 posti. Contattare l\'assistenza per un piano personalizzato.',
            'cover_image.image' => 'Il file selezionato deve essere una immagine in formato valido (.jph, .jpeg, .webp, .png)',
            'cover_image.max' => 'Il file selezionato supera le dimensioni massime di 1024 Kb. Riprova.',
        ];
    }
}
