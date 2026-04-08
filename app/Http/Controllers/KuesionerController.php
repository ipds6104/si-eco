<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kuesioner;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KuesionerExport;

class KuesionerController extends Controller
{
    public function index()
    {
        return view('kuesioner.index');
    }

public function store(Request $request)
{

    $data = $request->all();

    // checkbox media komunitas
    if ($request->has('media_komunitas')) {
        $data['media_komunitas'] = collect($request->media_komunitas)->implode(', ');
    }

    // simpan detail media
    if ($request->filled('media_komunitas_detail')) {
        $data['media_komunitas_detail'] = $request->media_komunitas_detail;
    }

    Kuesioner::create($data);

    return redirect()->route('kues.index')
        ->with('success','Kuesioner berhasil disimpan');
}

    public function edit($id)
    {
        $data = Kuesioner::findOrFail($id);

        return view('kuesioner.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Kuesioner::findOrFail($id);

        $updateData = $request->all();

    //     if ($request->has('media_komunitas')) {

    //     if (is_array($request->media_komunitas)) {
    //         $updateData['media_komunitas'] = implode(', ', $request->media_komunitas);
    //     } else {
    //         $updateData['media_komunitas'] = $request->media_komunitas;
    //     }

    // }

    if ($request->has('media_komunitas')) {
    $data['media_komunitas'] = collect($request->media_komunitas)->implode(', ');
}

        $data->update($updateData);

        return redirect()->route('kues.jawaban')
            ->with('success','Data berhasil diupdate');
    }

    // public function jawaban()
    // {
    //     $data = Kuesioner::latest()->get();

    //     return view('kuesioner.jawaban', compact('data'));
    // }

    public function jawaban(Request $request)
    {
        $query = Kuesioner::query();

        // fitur search
        if ($request->search) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $data = $query->latest()->paginate(10);

        return view('kuesioner.jawaban', compact('data'));
    }

    public function show($id)
    {
        $data = Kuesioner::findOrFail($id);

        return view('kuesioner.show', compact('data'));
    }

    public function export()
    {
        $data = \App\Models\Kuesioner::all();

        $fileName = "data_kuesioner.csv";

        $columns = \Schema::getColumnListing('kuesioners');

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
        ];

        $callback = function() use ($data, $columns) {

            $file = fopen('php://output', 'w');

            // header kolom
            fputcsv($file, $columns);

            foreach ($data as $row) {

                $line = [];

                foreach ($columns as $column) {
                    $line[] = $row->$column;
                }

                fputcsv($file, $line);

            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function destroy($id)
    {
        $data = Kuesioner::findOrFail($id);

        $data->delete();

        return redirect()->route('kues.jawaban')
            ->with('success','Data berhasil dihapus');
    }

    public function dashboard()
    {
        $total = Kuesioner::count();

        $usahaDigital = Kuesioner::where('usaha_digital',1)->count();

        $tidakUsaha = Kuesioner::where('usaha_digital',0)->count();

        return view('dashboard', compact(
            'total',
            'usahaDigital',
            'tidakUsaha'
        ));
    }
    
    
}