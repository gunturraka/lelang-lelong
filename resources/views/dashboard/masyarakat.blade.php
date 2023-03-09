@extends('template.master')

@section('content')
<section class="content">
  <section class="content">
    <div id="baranglelang" class="container"></div>
    <div class="row">
      @forelse($lelangs as $item)
      <div class="col-sm-3">
        <div class="card animate__animated animate__delay-2s animate__fadeInUp">
          @if($item->barang->image)
          <img src="{{ asset('storage/' . $item->barang->image)}}" alt="{{ $item->barang->nama_barang }}" class="card-img-top img-fluid mt-0">
          <a class="badge {{ $item->status == 'ditutup' ? 'bg-danger' : 'bg-success' }} position-absolute top-0 start-0 bg-success text-white rounded-end mt-2 py-1 px-3" href="">{{ Str::title($item->status) }}</a>  
          @endif
          <div class="card-body">
            <h4 class="card-title">{{ $item->barang->nama_barang}}</h4>
            <p class="card-text">{{ $item->barang->deskripsi_barang}}</p>
            @if($item->status == 'dibuka')
            <p class="card-text">Harga Awal: @currency($item->barang->harga_awal)</p>
            <a href="{{ route('lelangin.create', $item->id)}}" class="btn btn-primary animate__animated animate__delay-3s animate__bounceIn">TAWAR SEKARANG</a>
            @else
            <p class="card-text">Harga Akhir: @currency($item->harga_akhir)</p>
            <p class="card-text">Pemenang: {{ $item->pemenang }}</p>
            <a href="{{ route('lelangin.create', $item->id)}}" class="btn btn-info animate__animated animate__delay-3s animate__bounceIn">LIHAT DETAIL</a>
            @endif
          </div>
        </div>
      </div>
      @empty
      <div class="jumbotron text-center animate__animated animate__delay-2s animate__fadeInUp">
        <h1>Tidak Ada Barang yang Dilelang Saat Ini</h1>
        <p>Silakan kembali lagi nanti untuk menemukan barang yang menarik.</p>
        <a href="{{route('dashboard.masyarakat')}}" class="btn btn-primary btn-lg animate__animated animate__delay-3s animate__bounceIn">KEMBALI KE DASHBOARD</a>
      </div>
      @endforelse 
    </div>
</section>

@endsection