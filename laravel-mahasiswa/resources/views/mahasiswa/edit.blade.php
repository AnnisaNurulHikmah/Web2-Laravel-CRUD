@extends('layout')
@section('content')
<form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @include('mahasiswa.form')
</form>
@endsection
