<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Hairdresser;
use App\Models\Customer;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Client;

class AppointmentsController extends Controller
{
    public function index()
    {
        $appointments = Appointment::all();
        return response()->json($appointments);
    }

    public function create()
    {
        // Questo metodo può essere implementato nel frontend
    }

    public function store(Request $request)
    {
        $appointment = new Appointment;
        $appointment->hairdresser_id = $request->hairdresser_id;
        $appointment->customer_id = $request->customer_id;
        $appointment->slot = $request->slot;
        $appointment->description = $request->description;
        $appointment->save();

        // Aggiungi il codice per creare un evento nel calendario di Google qui

        return response()->json($appointment);
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