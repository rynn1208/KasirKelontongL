<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $primaryKey = 'id_transaksi';

    // Matikan timestamps jika kamu hanya pakai 'tanggal' (useCurrent)
    public $timestamps = false;

    protected $fillable = ['total_bayar'];
}