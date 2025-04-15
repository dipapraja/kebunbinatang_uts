<?php

namespace App\Http\Controllers;

use App\Models\HewanModel;
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

//     public function list(Request $request)
// {
//     $hewan = HewanModel::select('id_hewan', 'nama_hewan','spesies', 'jenis_kelamin', 'tanggal_lahir','id_kandang')->with('kandang');
// if ($request->id_kandang) {
//     $hewan->where('id_kandang', $request->id_kandang);
// }
// return DataTables::of($hewan)
// ->addIndexColumn()
// ->addColumn('kandang_nama', function ($h) {
//     return $h->kandang->kandang_nama ?? '-';
// })
// ->addColumn('aksi', function ($hewan) {
//     $btn  = '<button onclick="modalAction(\'' . url('/hewan/' . $hewan->id_hewan .
//         '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
//     $btn .= '<button onclick="modalAction(\'' . url('/hewan/' . $hewan->id_hewan .
//         '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
//     $btn .= '<button onclick="modalAction(\'' . url('/hewan/' . $hewan->id_hewan .
//         '/delete_ajax') . '\')"  class="btn btn-danger btn-sm">Hapus</button> ';
//     return $btn;
// })
// ->rawColumns(['aksi'])
// ->make(true);


// }

// public function list(Request $request)
// {
//     $query = HewanModel::with('kandang'); // ✅ Ganti 'Hewan' jadi 'HewanModel'

//     if ($request->id_kandang) {
//         $query->where('id_kandang', $request->id_kandang);
//     }

//     return DataTables::of($query)
//         ->addIndexColumn()
//         ->addColumn('aksi', function($row){
//             return '<a href="'.url('hewan/'.$row->id_hewan.'/edit').'" class="btn btn-sm btn-warning">Edit</a>
//                     <a href="'.url('hewan/'.$row->id_hewan).'" class="btn btn-sm btn-danger" onclick="return confirm(\'Yakin?\')">Hapus</a>';
//         })
//         ->editColumn('id_kandang', function ($row) {
//             return $row->kandang->nama_kandang ?? '-';
//         })
//         ->rawColumns(['aksi'])
//         ->make(true);
// }
public function list(Request $request)
{
    $hewan = HewanModel::with('kandang')->get();

    return datatables()->of($hewan)
        ->addColumn('kandang', function($hewan) {
            return $hewan->kandang->nama_kandang;  // Ambil nama kandang
        })
        ->addIndexColumn()  // Menambahkan kolom No
        ->addColumn('aksi', function($row) {
            return '<a href="'.url('hewan/'.$row->id_hewan.'/edit').'" class="btn btn-sm btn-warning">Edit</a>
                     <a href="'.url('hewan/'.$row->id_hewan).'" class="btn btn-sm btn-danger" onclick="return confirm(\'Yakin?\')">Hapus</a>';
        })
        ->rawColumns(['aksi'])
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

        $kategori = KategoriModel::all();
        $activeMenu = 'hewan';

        return view('hewan.create', [
            'breadcrumb' => $breadcrumb,
            'page'       => $page,
            'kategori'   => $kategori,
            'activeMenu' => $activeMenu
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_hewan'    => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:Jantan,Betina',
            'kategori_id'   => 'required|integer|exists:kategori,kategori_id'
        ]);

        HewanModel::create([
            'nama_hewan'    => $request->nama_hewan,
            'jenis_kelamin' => $request->jenis_kelamin,
            'kategori_id'   => $request->kategori_id
        ]);

        return redirect()->route('hewan.index')->with('success', 'Data hewan berhasil disimpan');
    }

    public function show(string $id)
    {
        $hewan = HewanModel::with('kategori')->findOrFail($id);

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
        $kategori = KategoriModel::all();

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
            'kategori'   => $kategori,
            'activeMenu' => $activeMenu
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_hewan'    => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:Jantan,Betina',
            'kategori_id'   => 'required|integer|exists:kategori,kategori_id'
        ]);

        HewanModel::findOrFail($id)->update([
            'nama_hewan'    => $request->nama_hewan,
            'jenis_kelamin' => $request->jenis_kelamin,
            'kategori_id'   => $request->kategori_id
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