<?php

namespace App\Http\Controllers;

use App\Models\HewanModel;
use App\Models\KandangModel;
use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class HewanController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Hewan',
            'list'  => ['Home', 'Hewan']
        ];

        $page = (object) [
            'title' => 'Daftar hewan yang terdaftar dalam sistem'
        ];

        $activeMenu = 'hewan';

        return view('hewan.index', [
            'breadcrumb' => $breadcrumb,
            'page'       => $page,
            'activeMenu' => $activeMenu
        ]);
    }

public function list(Request $request)
{
    $hewan = HewanModel::with('kandang')->get();

    return datatables()->of($hewan)
        ->addColumn('kandang', function($hewan) {
            return $hewan->kandang->nama_kandang;  // Ambil nama kandang
        })
        ->addIndexColumn()  // Menambahkan kolom No
        ->addColumn('aksi', function($row) {
            $btn = '<a href="'.url('hewan/'.$row->id_hewan).'" class="btn btn-sm btn-info">Detail</a> ';
            $btn .= '<a href="'.url('hewan/'.$row->id_hewan.'/edit').'" class="btn btn-sm btn-warning">Edit</a> ';
            $btn .= '<form action="'.url('hewan/'.$row->id_hewan).'" method="POST" style="display:inline-block;" onsubmit="return confirm(\'Yakin ingin menghapus data ini?\')">
                        '.csrf_field().'
                        '.method_field('DELETE').'
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>';
            return $btn;
        })
        ->rawColumns(['aksi']) // ← penting! agar HTML-nya tidak di-escape
        ->make(true);
}


    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Hewan',
            'list'  => ['Home', 'Hewan', 'Tambah']
        ];
    
        $page = (object) [
            'title' => 'Tambah hewan baru'
        ];
    
        $kandang = KandangModel::all(); // Ambil data kandang
        $activeMenu = 'hewan';
    
        return view('hewan.create', [
            'breadcrumb' => $breadcrumb,
            'page'       => $page,
            'kandang'    => $kandang,
            'activeMenu' => $activeMenu
        ]);
    }

    public function store(Request $request)
{
    $request->validate([
        'nama_hewan'     => 'required|string|max:100',
        'spesies'        => 'required|string|max:100',
        'jenis_kelamin'  => 'required|in:Jantan,Betina',
        'tanggal_lahir'  => 'required|date',
        'id_kandang'     => 'required|exists:kandang,id_kandang'
    ]);

    HewanModel::create([
        'nama_hewan'     => $request->nama_hewan,
        'spesies'        => $request->spesies,
        'jenis_kelamin'  => $request->jenis_kelamin,
        'tanggal_lahir'  => $request->tanggal_lahir,
        'id_kandang'     => $request->id_kandang
    ]);

    return redirect()->route('hewan.index')->with('success', 'Data hewan berhasil disimpan');
}


    public function show(string $id)
    {
        $hewan = HewanModel::with('kandang')->findOrFail($id);

        $breadcrumb = (object) [
            'title' => 'Detail Hewan',
            'list'  => ['Home', 'Hewan', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail hewan'
        ];

        $activeMenu = 'hewan';

        return view('hewan.show', [
            'breadcrumb' => $breadcrumb,
            'page'       => $page,
            'hewan'      => $hewan,
            'activeMenu' => $activeMenu
        ]);
    }

    public function edit(string $id)
    {
        $hewan = HewanModel::findOrFail($id);
        $kandang = KandangModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit Hewan',
            'list'  => ['Home', 'Hewan', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit hewan'
        ];

        $activeMenu = 'hewan';

        return view('hewan.edit', [
            'breadcrumb' => $breadcrumb,
            'page'       => $page,
            'hewan'      => $hewan,
            'kandang'   => $kandang,
            'activeMenu' => $activeMenu
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_hewan'     => 'required|string|max:100',
            'spesies'        => 'required|string|max:100',
            'jenis_kelamin'  => 'required|in:Jantan,Betina',
            'tanggal_lahir'  => 'required|date',
            'id_kandang'     => 'required|exists:kandang,id_kandang'
        ]);
    
        HewanModel::findOrFail($id)->update([
            'nama_hewan'     => $request->nama_hewan,
            'spesies'        => $request->spesies,
            'jenis_kelamin'  => $request->jenis_kelamin,
            'tanggal_lahir'  => $request->tanggal_lahir,
            'id_kandang'     => $request->id_kandang
        ]);
    
        return redirect()->route('hewan.index')->with('success', 'Data hewan berhasil diubah');
    }    

    public function destroy(string $id)
    {
        $hewan = HewanModel::find($id);
        if (!$hewan) {
            return redirect()->route('hewan.index')->with('error', 'Data hewan tidak ditemukan');
        }

        try {
            $hewan->delete();
            return redirect()->route('hewan.index')->with('success', 'Data hewan berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('hewan.index')->with('error', 'Data hewan gagal dihapus karena masih terkait dengan data lain');
        }
    }
}