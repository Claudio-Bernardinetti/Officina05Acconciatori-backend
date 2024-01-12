<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'hairdresser_id',
        'customer_id',
        'slot',
        'description',
        // Aggiungi qui altri campi se necessario
    ];
}
