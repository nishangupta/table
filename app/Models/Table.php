<?php

namespace App\Models;

use App\Models\TableType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Table extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function tableType(){
        return $this->belongsTo(TableType::class,'table_type_id','id');
    }

    public function reservations(){
        return $this->hasMany(Reservation::class);
    }
}
