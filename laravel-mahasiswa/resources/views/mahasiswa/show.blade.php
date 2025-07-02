@extends('layout')

@section('content')
<h2>Detail Mahasiswa</h2>
<div class="card p-3">
    <div><strong>NIM:</strong> {{ $mahasiswa->nim }}</div>
    <div><strong>Nama:</strong> {{ $mahasiswa->nama }}</div>
    <div><strong>Email:</strong> {{ $mahasiswa->email }}</div>
    <div><strong>Telepon:</strong> {{ $mahasiswa->telepon }}</div>
    <div><strong>Jenis Kelamin:</strong> {{ $mahasiswa->jenis_kelamin }}</div>
    <div><strong>Agama:</strong> {{ $mahasiswa->agama }}</div>
    <div><strong>Alamat:</strong> {{ $mahasiswa->alamat }}</div>
    @if($mahasiswa->foto)
        <div><strong>Foto:</strong><br>
            <img src="{{ asset('storage/' . $mahasiswa->foto) }}" width="120">
        </div>
    @endif
</div>
<a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary mt-3">Kembali</a>
@endsection
