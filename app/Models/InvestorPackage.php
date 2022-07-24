<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestorPackage extends Model
{
    use HasFactory;
    protected $table = 'investors_packages';

    public function investor(){
        return $this->belongsTo(Investor::class);
    }
}
