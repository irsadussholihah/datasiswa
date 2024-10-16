<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    // Melihat daftar siswa
    public function index()
    {
        return Siswa::all();
    }

    // Menambah siswa baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|max:255|unique:siswas',
            'kelas' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
        ]);

        $siswa = Siswa::create($request->all());
        return response()->json($siswa, 201);
    }

    // Melihat detail siswa
    public function show($id)
    {
        return Siswa::findOrFail($id);
    }

    // Mengedit data siswa
    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $request->validate([
            'nama' => 'sometimes|string|max:255',
            'nis' => 'sometimes|string|max:255|unique:siswas,nis,' . $id,
            'kelas' => 'sometimes|string|max:255',
            'alamat' => 'sometimes|string|max:255',
        ]);

        $siswa->update($request->all());
        return response()->json($siswa, 200);
    }

    // Menghapus siswa
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        return response()->json(null, 204);
    }
}