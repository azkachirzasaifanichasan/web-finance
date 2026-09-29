@extends('layouts.app')

@section('title', 'Class Finance Dashboard')

@section('content')
<div class="max-w-7xl w-full my-5 mx-auto bg-white rounded-2xl p-5 sm:p-8 border border-slate-200 shadow-[0_18px_45px_-28px_rgba(15,23,42,0.35)] overflow-x-auto">
    <div class="mb-7">
        <span class="inline-block mb-2 text-blue-600 text-[10px] font-extrabold tracking-[0.14em] uppercase">CLASS ADMINISTRATION</span>
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Class Finance</h1>
        <p class="text-slate-500 mt-1 text-sm">Keep every class transaction organized in one place.</p>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-5">
        <a href="{{ url('/data-kas') }}" class="bg-white border border-slate-200 rounded-xl p-5 sm:p-7 text-left no-underline text-slate-900 hover:border-blue-600 hover:bg-slate-50 hover:-translate-y-1 hover:shadow-[0_12px_24px_-8px_rgba(37,99,235,0.12)] transition-all duration-200 shadow-[0_1px_3px_rgba(0,0,0,0.02)] block">
            <span class="inline-flex items-center justify-center w-[34px] h-[34px] mb-7 rounded-lg bg-blue-50 text-blue-600 text-[11px] font-extrabold">01</span>
            <div class="font-bold text-base text-slate-900 mb-1.5">Student dues</div>
            <div class="text-xs sm:text-sm text-slate-500">Manage student list</div>
        </a>
        <a href="{{ url('/pemasukan') }}" class="bg-white border border-slate-200 rounded-xl p-5 sm:p-7 text-left no-underline text-slate-900 hover:border-blue-600 hover:bg-slate-50 hover:-translate-y-1 hover:shadow-[0_12px_24px_-8px_rgba(37,99,235,0.12)] transition-all duration-200 shadow-[0_1px_3px_rgba(0,0,0,0.02)] block">
            <span class="inline-flex items-center justify-center w-[34px] h-[34px] mb-7 rounded-lg bg-blue-50 text-blue-600 text-[11px] font-extrabold">02</span>
            <div class="font-bold text-base text-slate-900 mb-1.5">Income</div>
            <div class="text-xs sm:text-sm text-slate-500">Manage income records</div>
        </a>
        <a href="{{ url('/pengeluaran') }}" class="bg-white border border-slate-200 rounded-xl p-5 sm:p-7 text-left no-underline text-slate-900 hover:border-blue-600 hover:bg-slate-50 hover:-translate-y-1 hover:shadow-[0_12px_24px_-8px_rgba(37,99,235,0.12)] transition-all duration-200 shadow-[0_1px_3px_rgba(0,0,0,0.02)] block">
            <span class="inline-flex items-center justify-center w-[34px] h-[34px] mb-7 rounded-lg bg-blue-50 text-blue-600 text-[11px] font-extrabold">03</span>
            <div class="font-bold text-base text-slate-900 mb-1.5">Expenses</div>
            <div class="text-xs sm:text-sm text-slate-500">Manage expense records</div>
        </a>
    </div>
</div>
@endsection