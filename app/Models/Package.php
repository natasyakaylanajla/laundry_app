<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $table = 'tb_paket';
    protected $guarded = ['id'];

    public function outlet()
    {
        return $this->belongsTo(Outlet::class, 'id_outlet');
    }

    public function transactionDetail()
    {
        return $this->hasMany(TransactionDetail::class, 'id_paket');
    }
}
