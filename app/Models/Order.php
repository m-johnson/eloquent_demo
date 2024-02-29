<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['completed'];

    public function items(){
        return $this->belongsToMany(Item::class,'order_items')->withTimestamps();
    }

    public function inmate(){
        return $this->belongsTo(Inmate::class);
    }
}
