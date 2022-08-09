<?php

namespace App\Models;

use App\Models\User;
use App\Models\Package;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvestorPackage extends Model
{
    use HasFactory;
    protected $table = 'investors_packages';
    protected $guarded = [];
    
    // public function investor(){
    //     return $this->belongsTo(Investor::class);
    // }

    public function user()
    {
        return $this->belongsTo(User::class, 'investor_id');
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
