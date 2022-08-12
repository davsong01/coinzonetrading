<?php

namespace App\Models;

use App\Models\InvestorPackage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'short_description',
        'amount',
        'daily_roi',
        'max_amount',
        'validity_period',
    ];

    public function users(){
        return $this->hasMany(InvestorPackage::class, 'package_id');
    }
}
