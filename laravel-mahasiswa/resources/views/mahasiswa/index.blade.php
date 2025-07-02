@extends('layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-2">
    <!-- Tombol Trigger Modal Tambah -->
    <a href="#" class="btn btn-outline-success mb-2" data-bs-toggle="modal" data-bs-target="#modalCreate">
        + Tambah Mahasiswa
    </a>
    <!-- Tombol Cari -->
    <form action="{{ route('mahasiswa.index') }}" method="GET" class="d-flex" style="max-width: 300px;">
        <input type="text" name="search" class="form-control me-2" placeholder="Cari NIM / Nama..." value="{{ request('search') }}">
        <button class="btn btn-outline-primary">Cari</button>
    </form>
</div>

<div class="table-responsive">
    <table class="table table-bordered shadow-sm rounded" style="background-color: #ffffff;">
        <thead class="table-light">
            <tr class="text-center">
                <th scope="col">#</th>
                <th scope="col"style="width: 150px;">NIM</th>
                <th scope="col"style="width: 250px;">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Telepon</th>
                <th scope="col" style="width: 200px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($mahasiswas as $m)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $m->nim }}</td>
                <td>{{ $m->nama }}</td>
                <td>{{ $m->email }}</td>
                <td>{{ $m->telepon }}</td>
                <td class="text-center">
                    <!-- Tombol Modal Show -->
                    <button class="btn btn-outline-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalShow{{ $m->id }}">
                        Detail
                    </button>

                    <!-- Tombol Modal Edit -->
                    <button class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $m->id }}">
                        Ubah
                    </button>

                    <!-- Tombol Hapus -->
                    <form action="{{ route('mahasiswa.destroy', $m->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin data akan dihapus?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>

            <!-- Modal Show -->
            <div class="modal fade" id="modalShow{{ $m->id }}" tabindex="-1" aria-labelledby="modalShowLabel{{ $m->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalShowLabel{{ $m->id }}">Detail Mahasiswa</h5>
                        </div>
                        <div class="modal-body">
                            <ul class="list-group">
                                <li class="list-group-item"><strong>NIM:</strong> {{ $m->nim }}</li>
                                <li class="list-group-item"><strong>Nama:</strong> {{ $m->nama }}</li>
                                <li class="list-group-item"><strong>Email:</strong> {{ $m->email }}</li>
                                <li class="list-group-item"><strong>Telepon:</strong> {{ $m->telepon }}</li>
                                <li class="list-group-item"><strong>Jenis Kelamin:</strong> {{ $m->jenis_kelamin }}</li>
                                <li class="list-group-item"><strong>Agama:</strong> {{ $m->agama }}</li>
                                <li class="list-group-item"><strong>Alamat:</strong> {{ $m->alamat }}</li>
                                @if($m->foto)
                                <li class="list-group-item">
                                    <strong>Foto:</strong><br>
                                    <img src="{{ asset('storage/' . $m->foto) }}" alt="Foto" width="120">
                                </li>
                                @endif
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Edit -->
            <div class="modal fade" id="modalEdit{{ $m->id }}" tabindex="-1" aria-labelledby="modalEditLabel{{ $m->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md">
                    <div class="modal-content">
                        <form action="{{ route('mahasiswa.update', $m->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalEditLabel{{ $m->id }}">Edit Mahasiswa</h5>
                            </div>
                            <div class="modal-body">
                                @include('mahasiswa.form', ['mahasiswa' => $m])
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script>
                // Tangkap semua form edit berdasarkan class
                document.querySelectorAll('.form-edit-mahasiswa').forEach(form => {
                    form.addEventListener('submit', function(e) {
                        const konfirmasi = confirm('Yakin ingin mengubah data mahasiswa ini?');
                        if (!konfirmasi) {
                            e.preventDefault(); // Batalkan submit jika pilih Batal
                        }
                    });
                });
            </script>

            @if($mahasiswas->isEmpty())
            <tr>
                <td colspan="7" class="text-center">Data mahasiswa tidak ditemukan.</td>
            </tr>
            @endif
            @empty
            <tr>
                <td colspan="6" class="text-center">Belum ada data mahasiswa.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3">
    {{ $mahasiswas->links() }}
</div>

<!-- Modal Create -->
<div class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="modalCreateLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <form action="{{ route('mahasiswa.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCreateLabel">Tambah Mahasiswa</h5>
                </div>
                <div class="modal-body">
                    @include('mahasiswa.form')
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection