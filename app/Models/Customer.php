<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    // Relaçao Customer e Invoicer

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
