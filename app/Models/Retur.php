<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retur extends Model
{
    use HasFactory;
    protected $table = 'retur';
    protected $fillable = [
        'kode_surat_jalan',
        'nama_supplier',
        'nama_barang',
        'quantity_retur',
        'tanggal_retur',
        'keterangan',
    ];

    protected $casts = [
        'keterangan' => 'string',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'nama_supplier', 'nama_supplier');
    }

    public function suratjalan()
    {
        return $this->belongsTo(Suratjalan::class, 'kode_surat_jalan', 'kode_surat_jalan');
    }
}
