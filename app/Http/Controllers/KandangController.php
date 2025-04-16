<?php

namespace App\Http\Controllers;

use App\Models\KandangModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class KandangController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Data Kandang',
            'list' => ['Home', 'Kandang']
        ];

        $page = (object)[
            'title' => 'Data Kandang'
        ];

        $activeMenu = 'kandang';

        return view('kandang.index', compact('breadcrumb', 'page', 'activeMenu'));
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $kandang = KandangModel::select(['id_kandang', 'nama_kandang', 'tipe_kandang', 'kapasitas']);

            return DataTables::of($kandang)
                ->addIndexColumn()
                ->addColumn('aksi', function ($row) {
                    $detailUrl = route('kandang.show', $row->id_kandang);
                    $editUrl = route('kandang.edit', $row->id_kandang);
                    $deleteUrl = route('kandang.destroy', $row->id_kandang);

                    return '
                        <a href="' . $detailUrl . '" class="btn btn-info btn-sm">Detail</a>
                        <a href="' . $editUrl . '" class="btn btn-warning btn-sm">Edit</a>
                        <form action="' . $deleteUrl . '" method="POST" style="display:inline;">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin ingin menghapus?\')">Hapus</button>
                        </form>
                    ';
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
    }

    // Tambahan: CRUD opsional
    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Tambah Kandang',
            'list' => ['Home', 'Kandang', 'Tambah']
        ];
        $page = (object)[
            'title' => 'Form Tambah Kandang'
        ];
        $activeMenu = 'kandang';
        return view('kandang.create', compact('breadcrumb', 'page', 'activeMenu'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama_kandang' => 'required',
            'tipe_kandang' => 'required',
            'kapasitas' => 'required|integer',
        ]);

        KandangModel::create($request->all());

        return redirect()->route('kandang.index')->with('success', 'Data kandang berhasil ditambahkan.');
    }

    public function show($id)
    {
        $kandang = KandangModel::findOrFail($id);
        $breadcrumb = (object)[
            'title' => 'Detail Kandang',
            'list' => ['Home', 'Kandang', 'Detail']
        ];
        $page = (object)[
            'title' => 'Detail Data Kandang'
        ];
        $activeMenu = 'kandang';
        return view('kandang.show', compact('breadcrumb', 'page', 'activeMenu', 'kandang'));
    }


    public function edit($id)
    {
        $kandang = KandangModel::findOrFail($id);
        $breadcrumb = (object)[
            'title' => 'Edit Kandang',
            'list' => ['Home', 'Kandang', 'Edit']
        ];
        $page = (object)[
            'title' => 'Form Edit Kandang'
        ];
        $activeMenu = 'kandang';

        return view('kandang.edit', compact('breadcrumb', 'page', 'activeMenu', 'kandang'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kandang' => 'required',
            'tipe_kandang' => 'required',
            'kapasitas' => 'required|integer',
        ]);

        $kandang = KandangModel::where('id_kandang', $id)->firstOrFail();
        $kandang->update($request->all());

        return redirect()->route('kandang.index')->with('success', 'Data kandang berhasil diupdate.');
    }

    public function destroy($id)
    {
        $kandang = KandangModel::where('id_kandang', $id)->firstOrFail();
        $kandang->delete();

        return redirect()->route('kandang.index')->with('success', 'Data kandang berhasil dihapus.');
    }
}
