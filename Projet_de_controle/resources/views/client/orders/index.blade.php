@extends('layouts.client')

@section('content')
<div class="py-16 min-h-screen bg-gray-50/30">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between mb-12 border-b border-gray-100 pb-8">
            <div>
                <h2 class="text-[10px] font-black text-[#F53003] tracking-[0.3em] uppercase mb-2">Historique</h2>
                <h1 class="text-4xl font-black text-gray-900 tracking-tight">Mes <span class="text-[#F53003]">Commandes</span></h1>
            </div>
            <div class="text-gray-400 font-black uppercase tracking-widest text-[10px]">
                {{ count($orders) }} Commandes
            </div>
        </div>

        @if(count($orders) > 0)
            <div class="bg-white rounded-[2.5rem] border border-gray-100 overflow-hidden shadow-xl">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50 border-b border-gray-100 text-gray-400 text-[9px] font-black uppercase tracking-[0.2em]">
                                <th class="py-6 px-8">N° Commande</th>
                                <th class="py-6 px-8">Date d'achat</th>
                                <th class="py-6 px-8">Montant Total</th>
                                <th class="py-6 px-8">Statut Actuel</th>
                                <th class="py-6 px-8 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-900 text-sm divide-y divide-gray-50">
                            @foreach($orders as $order)
                            <tr class="hover:bg-gray-50 transition-colors group">
                                <td class="py-6 px-8 font-black text-gray-900 tracking-tight text-xs">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</td>
                                <td class="py-6 px-8 text-gray-400 font-bold text-[10px] uppercase tracking-tight">{{ $order->created_at->format('d/m/Y à H:i') }}</td>
                                <td class="py-6 px-8 font-black text-[#F53003] text-sm">{{ number_format($order->total, 2) }} <span class="text-[9px] text-gray-400 ml-1">DHS</span></td>
                                <td class="py-6 px-8">
                                    @php
                                        $statusClasses = [
                                            'en attente' => 'bg-amber-50 text-amber-600 border-amber-100',
                                            'expédiée'   => 'bg-blue-50 text-blue-600 border-blue-100',
                                            'livrée'     => 'bg-emerald-50 text-emerald-600 border-emerald-100'
                                        ];
                                    @endphp
                                    <span class="px-2.5 py-1 rounded-md text-[7px] font-black uppercase tracking-widest border {{ $statusClasses[$order->status] ?? 'bg-gray-50 text-gray-600 border-gray-100' }}">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td class="py-6 px-8 text-right">
                                    <a href="{{ route('orders.show', $order) }}" style="background-color: #F53003 !important;" class="inline-flex items-center px-2.5 py-1 rounded-md text-white text-[7px] font-black uppercase tracking-widest shadow-lg shadow-[#F53003]/10 hover:bg-black transition-all transform hover:scale-105 active:scale-95">
                                        Détails
                                        <svg class="ml-1 w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/></svg>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="bg-white rounded-[3.5rem] border border-gray-100 p-24 text-center max-w-3xl mx-auto shadow-xl">
                <div class="mx-auto w-32 h-32 mb-8 bg-gray-50 rounded-full flex items-center justify-center text-[#F53003] relative overflow-hidden">
                    <div class="absolute inset-0 bg-[#F53003]/5 animate-pulse"></div>
                    <svg class="h-12 w-12 relative z-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                </div>
                <h3 class="text-3xl font-black text-gray-900 mb-4 tracking-tight">Aucune commande</h3>
                <p class="text-gray-400 mb-12 text-lg font-medium">Commencez votre expérience shopping dès maintenant.</p>
                <a href="{{ route('shop.index') }}" style="background-color: #F53003 !important;" class="inline-flex items-center justify-center px-12 py-5 rounded-2xl shadow-xl shadow-[#F53003]/20 text-sm font-black text-white hover:bg-black transition-all transform hover:-translate-y-1 active:scale-95 uppercase tracking-widest">
                    Découvrir nos produits
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
