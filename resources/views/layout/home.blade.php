@extends('layout.main')

@section('judul')
DASHBOARD
@endsection

@section('isi')
@if($authuser->role == "purchasing")
<div class="card">
  <div class="card-header">
    <h3 class="h1">Selamat Datang, {{ $authuser->name }}</h3>
    </div>

    <div>
      <?php echo config('app.timezone'); ?>
    </div>
  </div>
@elseif ($authuser->role == "ppic")
<div class="card">
  <div class="card-header">
    <h3 class="h1">Selamat Datang, {{ $authuser->name }}</h3>
    </div>
  </div>
  @elseif ($authuser->role == "supplier")
<div class="card">
  <div class="card-header">
    <h3 class="h1">Selamat Datang, {{ $authuser->name }}</h3>
    </div>
  </div>
  @elseif ($authuser->role == "direktur")
  <div class="card">
    <div class="card-header">
        <h3 class="h1">Selamat Datang, {{ $authuser->name }}</h3>
    </div>
    <div class="card-body">
        <h4>Daftar Surat PO yang Sudah DiSetujui</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kode PO</th>
                    <th>Nama Supplier</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suratPOs as $suratPO)
                <tr>
                    <td>{{ $suratPO->kode_po }}</td>
                    <td>{{ $suratPO->supplier->nama_supplier }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
  
@endif
@endsection