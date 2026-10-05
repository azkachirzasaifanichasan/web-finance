<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function index()
    {
        return response()->json(Income::orderBy('id')->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'income_date' => 'required|date',
            'amount' => 'required|numeric|min:1',
            'description' => 'nullable|string|max:255',
        ]);

        $income = Income::create($data);
        return response()->json($income, 201);
    }

    public function update(Request $request, $id)
    {
        $income = Income::findOrFail($id);
        $data = $request->validate([
            'income_date' => 'required|date',
            'amount' => 'required|numeric|min:1',
            'description' => 'nullable|string|max:255',
        ]);

        $income->update($data);
        return response()->json($income);
    }

    public function destroy($id)
    {
        Income::findOrFail($id)->delete();
        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}
