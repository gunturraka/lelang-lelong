@extends('template.master')

@section('content')
<div class="card">
  @if (auth()->user()->level == 'petugas')
    <div class="card-header d-flex justify-content-between mb-3">
      <a href="/lelang/create" class="btn btn-primary">Tambah Lelang</a>
    </div>
  @endif
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example2" class="table table-bordered table-hover" class="datatable">
        <thead>
        <tr>
          <th>NO</th>
          <th>Nama Barang</th>
          <th>Harga awal</th>
          <th>Harga Akhir</th>
          <th>Tanggal</th>
          <th>Status</th>
          @if (auth()->user()->level == 'petugas')
          <th><center>Action</center></th>
          @endif
          </tr>
        </thead>
        <tbody>
          <tr>
          @forelse ($lelangs as $lelang)
          <tr>
            <td >{{ $loop -> iteration }}</td>
            <td >{{ $lelang->barang->nama_barang }}</td>
            <td > @currency ($lelang->barang->harga_awal)</td>
            <td > @currency ($lelang->harga_akhir)</td>
            <td >{{ \Carbon\Carbon::parse($lelang->tanggal)->format('j-F-Y') }}</td>
              <td>
                <span class="badge {{ $lelang->status == 'ditutup' ? 'bg-danger' : 'bg-success'  }}">{{ Str::title($lelang->status) }}</span>
              </td>
              <td>
                  @if (auth()->user()->level == 'petugas') 
                  <div class="d-flex flex-nowrap flex-column flex-md-row justify-center">
                    <form action="/lelang/{{ $lelang->id }}" method="POST">
                      <a class="btn btn-info mr-3" href="/lelang/{{ $lelang->id }}">Detail</a>                    
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn btn-danger" value="Delete">
                  </form>
                  </div>  
                  @endif
              </td>
            </tr>
          </tr>
              @empty
            <tr>
              <td colspan="5" style="text-align: center" class="text-danger"><strong> Data Lelang Kosong</strong></td>
            </tr>
            @endforelse ($lelangs as $lelang)
        </tbody>
        </table>
    </div>
    <!-- /.card-body -->
@endsection