@extends('layouts.admin')

@section('page_title', 'Tableau de bord')
@section('page_icon')
<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" /></svg>
@endsection

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Products -->
    <div class="bg-white rounded-2xl border border-gray-100 p-6 hover:shadow-xl hover:shadow-[#F53003]/5 transition-all group relative overflow-hidden border-t-4 border-t-[#F53003]">
        <div class="absolute -top-10 -right-10 w-32 h-32 bg-[#F53003]/5 rounded-full blur-3xl"></div>
        <div class="flex items-center justify-between mb-6 relative z-10">
            <div style="background-color: #F53003 !important;" class="p-2.5 rounded-xl text-white shadow-lg shadow-[#F53003]/20 group-hover:scale-110 transition-transform">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
            </div>
            <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Produits</span>
        </div>
        <div class="flex items-end justify-between relative z-10">
            <h3 class="text-3xl font-black text-gray-900 tracking-tighter">{{ $totalProducts }}</h3>
            <div class="text-[8px] font-black text-[#F53003] bg-[#F53003]/10 px-2 py-1 rounded-md uppercase tracking-widest">Stock Actif</div>
        </div>
    </div>
    
    <!-- Total Orders -->
    <div class="bg-white rounded-2xl border border-gray-100 p-6 hover:shadow-xl hover:shadow-emerald-500/5 transition-all group relative overflow-hidden border-t-4 border-t-emerald-500">
        <div class="absolute -top-10 -right-10 w-32 h-32 bg-emerald-50 rounded-full blur-3xl"></div>
        <div class="flex items-center justify-between mb-6 relative z-10">
            <div style="background-color: #10b981 !important;" class="p-2.5 rounded-xl text-white shadow-lg shadow-emerald-500/20 group-hover:scale-110 transition-transform">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
            </div>
            <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Commandes</span>
        </div>
        <div class="flex items-end justify-between relative z-10">
            <h3 class="text-3xl font-black text-gray-900 tracking-tighter">{{ $totalOrders }}</h3>
            <div class="text-[8px] font-black text-emerald-500 bg-emerald-50 px-2 py-1 rounded-md uppercase tracking-widest">Ventes</div>
        </div>
    </div>

    <!-- Total Clients -->
    <div class="bg-white rounded-2xl border border-gray-100 p-6 hover:shadow-xl hover:shadow-blue-500/5 transition-all group relative overflow-hidden border-t-4 border-t-blue-500">
        <div class="absolute -top-10 -right-10 w-32 h-32 bg-blue-50 rounded-full blur-3xl"></div>
        <div class="flex items-center justify-between mb-6 relative z-10">
            <div style="background-color: #3b82f6 !important;" class="p-2.5 rounded-xl text-white shadow-lg shadow-blue-500/20 group-hover:scale-110 transition-transform">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
            </div>
            <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Clients</span>
        </div>
        <div class="flex items-end justify-between relative z-10">
            <h3 class="text-3xl font-black text-gray-900 tracking-tighter">{{ $totalClients }}</h3>
            <div class="text-[8px] font-black text-blue-500 bg-blue-50 px-2 py-1 rounded-md uppercase tracking-widest">Actifs</div>
        </div>
    </div>

    <!-- Revenue -->
    <a href="{{ route('admin.revenue.index') }}" class="bg-white rounded-2xl border border-gray-100 p-6 hover:shadow-xl hover:shadow-amber-500/5 transition-all group relative overflow-hidden border-t-4 border-t-amber-500 block">
        <div class="absolute -top-10 -right-10 w-32 h-32 bg-amber-50 rounded-full blur-3xl"></div>
        <div class="flex items-center justify-between mb-6 relative z-10">
            <div style="background-color: #f59e0b !important;" class="p-2.5 rounded-xl text-white shadow-lg shadow-amber-500/20 group-hover:scale-110 transition-transform">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
            <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Revenus</span>
        </div>
        <div class="flex items-end justify-between relative z-10">
            <h3 class="text-2xl font-black text-gray-900 tracking-tighter">{{ number_format($revenue, 2) }} <span class="text-[7px] text-gray-400 ml-1">DHS</span></h3>
            <div class="text-[8px] font-black text-amber-500 bg-amber-50 px-2 py-1 rounded-md uppercase tracking-widest">Total</div>
        </div>
    </a>
</div>

@endsection
