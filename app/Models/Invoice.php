<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;


    public function custumers()
    {
        // relaçao de pertence a
        return $this->belongsTo(Customer::class);
    }
}
