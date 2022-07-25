<?php

namespace App\Models;

use App\Models\Package;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvestorPackage extends Model
{
    use HasFactory;
    protected $table = 'investors_packages';

    public function investor(){
        return $this->belongsTo(Investor::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
