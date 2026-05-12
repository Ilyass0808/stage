@extends('layouts.admin')

@section('page_title', 'Commande #' . $order->id)
@section('page_icon')
<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
@endsection

@section('content')
<div class="max-w-4xl">
    <div class="mb-4 border-b border-gray-100 pb-3">
        <a href="{{ route('admin.orders.index') }}" class="text-[#F53003] hover:text-black font-black flex items-center text-[6px] uppercase tracking-widest mb-1.5 transition-colors">
            <svg class="w-2 h-2 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" /></svg>
            RETOUR
        </a>
        <h1 class="text-lg font-black text-gray-900 tracking-tight leading-none">Détails <span class="text-[#F53003]">Commande</span></h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
        <!-- Items Section -->
        <div class="lg:col-span-3">
            <div class="bg-white rounded-lg border border-gray-100 p-3 shadow-sm overflow-hidden">
                <h3 class="text-[7px] font-black text-gray-900 uppercase tracking-widest mb-3 border-l-2 border-[#F53003] pl-2">Articles</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse table-fixed">
                        <thead>
                            <tr class="text-[6px] font-black text-gray-300 uppercase tracking-widest border-b border-gray-50">
                                <th class="pb-2 w-1/2">Produit</th>
                                <th class="pb-2 w-1/4">Prix</th>
                                <th class="pb-2 w-12 text-center">Qté</th>
                                <th class="pb-2 text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach($order->items as $item)
                                <tr class="group hover:bg-gray-50/50 transition-colors">
                                    <td class="py-2">
                                        <div class="flex items-center space-x-2 overflow-hidden">
                                            <div class="h-6 w-6 rounded bg-gray-50 p-0.5 border border-gray-100 flex-shrink-0">
                                                @if($item->product->image)
                                                    <img src="{{ Storage::url($item->product->image) }}" class="h-full w-full object-contain">
                                                @else
                                                    <div class="h-full w-full flex items-center justify-center text-gray-300">
                                                        <svg class="w-2.5 h-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="min-w-0">
                                                <div class="font-black text-gray-900 text-[8px] truncate capitalize leading-tight">{{ $item->product->name }}</div>
                                                <div class="text-[6px] font-black text-gray-400 uppercase">#{{ $item->product->id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-2">
                                        <div class="font-black text-gray-900 text-[8px] tracking-tighter">{{ number_format($item->product->price, 0) }}<span class="text-[5px] text-gray-400 ml-0.5">DHS</span></div>
                                    </td>
                                    <td class="py-2 text-center">
                                        <span class="font-black text-[8px] text-gray-900">{{ $item->quantity }}</span>
                                    </td>
                                    <td class="py-2 text-right">
                                        <div class="font-black text-[#F53003] text-[8px] tracking-tighter">{{ number_format($item->subtotal, 0) }}<span class="text-[5px] opacity-60 ml-0.5">DHS</span></div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Summary Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg border border-gray-100 p-3 shadow-sm h-full flex flex-col justify-between">
                <div class="space-y-3">
                    <h3 class="text-[7px] font-black text-gray-900 uppercase tracking-widest border-l-2 border-[#F53003] pl-2 mb-3">Résumé</h3>
                    <div>
                        <p class="text-[6px] font-black text-gray-400 uppercase mb-0.5">Client</p>
                        <p class="font-black text-gray-900 text-[8px] truncate">{{ $order->user->name }}</p>
                    </div>
                    <div class="pt-2 border-t border-gray-50">
                        <p class="text-[6px] font-black text-[#F53003] uppercase mb-0.5">Total</p>
                        <div class="flex items-baseline space-x-0.5">
                            <span class="text-sm font-black text-gray-900 tracking-tighter">{{ number_format($order->total, 0) }}</span>
                            <span class="text-[6px] font-black text-gray-400">DHS</span>
                        </div>
                    </div>
                </div>

                <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" class="mt-4 space-y-2">
                    @csrf
                    @method('PATCH')
                    <div class="relative">
                        <select name="status" class="w-full bg-gray-50 border border-gray-100 rounded py-1.5 px-2 text-gray-900 font-black text-[7px] appearance-none uppercase tracking-widest outline-none">
                            <option value="en attente" {{ $order->status == 'en attente' ? 'selected' : '' }}>Attente</option>
                            <option value="expédiée" {{ $order->status == 'expédiée' ? 'selected' : '' }}>Expédiée</option>
                            <option value="livrée" {{ $order->status == 'livrée' ? 'selected' : '' }}>Livrée</option>
                        </select>
                        <div class="absolute right-2 top-1/2 -translate-y-1/2 pointer-events-none text-gray-300">
                            <svg class="w-2 h-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" /></svg>
                        </div>
                    </div>
                    <button type="submit" style="background-color: #F53003 !important;" class="w-full text-white font-black py-1.5 rounded shadow-sm text-[7px] uppercase tracking-widest active:scale-95 transition-all">
                        OK
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
  </div>
</div>
  </div>
</div>
@endsection
