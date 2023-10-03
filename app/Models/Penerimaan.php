<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penerimaan extends Model
{
    use HasFactory;
    protected $table = 'penerimaan';
    protected $fillable = [
        'id_suratpo',
        'suratjalan',
        'tanggal_terima'
    ];

    public function barangSuratPo()
    {
        return $this->hasMany(BarangSuratPo::class, 'penerimaan_id', 'id');
    }


}
