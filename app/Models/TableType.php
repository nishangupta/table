<?php

namespace App\Models;

use App\Models\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TableType extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function tables(){
        return $this->hasMany(Table::class);
    }
    
}




