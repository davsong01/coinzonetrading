<?php

namespace App\Models;

use App\Models\Admin;
use App\Models\Investor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trade extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function investor(){
        return $this->belongsTo(Investor::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
