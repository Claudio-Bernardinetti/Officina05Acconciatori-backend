<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hairdresser;
use Illuminate\Support\Facades\Validator;

class HairdressersController extends Controller
{
    public function index()
    {
        $hairdressers = Hairdresser::all();
        return response()->json($hairdressers);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'category' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $hairdresser = new Hairdresser;
        $hairdresser->name = $request->name;
        $hairdresser->category = $request->category;
        $hairdresser->save();

        return response()->json($hairdresser);

        // ... altri metodi ...
    }

    

    public function store(Request $request)
    {
        $hairdresser = new Hairdresser;
        $hairdresser->name = $request->name;
        $hairdresser->category = $request->category;
        $hairdresser->save();

        return response()->json($hairdresser);
    }

    public function show(Hairdresser $hairdresser)
    {
        return response()->json($hairdresser);
    }

    public function edit(Hairdresser $hairdresser)
    {
        // Questo metodo può essere implementato nel frontend
    }

    public function update(Request $request, Hairdresser $hairdresser)
    {
        $hairdresser->update($request->all());
        return response()->json($hairdresser);
    }

    public function destroy(Hairdresser $hairdresser)
    {
        $hairdresser->delete();
        return response()->json('Hairdresser deleted successfully');
    }
}