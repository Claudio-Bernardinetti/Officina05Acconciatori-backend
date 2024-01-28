<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Support\Facades\Validator;
use App\Models\Hairdresser;
use App\Models\Customer;
// use Google_Service_Calendar;
// use Google_Service_Calendar_Event;
// use Google_Client;

class AppointmentsController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['customer', 'hairdresser'])->get();

    $events = $appointments->map(function ($appointment) {
        // Assegna un colore in base al nome del parrucchiere
        $color = 'blue'; // Colore predefinito
        if ($appointment->hairdresser->name == 'Elia') {
            $color = 'green';
        } elseif ($appointment->hairdresser->name == 'Francesca') {
            $color = 'red';
        }

        return [
            'title' => $appointment->customer->name . ' - ' . $appointment->appointment_slot, //  Nome del cliente e slot
            'start' => $appointment->appointment_date,
            'color' => $color, // Colore dell'evento
            // 'end' => ... se hai una data di fine
        ];
    });

    return view('admin.appointments.index', ['events' => $events]);
    }

    public function create(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'customer_id' => 'required',
        //     'hairdresser_id' => 'required',
        //     'slot' => 'required',
        //     'description' => 'required',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json($validator->errors(), 400);
        // }

        $appointment = new Appointment;
        $appointment->customer_id = $request->customer_id;
        $appointment->hairdresser_id = $request->hairdresser_id;
        $appointment->appointment_date = $request->appointment_date;
        $appointment->appointment_slot = $request->appointment_slot;
        $appointment->description = $request->description;
        $appointment->save();

        // Aggiungi il codice per creare un evento nel calendario di Google qui

        return response()->json($appointment);
        
        // ... altri metodi ...
    }


    

    public function store(Request $request)
    {
        // Validazione dei dati di input
        $validatedData = $request->validate([
            'name' => 'required',
            'hairdresser_id' => 'required|exists:hairdressers,id',
            'appointment_date' => 'required|date',
            'appointment_slot' => 'required',
            'description' => 'nullable',
            'email' => 'required|email',
            'phone' => 'required', 
            // Aggiungi qui altre validazioni se necessario
        ]);
        // Controlla se la slot è già prenotata per quella data
        $existingAppointment = Appointment::where('hairdresser_id', $validatedData['hairdresser_id'])
        ->where('appointment_date', $validatedData['appointment_date'])
        ->where('appointment_slot', $validatedData['appointment_slot'])
        ->first();

        if ($existingAppointment) {
        return response()->json(['error' => 'Questa slot è già prenotata per il parrucchiere e la data selezionati.'], 409);
        }

        // Creare un nuovo cliente
    $customer = new Customer;
    $customer->name = $validatedData['name'];
    $customer->email = $validatedData['email'];
    $customer->phone = $validatedData['phone']; 
    // Imposta altri campi necessari per Customer
    $customer->save();

    // Crea un nuovo appuntamento con l'ID del cliente appena creato
    $appointment = new Appointment;
    $appointment->customer_id = $customer->id;
    // Imposta altri campi per Appointment
    $appointment->hairdresser_id = $validatedData['hairdresser_id'];
    $appointment->appointment_date = $validatedData['appointment_date'];
    $appointment->appointment_slot = $validatedData['appointment_slot'];
    $appointment->description = $validatedData['description'] ?? null;
    $appointment->save();

    return response()->json($appointment);
        // ... altri metodi ...
    }


    public function showByDate($date)
    {
        $appointments = Appointment::with(['customer', 'hairdresser'])
                            ->where('appointment_date', $date)
                            ->get();
    
        return view('admin.appointments.show', ['appointments' => $appointments, 'date' => $date]);
    }

    public function edit(Appointment $appointment)
    {
        // Questo metodo può essere implementato nel frontend
    }

    public function update(Request $request, Appointment $appointment)
    {
        $appointment->update($request->all());

        // Aggiungi il codice per aggiornare un evento nel calendario di Google qui

        return response()->json($appointment);
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->back()->with('success', 'Appuntamento cancellato con successo.');
    }
}