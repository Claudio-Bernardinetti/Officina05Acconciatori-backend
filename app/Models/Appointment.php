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
        'appointment_date',   // ✅ corretto
        'appointment_slot',   // ✅ corretto
        'description',
    ];

    public function customer()
{
    return $this->belongsTo(Customer::class);
}

public function hairdresser()
{
    return $this->belongsTo(Hairdresser::class);
}
}
