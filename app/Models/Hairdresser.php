<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hairdresser extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        // Aggiungi qui altri campi se necessario
    ];

    public function appointments()
{
    return $this->hasMany(Appointment::class);
}
}
