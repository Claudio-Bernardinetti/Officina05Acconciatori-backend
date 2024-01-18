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
        $appointments = Appointment::all();

    return view('admin.appointments.index', ['appointments' => $appointments]);
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


    public function show(Appointment $appointment)
    {
        return response()->json($appointment);
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

        // Aggiungi il codice per cancellare un evento nel calendario di Google qui

        return response()->json('Appointment deleted successfully');
    }
}