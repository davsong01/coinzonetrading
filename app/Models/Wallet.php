<?php

namespace App\Models;

use App\Models\User;
use App\Models\InvestorPackage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'amount', 'user_id','reference','code','fee_rate','expires_at','amount','currency','url', 'description','status','response'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function transaction()
    {
        return $this->belongsTo(InvestorPackage::class, 'reference', 'reference');
    }

}
