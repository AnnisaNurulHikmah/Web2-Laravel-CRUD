@php
    $mahasiswa = $mahasiswa ?? null;
@endphp

<div class="mb-3">
    <label for="nim" class="form-label">NIM</label>
    <input type="text" name="nim" class="form-control @error('nim') is-invalid @enderror"
           value="{{ old('nim', $mahasiswa->nim ?? '') }}">
    @error('nim') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="nama" class="form-label">Nama</label>
    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
           value="{{ old('nama', $mahasiswa->nama ?? '') }}">
    @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Jenis Kelamin</label>
    <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror">
        <option value="">-- Pilih --</option>
        <option value="Laki-laki" {{ old('jenis_kelamin', $mahasiswa->jenis_kelamin ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
        <option value="Perempuan" {{ old('jenis_kelamin', $mahasiswa->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
    </select>
    @error('jenis_kelamin') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="agama" class="form-label">Agama</label>
    <input type="text" name="agama" class="form-control @error('agama') is-invalid @enderror"
           value="{{ old('agama', $mahasiswa->agama ?? '') }}">
    @error('agama') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="alamat" class="form-label">Alamat</label>
    <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $mahasiswa->alamat ?? '') }}</textarea>
    @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
           value="{{ old('email', $mahasiswa->email ?? '') }}">
    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="telepon" class="form-label">Telepon</label>
    <input type="text" name="telepon" class="form-control @error('telepon') is-invalid @enderror"
           value="{{ old('telepon', $mahasiswa->telepon ?? '') }}">
    @error('telepon') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="foto" class="form-label">Foto</label>
    @if (!empty($mahasiswa?->foto))
        <div class="mb-2">
            <img src="{{ asset('storage/' . $mahasiswa->foto) }}" width="120" alt="Foto Saat Ini">
        </div>
    @endif
    <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror">
    @error('foto') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
