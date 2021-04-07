<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationTable extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'reservation_tables';
    
}
