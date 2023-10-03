<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suratpo;
use App\Models\Supplier;
use App\Models\Barang;
use App\Models\Suratjalan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SuratpoController extends Controller
{


    public function formPO()
{
    $monthNow = date('n');
    $romawi = $this->romawi($monthNow);

    $yearNow = date('Y');
    $maxId = Suratpo::max('kode_po');

    $yearNowSubstring = substr($yearNow, -2);
    $maxIdSubstring = substr($maxId, -2);

    if (is_null($maxId)) {
        $PRID = '001/RMA/' . $romawi . '/' . $yearNowSubstring;
    } else {
        if ($maxIdSubstring == $yearNowSubstring) {
            $runningNumber = substr($maxId, 0, -9);
            $newRunningNumber = intval($runningNumber) + 1;
            $PRID = str_pad($newRunningNumber, 3, '0', STR_PAD_LEFT) . '/RMA/' . $romawi . '/' . $yearNowSubstring;
        } else {
            $PRID = '001/RMA/' . $romawi . '/' . $yearNowSubstring;
        }
    }

    $barang = Barang::all();
    $suppliers = Supplier::all();
    $suratpo = Suratpo::all();

    return view('suratpo.form')->with([
        'suratpo' => $suratpo,
        'authuser' => Auth::user(),
        'suppliers' => $suppliers,
        'barangs' => $barang,
        'monthNow' => $monthNow,
        'PRID' => $PRID,
    ]);
}


private function romawi($bulan)
    {
    $bulanRomawi = [
        1 => 'I',
        2 => 'II',
        3 => 'III',
        4 => 'IV',
        5 => 'V',
        6 => 'VI',
        7 => 'VII',
        8 => 'VIII',
        9 => 'IX',
        10 => 'X',
        11 => 'XI',
        12 => 'XII'
    ];

    return $bulanRomawi[$bulan];
    }

    public function store(Request $request)
    {
        $supplier = Supplier::find($request->input('id_supplier'));
    
        if ($supplier) {
            $suratpo = new Suratpo();
            $suratpo->kode_po = $request->input('kode_po');
            $suratpo->id_supplier = $supplier->id_supplier;
            $suratpo->periode = date('n');
            $suratpo->tanggal_po = $request->input('tanggal_po');
            $suratpo->status = 'NotValidate';
            $suratpo->save();
    
            $barangItems = [];
            if ($request->has('barang') && count($request->barang['id_barang']) > 0) {
                foreach ($request->barang['id_barang'] as $index => $id_barang) {
                    $barang = Barang::find($id_barang);
                    if ($barang) {
                        $barangItems[] = [
                            'id_suratpo' => $suratpo->kode_po,
                            'id_barang' => $id_barang,
                            'quantity_po' => $request->barang['quantity_po'][$index],
                            'price' => $request->barang['price'][$index],
                            'total_price' => $request->barang['total_price'][$index],
                        ];
                    }
                }
            }
    
            DB::table('barang_suratpo')->insert($barangItems);
    
            return redirect()->route('suratpo.index')->with('success', 'Surat PO berhasil dibuat.');
        }
    }

    public function indexnewpo()
    {
        $suratPOs = Suratpo::with('barangs')->get()->groupBy('kode_po');
        $suppliers = Supplier::all();
    
        return view('suratpo.index', [
            'suratPOs' => $suratPOs,
            'authuser' => Auth::user(),
            'supplier' => $suppliers,
        ]);
    }


    public function delete($modalId)
    {
        
        $kodePo = str_replace('_', '/', $modalId);
    
        
        $suratPO = Suratpo::where('kode_po', $kodePo)->first();
    
        if (!$suratPO) {
            return redirect()->route('suratpo.index')->with('error', 'Data not found');
        }
    
        $suratPO->delete();
    
        return redirect()->route('suratpo.index')->with('success', 'Data berhasil dihapus');
    }
    

    public function indexdirektur()
{
    $suratPOs = Suratpo::where('status', 'NotValidate')->get();
    
    return view('direktur.index', [
        'suratPOs' => $suratPOs,
        'authuser' => Auth::user(),
    ]);
}


public function validasi($modalId)
{
    $suratPO = Suratpo::where('kode_po', str_replace('_', '/', $modalId))->first();

    if ($suratPO) {
        // Ubah status menjadi "Validated"
        $suratPO->status = 'Validated';
        $suratPO->save();
    }

    return redirect()->back()->with('success', 'Surat PO berhasil disetujui.');
}

public function laporan()
{
    
    $suratpo = Suratpo::all();
    $suratjalan = SuratJalan::where('status', 'diterima')->get();

    return view('laporan.index', [
        'suratpo' => $suratpo,
        'suratjalan' => $suratjalan,
        'authuser' => Auth::user()
    ]);
}



}
