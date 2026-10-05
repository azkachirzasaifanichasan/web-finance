<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KasPayment extends Model
{
    protected $fillable = ['student_id', 'month', 'amount'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
