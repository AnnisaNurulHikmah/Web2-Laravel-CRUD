<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Mahasiswa::query();

        if ($request->filled('search')) {
        $mahasiswas = Mahasiswa::where('nim', 'like', '%' . $request->search . '%')
            ->orWhere('nama', 'like', '%' . $request->search . '%')
            ->paginate(10);
    } else {
        $mahasiswas = $query->latest()->paginate(5);
    }

    return view('mahasiswa.index', compact('mahasiswas'));
    }

    public function create()
    {
        return view('mahasiswa.create');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'nim' => 'required|unique:mahasiswas,nim',
        'nama' => 'required',
        'email' => 'required|email|unique:mahasiswas,email',
        'telepon' => 'required',
        'jenis_kelamin' => 'required',
        'agama' => 'required',
        'alamat' => 'required',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Simpan file foto jika ada
    if ($request->hasFile('foto')) {
        $validated['foto'] = $request->file('foto')->store('mahasiswa', 'public');
    }

    Mahasiswa::create($validated);

    return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil ditambahkan');
}

public function update(Request $request, Mahasiswa $mahasiswa)
{
    $validated = $request->validate([
        'nim' => 'required|unique:mahasiswas,nim,' . $mahasiswa->id,
        'nama' => 'required',
        'email' => 'required|email|unique:mahasiswas,email,' . $mahasiswa->id,
        'telepon' => 'required',
        'jenis_kelamin' => 'required',
        'agama' => 'required',
        'alamat' => 'required',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Hanya jika user upload file baru
    if ($request->hasFile('foto')) {
        $validated['foto'] = $request->file('foto')->store('mahasiswa', 'public');
    } else {
        // Tetap gunakan foto lama jika tidak upload baru
        $validated['foto'] = $mahasiswa->foto;
    }

    $mahasiswa->update($validated);

    return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil diperbarui');
}


    public function destroy(Mahasiswa $mahasiswa)
    {
        if ($mahasiswa->foto) Storage::delete('public/' . $mahasiswa->foto);
        $mahasiswa->delete();
        return back()->with('success', 'Data dihapus');
    }
}
