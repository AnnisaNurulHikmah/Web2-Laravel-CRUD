@extends('layout')
@section('content')
<form action="{{ route('mahasiswa.store') }}" method="POST" enctype="multipart/form-data">
    @include('mahasiswa.form')
</form>
@endsection
