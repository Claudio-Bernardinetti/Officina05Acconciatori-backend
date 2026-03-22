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
    $customers = Customer::all();
    $hairdressers = Hairdresser::all();
    $availableSlots = [];
    
    $date = $request->query('date'); // ✅ prende la data dalla query string

    if ($date) {
        $openingTime = 9;
        $closingTime = 19;

        for ($hour = $openingTime; $hour < $closingTime; $hour++) {
            foreach ([0, 30] as $minutes) {
                $slot = sprintf('%02d:%02d', $hour, $minutes);

                $isBooked = Appointment::where('appointment_date', $date)
                    ->where('appointment_slot', $slot)
                    ->exists();

                if (!$isBooked) {
                    $availableSlots[] = $slot;
                }
                // ✅ dd() rimosso!
            }
        }
    }

    return view('admin.appointments.create', compact('customers', 'hairdressers', 'date', 'availableSlots'));
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
            'customer_id' => 'sometimes|exists:customers,id', // 'sometimes' indica che il campo potrebbe non essere presente
        ]);

        // Controlla se la slot è già prenotata
        if (Appointment::where('hairdresser_id', $validatedData['hairdresser_id'])
            ->where('appointment_date', $validatedData['appointment_date'])
            ->where('appointment_slot', $validatedData['appointment_slot'])
            ->exists()) {
            return response()->json(['error' => 'Questa slot è già prenotata.'], 409);
        }

        // Creare un nuovo cliente se non viene fornito un customer_id
        if (empty($validatedData['customer_id'])) {
            $customer = Customer::firstOrCreate(
                ['email' => $validatedData['email']],
                [
                    'name'  => $validatedData['name'],
                    'phone' => $validatedData['phone'],
                ]
            );
            $validatedData['customer_id'] = $customer->id;
        }

        // Crea un nuovo appuntamento
        $appointment = new Appointment;
        $appointment->fill($validatedData);
        $appointment->save();

        return response()->json($appointment);
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
    return view('admin.appointments.edit', compact('appointment'));
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