<?php

namespace App\Http\Controllers;

use App\Models\Suratpo;
use App\Models\Suratjalan;
use App\Models\BarangSuratPo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DeliveryController extends Controller
{
    public function index(Request $request)
{
    $suratPOs = Suratpo::whereHas('barangs', function ($query) {
        $query->whereNull('jadwal_barang');
    })->get();

    $selectedSuratPO = null;

    if ($request->has('suratpo')) {
        $kodePo = str_replace('_', '/', $request->suratpo);
        $selectedSuratPO = Suratpo::where('kode_po', $kodePo)
            ->with(['barangs' => function ($query) {
                $query->whereNull('jadwal_barang');
            }])
            ->first();
    }

    return view('schedule.index', [
        'suratPOs' => $suratPOs,
        'selectedSuratPO' => $selectedSuratPO,
        'authuser' => Auth::user()
    ]);

}

public function update(Request $request, $suratpo)
{
    $selectedSuratPO = Suratpo::where('kode_po', str_replace('_', '/', $suratpo))->first();

    if ($selectedSuratPO) {
        foreach ($selectedSuratPO->barangs as $barang) {
            $kode_barang = str_replace([' ', '-'], '_', $barang->kode_barang);
            $jadwal_barang = $request->input('jadwal_barang.' . $kode_barang);

            if ($jadwal_barang) {
                $barangSuratPo = $selectedSuratPO->barangs()
                    ->where('kode_barang', $barang->kode_barang)
                    ->first();

                if ($barangSuratPo) {
                    $barangSuratPo->pivot->jadwal_barang = $jadwal_barang;
                    $barangSuratPo->pivot->save();
                }
            }
        }

        return redirect()->back()->with('success', 'Jadwal barang berhasil diperbarui.');
    }

    return redirect()->back()->with('error', 'Data Surat PO tidak ditemukan.');
}


public function indexpengirimanPO(Request $request)
{
    $suratPOs = Suratpo::where('status', 'validated')->get();

    $barangDenganJadwal = BarangSuratPo::whereNotNull('jadwal_barang')->get();
    $barangSuratPOs = BarangSuratPo::whereIn('status_deliv', ['pending', 'proses'])->get();

    $totalQuantityPO = $barangDenganJadwal->sum('quantity_po');
    $totalQuantityKirim = $barangDenganJadwal->sum('quantity_kirim');

    return view('pengirimanpo.index', [
        'suratPOs' => $suratPOs,
        'barangDenganJadwal' => $barangDenganJadwal,
        'barangSuratPOs' => $barangSuratPOs, 
        'totalQuantityPO' => $totalQuantityPO,
        'totalQuantityKirim' => $totalQuantityKirim,
        'authuser' => Auth::user()
    ]);
}


public function store(Request $request)
{
    
    $suratJalan = new SuratJalan;
    $suratJalan->kode_Suratjalan = $request->kode_Suratjalan;
    $suratJalan->tanggal_kirim = $request->tanggal_kirim;
    $suratJalan->keterangan = $request->keterangan;
    $suratJalan->save();

    $selectedBarangIDs = $request->id_barang_suratpo;
    $quantityKirimArray = $request->quantity_kirim;

    if (!empty($selectedBarangIDs)) {
        $barangToAttach = [];

        foreach ($selectedBarangIDs as $barangID) {
            $quantityKirim = $quantityKirimArray[$barangID] ?? 0; 
            $barang = BarangSuratPO::find($barangID);
            if ($barang) {
                $barang->quantity_kirim += $quantityKirim;

                if ($barang->quantity_kirim >= $barang->quantity_po) {
                    $barang->status_deliv = 'dikirim';
                } else {
                    $barang->status_deliv = 'proses';
                }

                $barang->save();

                $barangToAttach[] = $barangID;
            }
        }

        $suratJalan->barangSuratJalan()->attach($barangToAttach);
    }

    return redirect()->route('pengirimanpo.index')
        ->with('success', 'Surat Jalan berhasil dibuat dan barang sudah dikirim.');
}



public function indexpenerimaan()
{
    $suratJalan = SuratJalan::all();

    return view('penerimaan.index', [
        'suratJalan' => $suratJalan,
        'authuser' => Auth::user()
    ]);
}

public function penerimaandetail($id)
    {

        $suratJalan = SuratJalan::findOrFail($id);
        
        return view('penerimaan.detailsuratjalan',[
            'suratJalan' => $suratJalan,
            'authuser' => Auth::user()
        ]);
    }

    public function setujuSuratJalan($id)
{
    $suratJalan = SuratJalan::find($id);

    if (!$suratJalan) {
        return redirect()->back()->with('error', 'Surat Jalan tidak ditemukan');
    }

    $suratJalan->status = 'diterima';
    $suratJalan->save();

    return redirect()->back()->with('success', 'Surat Jalan sudah diterima');
}

}
