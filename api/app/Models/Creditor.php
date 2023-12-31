<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Creditor extends Model
{
    use HasFactory;

    protected $table = 'creditors';

    protected $guarded = [];
    protected $with = ['payments'];

    public function payments()
    {
        return $this->hasMany(\App\Models\Payment::class);
    }


}
