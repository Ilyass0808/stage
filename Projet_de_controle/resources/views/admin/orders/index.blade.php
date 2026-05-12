@extends('layouts.admin')
@section('page_title', 'Commandes')
@section('page_icon')
<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
@endsection

@section('content')
<div class="mb-12 flex flex-col sm:flex-row justify-between items-start sm:items-end border-b border-gray-100 pb-8">
    <div>
        <h2 class="text-[9px] font-black text-[#F53003] tracking-[0.3em] uppercase mb-2">Opérations</h2>
        <h1 class="text-4xl font-black text-gray-900 tracking-tight">Suivi des <span class="text-[#F53003]">Commandes</span></h1>
    </div>
</div>

<div class="bg-white rounded-[2.5rem] border border-gray-100 overflow-hidden shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50/50 border-b border-gray-100">
                    <th class="px-8 py-6 text-xs font-black text-gray-500 uppercase tracking-[0.2em]">N° Commande</th>
                    <th class="px-8 py-6 text-xs font-black text-gray-500 uppercase tracking-[0.2em]">Client</th>
                    <th class="px-8 py-6 text-xs font-black text-gray-500 uppercase tracking-[0.2em]">Montant Total</th>
                    <th class="px-8 py-6 text-xs font-black text-gray-500 uppercase tracking-[0.2em]">État Actuel</th>
                    <th class="px-8 py-6 text-xs font-black text-gray-500 uppercase tracking-[0.2em]">Date d'Enregistrement</th>
                    <th class="px-8 py-6 text-xs font-black text-gray-500 uppercase tracking-[0.2em] text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 text-gray-900">
                @foreach($orders as $order)
                <tr class="hover:bg-gray-50 transition-colors group">
                    <td class="px-8 py-6">
                        <span class="text-gray-400 font-black text-xs">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</span>
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex items-center">
                            <div class="h-10 w-10 rounded-xl bg-[#F53003]/5 text-[#F53003] flex items-center justify-center font-black text-xs mr-4 border border-[#F53003]/10">
                                {{ substr($order->user->name, 0, 1) }}
                            </div>
                            <span class="text-sm font-black text-gray-900 capitalize">{{ $order->user->name }}</span>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <div class="text-base font-black text-gray-900 tracking-tighter">{{ number_format($order->total, 2) }} <span class="text-[10px] text-gray-400 ml-1">DHS</span></div>
                    </td>
                    <td class="px-8 py-6">
                        @php
                            $statusConfig = [
                                'en attente' => ['bg' => 'bg-amber-50', 'text' => 'text-amber-600', 'border' => 'border-amber-100'],
                                'expédiée' => ['bg' => 'bg-blue-50', 'text' => 'text-blue-600', 'border' => 'border-blue-100'],
                                'livrée' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-600', 'border' => 'border-emerald-100']
                            ];
                            $config = $statusConfig[$order->status] ?? ['bg' => 'bg-gray-50', 'text' => 'text-gray-400', 'border' => 'border-gray-100'];
                        @endphp
                        <span class="inline-flex items-center px-4 py-1.5 rounded-md text-[10px] font-black {{ $config['bg'] }} {{ $config['text'] }} {{ $config['border'] }} border uppercase tracking-widest">
                            <span class="w-1.5 h-1.5 rounded-full {{ $config['text'] }} bg-current mr-2"></span>
                            {{ $order->status }}
                        </span>
                    </td>
                    <td class="px-8 py-6">
                        <div class="text-[10px] font-black text-gray-900 uppercase tracking-tight">{{ $order->created_at->format('d/m/Y') }}</div>
                        <div class="text-[9px] text-gray-400 font-bold mt-1">{{ $order->created_at->format('H:i') }}</div>
                    </td>
                    <td class="px-8 py-6 text-right">
                        <a href="{{ route('admin.orders.show', $order) }}" style="background-color: #F53003 !important;" class="inline-flex items-center px-6 py-2.5 rounded-xl text-white font-black text-[10px] uppercase tracking-widest shadow-lg shadow-[#F53003]/10 hover:bg-black transition-all transform hover:scale-105 active:scale-95">
                            Détails
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if($orders->hasPages())
    <div class="px-8 py-6 border-t border-gray-100 bg-gray-50/30">
        {{ $orders->links() }}
    </div>
    @endif
</div>
@endsection
