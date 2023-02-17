@extends('template.master')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">membuat data baru</h3>
    </div>
    <form action="/barang" method="POST" enctype="multipart/form-data"> 


        @csrf
        <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label for="nama_barang">nama barang</label>
                <input type="text" name="nama_barang" class="form-control" id="nama_barang" placeholder="masukan nama barang">
                <br>
                <div class="form-group">
                <label for="tanggal">tanggal</label>
                <input type="date" name="tanggal" class="form-control" id="inputtanggal" placeholder="masukan tanggal">
                <br>
                <div class="form-group">
                <label for="harga_awal">harga awal</label>
                <input type="text" name="harga_awal" class="form-control" id="inputharga_awal" placeholder="masukan harga awal">
                <br>
                <label for="image" class="form-label">Gambar Barang</label>
                    <img class="img-preview img-fluid" alt="">
                    <input class="form-control @error('image')is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
                    @error('image')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                <br>
                <label for="deskripsi">deskripsi</label>
                <textarea name="deskripsi_barang" class="form-control" id="inputdeskripsi" cols="50" rows="4"></textarea>
                <br>
                <a class="btn btn-primary"  href="{{ route('barang.index') }}">
                <i class="fas fa-arrow-left"></i>  Back   </a>
                <button type="submit" class="btn btn-primary plus float-right" class="btn btn-primary">     Submit     </button>
            </form>
</div>
<script>
    function previewImage() {
      const image = document.querySelector('#image')
      const imgPreview = document.querySelector('.img-preview')
      imgPreview.style.display = 'block';
      const oFReader = new FileReader();
      oFReader.readAsDataURL(image.files[0]);
      oFReader.onload = function(oFREvent) {
        imgPreview.src = oFREvent.target.result;
    }
}
</script>
@endsection