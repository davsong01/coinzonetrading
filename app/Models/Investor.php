<?php

namespace App\Models;

use App\Models\User;
use App\Models\InvestorPackage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Investor extends Model
{

    use HasFactory;

    protected $fillable = ['phone', 'profile_picture', 'wallet_type', 'wallet_addrress', 'profile_picture', 'means_of_identification','approved_identification', 'approved_identification_by','user_id', 'created_by', 'country','zip_code','state','address','wallet_withdrawal_limit'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    
    public function packages()
    {
        return $this->hasMany(InvestorPackage::class, 'investor_id');
    }
}
