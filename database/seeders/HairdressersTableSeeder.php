<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Hairdresser; // Assicurati che questo percorso sia corretto

class HairdressersTableSeeder extends Seeder
{
    public function run()
    {
        Hairdresser::create([
            'name' => 'Elia',
            'specialization' => 'Uomo'
        ]);

        Hairdresser::create([
            'name' => 'Francesca',
            'specialization' => 'Donna'
        ]);

        // Aggiungi altri parrucchieri qui
    }
}
