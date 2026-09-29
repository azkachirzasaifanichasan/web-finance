@extends('layouts.app')

@section('title', 'Income')

@section('content')
<div class="max-w-7xl w-full my-5 mx-auto bg-white rounded-2xl p-4 sm:p-8 border border-slate-200 shadow-[0_4px_20px_-2px_rgba(15,23,42,0.05),0_2px_6px_-1px_rgba(15,23,42,0.02)] overflow-x-auto">
    <a href="{{ url('/dashboard') }}" class="inline-flex items-center gap-1.5 text-blue-600 hover:text-blue-700 hover:underline text-xs sm:text-sm font-semibold mb-5 transition-colors">← Back to Dashboard</a>
    
    <div class="flex flex-wrap justify-between items-center mb-6 gap-4">
        <div>
            <span class="inline-block mb-2 text-blue-600 text-[10px] font-extrabold tracking-[0.14em] uppercase">CASH FLOW</span>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Income</h1>
        </div>
        <button class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-xs sm:text-sm font-semibold transition-all hover:shadow-[0_4px_12px_rgba(37,99,235,0.2)]" onclick="showAddForm()">+ Add income</button>
    </div>

    <div id="add-form" class="bg-slate-50 border border-slate-200 rounded-xl p-5 sm:p-6 mb-6 hidden">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-5">
            <div class="flex flex-col gap-1">
                <label class="text-[11px] text-slate-600 font-bold uppercase tracking-wider">ID</label>
                <input type="text" id="add-id" readonly class="px-3.5 py-2 border border-slate-300 rounded-lg bg-slate-100 text-slate-500 text-xs sm:text-sm w-full cursor-not-allowed">
            </div>
            <div class="flex flex-col gap-1">
                <label class="text-[11px] text-slate-600 font-bold uppercase tracking-wider">Date</label>
                <input type="date" id="add-tanggal" class="px-3.5 py-2 border border-slate-300 rounded-lg bg-white text-slate-900 text-xs sm:text-sm w-full focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 transition-all">
                <span class="text-xs text-red-500 min-h-[14px]" id="err-tanggal"></span>
            </div>
            <div class="flex flex-col gap-1">
                <label class="text-[11px] text-slate-600 font-bold uppercase tracking-wider">Amount (Rp)</label>
                <input type="number" id="add-nominal" placeholder="e.g. 50000" min="1" class="px-3.5 py-2 border border-slate-300 rounded-lg bg-white text-slate-900 text-xs sm:text-sm w-full focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 transition-all [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                <span class="text-xs text-red-500 min-h-[14px]" id="err-nominal"></span>
            </div>
            <div class="flex flex-col gap-1">
                <label class="text-[11px] text-slate-600 font-bold uppercase tracking-wider">Description <span class="font-normal text-slate-400 lowercase">(opsional)</span></label>
                <input type="text" id="add-keterangan" placeholder="Keterangan tambahan" class="px-3.5 py-2 border border-slate-300 rounded-lg bg-white text-slate-900 text-xs sm:text-sm w-full focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 transition-all">
            </div>
        </div>
        <div class="flex gap-2 mt-3">
            <button class="px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-lg text-xs sm:text-sm font-semibold transition-all" onclick="addData()">Save</button>
            <button class="px-4 py-2 bg-slate-100 text-slate-600 hover:bg-slate-200 hover:text-slate-900 border border-slate-200 rounded-lg text-xs sm:text-sm font-semibold transition-all" onclick="hideAddForm()">Cancel</button>
        </div>
    </div>

    <table class="w-full border-collapse mt-2 table-fixed min-w-[600px]">
        <thead>
            <tr>
                <th class="w-[100px] text-center px-3.5 py-3 border-y border-slate-200 text-slate-600 bg-slate-50 font-bold uppercase text-[11px] tracking-wider rounded-l-lg">ID</th>
                <th class="w-[120px] text-center px-3.5 py-3 border-y border-slate-200 text-slate-600 bg-slate-50 font-bold uppercase text-[11px] tracking-wider">Date</th>
                <th class="w-[130px] text-center px-3.5 py-3 border-y border-slate-200 text-slate-600 bg-slate-50 font-bold uppercase text-[11px] tracking-wider">Amount</th>
                <th class="w-auto text-left px-3.5 py-3 border-y border-slate-200 text-slate-600 bg-slate-50 font-bold uppercase text-[11px] tracking-wider">Description</th>
                <th class="w-[140px] text-center px-3.5 py-3 border-y border-slate-200 text-slate-600 bg-slate-50 font-bold uppercase text-[11px] tracking-wider rounded-r-lg">Action</th>
            </tr>
        </thead>
        <tbody id="tbody"></tbody>
    </table>
</div>
@endsection