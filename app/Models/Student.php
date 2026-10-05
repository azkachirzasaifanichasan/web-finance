<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['absen', 'nis', 'full_name'];

    public function payments()
    {
        return $this->hasMany(KasPayment::class);
    }
}
