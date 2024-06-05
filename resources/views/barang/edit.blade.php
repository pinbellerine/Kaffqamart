@extends('layouts.admin')

@section('judul')
  
@endsection

@section('content')
<div class="p-3">
    <h2>Edit Data Profile Pelanggan {{$barang->id}} </h2>
        <form action="/barang/{{$barang->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Kategori</label>
                <select id="inputKategori" required class="form-control" name="kategori">
                    <option selected>Pilih Kategori</option>
                    @foreach($kategori as $kategori)
                    <option value='{{ $kategori->id }}'>{{ $kategori->nama_kategori}} </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="nama">Harga Barang</label>
                <input type="text" class="form-control" name="harga" value="{{$barang->harga_brg}}" id="" placeholder="Masukkan Nama Barang">
                @error('harga')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="nohp">Nama Barang</label>
                <input type="text" class="form-control" name="nama" value="{{$barang->nama_brg}}" id="" placeholder="Masukkan no hp">
                @error('nama')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="alamat">Deskripsi</label>
                <input type="text" class="form-control" name="deskripsi" value="{{$barang->deskripsi_brg}}" placeholder="Masukkan Alamat">
                @error('alamat')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="alamat">Stock Barang</label>
                <input type="number" class="form-control" name="stock" value="{{$barang->stock_brg}}" id="" placeholder="Masukkan Alamat">
                @error('alamat')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="alamat">Barang</label>
                <input type="file" class="form-control" name="filename" value="{{$barang->gambar_brg}}" placeholder="Masukkan Alamat">
                @error('alamat')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <a href="/barang" class="btn btn-success my-3">Kembali</a>
            <button type="submit" class="btn btn-primary">Update Data</button>
        </form>
</div>
@endsection
