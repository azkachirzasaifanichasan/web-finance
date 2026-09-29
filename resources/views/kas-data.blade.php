@extends('layouts.app')

@section('title', 'Student Data')

@section('content')
<div class="max-w-7xl w-full my-5 mx-auto bg-white rounded-2xl p-4 sm:p-8 border border-slate-200 shadow-[0_4px_20px_-2px_rgba(15,23,42,0.05),0_2px_6px_-1px_rgba(15,23,42,0.02)] overflow-x-auto">
    <a href="{{ url('/dashboard') }}" class="inline-flex items-center gap-1.5 text-blue-600 hover:text-blue-700 hover:underline text-xs sm:text-sm font-semibold mb-5 transition-colors">← Back to Dashboard</a>
    
    <div class="flex flex-wrap justify-between items-center mb-6 gap-4">
        <div>
            <span class="inline-block mb-2 text-blue-600 text-[10px] font-extrabold tracking-[0.14em] uppercase">STUDENT DUES</span>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Monthly dues</h1>
            <p class="text-slate-500 mt-1.5 text-xs sm:text-sm">Track each student's monthly payment status.</p>
        </div>
        <div class="flex items-center gap-2 w-full sm:w-auto">
            <input type="text" id="new-month-input" placeholder="e.g. juli" class="px-3.5 py-2 border border-slate-300 rounded-lg bg-white text-slate-900 text-xs sm:text-sm w-full sm:w-40 focus:outline-none focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 transition-all">
            <button class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-xs sm:text-sm font-semibold transition-all hover:shadow-[0_4px_12px_rgba(37,99,235,0.2)] shrink-0" onclick="addMonth()">+ Add month</button>
        </div>
    </div>

    <table class="w-full border-collapse mt-2">
        <thead>
            <tr id="thead-row"></tr>
        </thead>
        <tbody id="tbody"></tbody>
    </table>
</div>

<div id="save-bar" class="fixed bottom-3 sm:bottom-6 left-2 sm:left-1/2 sm:-translate-x-1/2 right-2 sm:right-auto bg-white border border-slate-200 rounded-xl px-3 sm:px-5 py-3 flex items-center justify-between gap-2.5 sm:gap-5 shadow-[0_12px_30px_-4px_rgba(15,23,42,0.12),0_4px_10px_-2px_rgba(15,23,42,0.04)] z-50 hidden">
    <span id="pending-count" class="text-xs sm:text-sm text-amber-600 font-semibold whitespace-nowrap"></span>
    <div class="flex gap-1.5 sm:gap-2">
        <button class="px-2.5 sm:px-4 py-2 bg-slate-100 text-slate-600 hover:bg-slate-200 hover:text-slate-900 border border-slate-300 rounded-lg text-xs font-semibold transition-all" onclick="cancelChanges()">Cancel</button>
        <button class="px-2.5 sm:px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-lg text-xs font-semibold transition-all" onclick="saveChanges()">Save Changes</button>
    </div>
</div>
@endsection