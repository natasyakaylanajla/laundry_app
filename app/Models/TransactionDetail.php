<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $table = 'tb_detail_transaksi';
    protected $guarded = ['id'];

    public function transactionDetail()
    {
        return $this->belongsTo(Transaction::class, 'id_transaksi');
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'id_paket');
    }
}
