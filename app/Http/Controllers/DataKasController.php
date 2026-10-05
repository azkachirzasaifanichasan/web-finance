<?php

namespace App\Http\Controllers;

use App\Models\KasPayment;
use App\Models\Student;
use Illuminate\Http\Request;

class DataKasController extends Controller
{
    public function index()
    {
        $students = Student::with('payments')->orderBy('absen')->get();

        $rows = $students->map(function ($student) {
            $row = [
                'absen' => $student->absen,
                'nis' => $student->nis,
                'nama' => $student->full_name,
            ];
            foreach ($student->payments as $p) {
                $row[$p->month] = (int) $p->amount;
            }
            return $row;
        });

        return response()->json($rows->values());
    }

    public function update(Request $request, $absen, $column)
    {
        $request->validate(['value' => 'required|numeric|min:0|max:10000000']);

        $student = Student::where('absen', $absen)->firstOrFail();
        KasPayment::updateOrCreate(
            ['student_id' => $student->id, 'month' => $column],
            ['amount' => $request->value]
        );

        return response()->json(['message' => 'Berhasil disimpan']);
    }

    public function addColumn(Request $request)
    {
        $request->validate(['column' => 'required|string|max:20']);
        $column = trim($request->column);

        Student::all()->each(function ($student) use ($column) {
            KasPayment::firstOrCreate(
                ['student_id' => $student->id, 'month' => $column],
                ['amount' => 0]
            );
        });

        return response()->json(['message' => 'Kolom ditambahkan']);
    }
}
