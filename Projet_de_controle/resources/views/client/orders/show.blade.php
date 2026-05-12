@extends('layouts.client')

@section('content')
<div class="py-16 min-h-screen bg-gray-50/30">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-12 border-b border-gray-100 pb-8">
            <div>
                <h2 class="text-[10px] font-black text-[#F53003] tracking-[0.3em] uppercase mb-2">Détails Commande</h2>
                <h1 class="text-4xl font-black text-gray-900 tracking-tight">Commande <span class="text-[#F53003]">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</span></h1>
            </div>
            <a href="{{ route('orders.index') }}" class="inline-flex items-center text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-[#F53003] transition-colors">
                <svg class="mr-2 w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/></svg>
                Retour
            </a>
        </div>

        <div class="bg-white rounded-[2.5rem] border border-gray-100 p-10 shadow-xl">
            <div class="flex flex-col sm:flex-row justify-between border-b border-gray-50 pb-10 mb-10 gap-8">
                <div>
                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest block mb-2">Date d'Achat</span>
                    <span class="font-black text-gray-900 text-lg uppercase">{{ $order->created_at->format('d/m/Y à H:i') }}</span>
                </div>
                <div>
                    <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest block mb-2">Statut Actuel</span>
                    @php
                        $statusClasses = [
                            'en attente' => 'bg-amber-50 text-amber-600 border-amber-100',
                            'expédiée'   => 'bg-blue-50 text-blue-600 border-blue-100',
                            'livrée'     => 'bg-emerald-50 text-emerald-600 border-emerald-100'
                        ];
                    @endphp
                    <span class="px-2.5 py-1 rounded-md text-[7px] font-black uppercase tracking-widest border inline-block {{ $statusClasses[$order->status] ?? 'bg-gray-50 text-gray-600 border-gray-100' }}">
                        {{ $order->status }}
                    </span>
                </div>
                <div class="sm:text-right">
                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest block mb-2">Total Payé</span>
                    <span class="font-black text-[#F53003] text-3xl">{{ number_format($order->total, 2) }} <span class="text-xs text-gray-400 ml-1">DHS</span></span>
                </div>
            </div>

            <h3 class="text-lg font-black text-gray-900 mb-8 flex items-center uppercase tracking-tight">
                <svg class="w-5 h-5 mr-3 text-[#F53003]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                Articles de la Commande
            </h3>
            <ul class="divide-y divide-gray-50 space-y-4">
                @foreach($order->items as $item)
                    <li class="py-6 flex justify-between items-center group">
                        <div class="flex items-center space-x-6">
                            <div class="h-20 w-20 flex-shrink-0 bg-gray-50 rounded-2xl overflow-hidden border border-gray-100 p-2 group-hover:scale-105 transition-transform duration-500">
                                @if($item->product->image)
                                    <img src="{{ Storage::url($item->product->image) }}" class="h-full w-full object-contain">
                                @else
                                    <div class="h-full w-full flex items-center justify-center text-[9px] text-gray-400 font-black">IMAGE N/A</div>
                                @endif
                            </div>
                            <div>
                                <h4 class="text-lg font-black text-gray-900 group-hover:text-[#F53003] transition-colors leading-tight">{{ $item->product->name }}</h4>
                                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mt-2">Quantité: <span class="text-[#F53003]">{{ $item->quantity }}</span></p>
                            </div>
                        </div>
                        <div class="text-xl font-black text-gray-900 tracking-tighter">
                            {{ number_format($item->subtotal, 2) }} <span class="text-[10px] text-gray-400 ml-1">DHS</span>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
