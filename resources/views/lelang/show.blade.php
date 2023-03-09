@extends('template.master')

@section('judul')    
<h1>Halaman Create</h1>
@endsection

@section('content')

<div class="col-md-12">
 <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Detail Barang Anda</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{route('lelang.store')}}" method="POST">
        @csrf
      <div class="card-body">
        <div class="form-group" >
            <label for="nama_barang">Barang</label>
            <input type="text" name="nama_barang" class="form-control"  value="{{$lelangs->barang->nama_barang}}" disabled>
          </div>
        <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{$lelangs->tanggal}}" disabled>
          </div>
        <div class="form-group">
            <label for="harga_awal">Harga Awal</label>
            <input type="text" name="harga_awal" class="form-control"  value="{{$lelangs->barang->harga_awal}}" disabled>
          </div>
          @if(  $lelangs->barang->image )
          <div class="form-group">
            <label>Gambar Barang :</label>
            <br>
            <img src="{{ asset('storage/' . $lelangs->barang->image)}}" alt="{{ $lelangs->barang->nama_barang }}" class="img-fluid mt-3">
          </div>
          @else

          @endif
          <div class="form-group">
            <label for="deskripsi_barang">Deskripsi Barang Anda</label>
            <input type="text" name="deskripsi_barang" class="form-control"  value="{{$lelangs->barang->deskripsi_barang}}" disabled>
          </div>
          <div class="card-footer">
            <a class="btn btn-primary"  href="{{ route('lelang.index') }}">
              <i class="fas fa-arrow-left"></i>  Back   </a>
          </div>
        </div>
      <!-- /.card-body -->
    </form>
  </div>
</div>
<div class="card">
  <div class="card-header">
    <a href="" target="_blank" class="btn btn-info mb-3">
  <li class="fas fa fa-print"></li>
      Cetak Data
    </a>
  <div class="card-tools">
    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
      <i class="fas fa-minus"></i>
    </button>
    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
      <i class="fas fa-times"></i>
    </button>
  </div>
</div>
<div class="card-body table-responsive p-0">
<table class="table table-hover">
      <thead>
          <tbody>
              <tr>
                  <th>No</th>
                  <th>Pelelang</th>
                  <th>Nama Barang</th>
                  <th>Harga Penawaran</th>
                  <th>Tanggal Penawaran</th>
                  <th>Status</th>
                  @if(auth()->user()->level == 'petugas')
                  <th></th>
                  @else
                  @endif
                  
              </tr>
          </tbody>
      </thead>
      @forelse ($histories as $item)
      <tbody>
      <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $item->user->name }}</td>
          <td>{{ $item->lelang->barang->nama_barang }}</td>
          <td>@currency($item->harga_penawaran)</td>
          <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('j-F-Y') }}</td>
          <td>
            <span class="badge text-white {{ $item->status == 'pending' ? 'bg-warning' : ($item->status == 'gugur' ? 'bg-danger' : 'bg-success') }}">{{ Str::title($item->status) }}
          </span>
          </td>
          @if(Auth::user()->level == 'petugas')
          <td>
            <form action="{{ route('lelangpetugas.setpemenang', $item->id) }}" method="POST">
              @csrf
              @method('PUT')
              <button type="submit" class="btn btn-success">Pilih Pemenang</button>
            </form>
          </td>
          @else
          @endif
      </tr>
      @empty
      <tr>
        <td colspan="5" style="text-align: center" class="text-danger"><strong>Belum ada penawaran</strong></td>
      </tr>
      @endforelse
      </tbody>
  </table>
</div>
<!-- /.card-body -->
<!-- /.card-footer-->
</div>
@endsection