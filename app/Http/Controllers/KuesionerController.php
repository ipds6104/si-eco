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
        $kabupatens = \App\Models\Region::where('type', 'KABUPATEN')->get();
        return view('kuesioner.index', compact('kabupatens'));
    }

    public function getRegions($parentId)
    {
        $regions = \App\Models\Region::where('parent_id', $parentId)->get();
        return response()->json($regions);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        // Handle File Upload
        if ($request->hasFile('foto_rumah')) {
            $file = $request->file('foto_rumah');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('uploads/foto_rumah', $fileName, 'public');
            $data['foto_rumah'] = $path;
        }

        // Checkbox fields (Arrays)
        $arrayFields = [
            'media_komunitas', 
            'platform_digital', 
            'platform_digital_v2', 
            'metode_pembayaran_digital', 
            'software_operasional', 
            'sumber_penghasilan_digital',
            'kendala'
        ];
        
        foreach ($arrayFields as $field) {
            if ($request->has($field)) {
                $data[$field] = collect($request->$field)->implode(', ');
            }
        }

        // Handle Kendala Lainnya (if 'Lainnya' is selected in checkboxes)
        if ($request->filled('kendala_lainnya') && $request->has('kendala') && in_array('Lainnya', (array)$request->kendala)) {
            $data['kendala'] = str_replace('Lainnya', 'Lainnya: ' . $request->kendala_lainnya, $data['kendala']);
        }

        // Add default values for fields removed from the form but required by DB
        $data['ikut_komunitas'] = $data['ikut_komunitas'] ?? 'tidak';
        $data['is_producer'] = $data['is_producer'] ?? 0;
        $data['proporsi_pendapatan_digital'] = $data['proporsi_pendapatan_digital'] ?? '0%';

        Kuesioner::create($data);

        return redirect()->route('kues.index')
            ->with('success', 'Kuesioner berhasil disimpan. Terima kasih atas partisipasi Anda.');
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

        // Checkbox fields (Arrays)
        $arrayFields = [
            'media_komunitas', 
            'platform_digital', 
            'platform_digital_v2', 
            'metode_pembayaran_digital', 
            'software_operasional', 
            'sumber_penghasilan_digital',
            'kendala'
        ];
        foreach ($arrayFields as $field) {
            if ($request->has($field)) {
                $updateData[$field] = collect($request->$field)->implode(', ');
            }
        }
        // Handle Kendala Lainnya (if 'Lainnya' is selected in checkboxes)
        if ($request->filled('kendala_lainnya') && $request->has('kendala') && in_array('Lainnya', (array)$request->kendala)) {
            $updateData['kendala'] = str_replace('Lainnya', 'Lainnya: ' . $request->kendala_lainnya, $updateData['kendala']);
        }

        $data->update($updateData);

        return redirect()->route('kues.jawaban')
            ->with('success', 'Data berhasil diupdate');
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
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
        ];

        $callback = function() use ($data, $columns) {

            $file = fopen('php://output', 'w');

            // header kolom
            fputcsv($file, $columns);

            foreach ($data as $row) {

                $line = [];

                foreach ($columns as $column) {
                    // Konversi foto_rumah menjadi URL publik lengkap
                    if ($column === 'foto_rumah' && !empty($row->$column)) {
                        $line[] = url('storage/' . $row->$column);
                    } else {
                        $line[] = $row->$column;
                    }
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

}