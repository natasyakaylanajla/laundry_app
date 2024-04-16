<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'tb_transaksi';
    protected $guarded = ['id'];

    public function outlet()
    {
        return $this->belongsTo(Outlet::class, 'id_outlet');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'id_member');
    }

    public function transactionDetail()
    {
        return $this->hasMany(TransactionDetail::class, 'id_transaksi');
    }
}
