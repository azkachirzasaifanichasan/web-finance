<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        return response()->json(Expense::orderBy('id')->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'expense_date' => 'required|date',
            'item' => 'required|string|max:100',
            'unit_price' => 'required|numeric|min:1',
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable|string|max:255',
        ]);

        $expense = Expense::create($data);
        return response()->json($expense, 201);
    }

    public function update(Request $request, $id)
    {
        $expense = Expense::findOrFail($id);
        $data = $request->validate([
            'expense_date' => 'required|date',
            'item' => 'required|string|max:100',
            'unit_price' => 'required|numeric|min:1',
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable|string|max:255',
        ]);

        $expense->update($data);
        return response()->json($expense);
    }

    public function destroy($id)
    {
        Expense::findOrFail($id)->delete();
        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}
