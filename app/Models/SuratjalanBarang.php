<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratjalanBarang extends Model
{
    use HasFactory;
    protected $table = 'suratjalan_barang';
    protected $primaryKey = 'id'; 
    public $timestamps = true;
    protected $fillable = [
        'id_suratjalan',
        'id_barang_suratpo',
    ];

    public function suratjalan()
    {
        return $this->belongsTo(SuratJalan::class);
    }

    public function barangSuratPO()
    {
        return $this->belongsTo(BarangSuratPO::class, 'id_barang_suratpo');
    }
}
