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
    <form action="{{route('barang.store')}}" method="POST">
        @csrf
      <div class="card-body">
        <div class="form-group" >
            <label for="nama_barang">Barang</label>
            <input type="text" name="nama_barang" class="form-control"  value="{{$barangs->nama_barang}}" disabled>
          </div>
        <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{$barangs->tanggal}}" disabled>
          </div>
        <div class="form-group">
            <label for="harga_awal">Harga Awal</label>
            <input type="text" name="harga_barang" class="form-control"  value="{{$barangs->harga_awal}}" disabled>
          </div>
          @if( $barangs->image )
          <div class="form-group">
            <label>Gambar Barang :</label>
            <br>
            <img src="{{ asset('storage/' . $barangs->image)}}" alt="{{ $barangs->nama_barang }}" class="img-fluid mt-3">
          </div>
          @else

          @endif
          <div class="form-group">
            <label for="deskripsi_barang">Deskripsi Barang Anda</label>
            <input type="text" name="deskripsi_barang" class="form-control"  value="{{$barangs->deskripsi_barang}}" disabled>
          </div>
          <div class="card-footer">
            <a class="btn btn-primary"  href="{{ route('barang.index') }}">
              <i class="fas fa-arrow-left"></i>  Back   </a>
          </div>
        </div>
      <!-- /.card-body -->
    </form>
  </div>
</div>
@endsection