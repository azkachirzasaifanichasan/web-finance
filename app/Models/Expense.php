<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['expense_date', 'item', 'unit_price', 'quantity', 'description'];
}
