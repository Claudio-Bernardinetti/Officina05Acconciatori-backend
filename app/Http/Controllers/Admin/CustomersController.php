<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;

class CustomersController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return response()->json($customers);
    }

    public function create(Request $request)
    {
        // Crea un nuovo oggetto Customer
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Crea un nuovo oggetto Customer
        $customer = new Customer;

        // Genera un ID personalizzato basato sui dati di input
        $customer->id = $this->generateCustomId($request->name, $request->email);

        // Imposta i valori delle proprietà dell'oggetto Customer
        $customer->name = $request->name;
        $customer->email = $request->email;

        // Salva l'oggetto Customer nel database
        $customer->save();

        // Restituisce l'oggetto Customer al frontend
        return response()->json($customer);
    }

    // ... altri metodi ...

    // private function generateCustomId($name, $email)
    // {
    //     // Genera un ID personalizzato. Questa è solo un'implementazione di esempio.
    //     // Potresti voler modificare questa funzione per soddisfare le tue esigenze specifiche.
    //     return md5($name . $email);
    // }
    

    public function store(Request $request)
    {
        $customer = new Customer;
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->save();

        return response()->json($customer);
    }

    public function show(Customer $customer)
    {
        return response()->json($customer);
    }

    public function edit(Customer $customer)
    {
        // Questo metodo può essere implementato nel frontend
    }

    public function update(Request $request, Customer $customer)
    {
        $customer->update($request->all());
        return response()->json($customer);
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return response()->json('Customer deleted successfully');
    }
}