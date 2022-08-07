<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount', 'status', 'approved_date', 'reference_id'
    ];

    protected $casts = [
        'approved_date' => 'datetime',
        'request_date' => 'datetime',
    ];

    public function requestedBy(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function approvedBy(){
        return $this->hasOne(User::class, 'id', 'approved_by');
    }
}
