<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Table;
use App\Models\ReservationTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function reservationTables(){
        return $this->hasMany(ReservationTable::class);
    }

    public function tables(){
        return $this->belongsToMany(Table::class,'reservation_tables');
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }
}
