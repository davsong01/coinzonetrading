<?php

namespace App\Models;

use App\Models\Investor;
use App\Models\InvestorPackage;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function investor(){
        return $this->hasOne(Investor::class);
    }

    public function packages(){
        return $this->hasMany(InvestorPackage::class, 'investor_id');
    }

    public function wallets(){
        return $this->hasMany(Wallet::class, 'user_id');
    }

    /**
     * The user current wallet balance
     */
    public function walletBalance(){
        $max = Wallet::where(['user_id' => $this->id, 'type' => 'credit'])->sum('amount');
        $min = Wallet::where(['user_id' => $this->id, 'type' => 'debit'])->sum('amount');
        return $max - $min;
    }

}
