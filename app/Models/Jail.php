<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jail extends Model
{
    use HasFactory;

    protected $fillable = ['name','city','state','admin_email'];

    public function inmates(){
        return $this->hasMany(Inmate::class);
    }
}
