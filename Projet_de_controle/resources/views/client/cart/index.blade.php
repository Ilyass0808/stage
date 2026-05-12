@extends('layouts.client')

@section('content')
<div class="py-12 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-2xl px-4 sm:px-6">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-black text-gray-900 tracking-tight">Mon <span class="text-[#F53003]">Panier</span></h1>
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mt-2">{{ count($cart) }} Articles sélectionnés</p>
        </div>

        @if(count($cart) > 0)
            <!-- Single Card Container -->
            <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-2xl overflow-hidden">
                <!-- Products List -->
                <div class="p-8 space-y-4">
                    @foreach($cart as $id => $item)
                        <div class="flex items-center gap-4 py-2">
                            <!-- Small Image -->
                            <div class="h-16 w-16 flex-shrink-0 bg-gray-50 rounded-xl overflow-hidden flex items-center justify-center border border-gray-50 p-2">
                                @if($item['image'])
                                    <img src="{{ Str::startsWith($item['image'], 'http') ? $item['image'] : Storage::url($item['image']) }}" 
                                         class="max-h-full max-w-full object-contain">
                                @endif
                            </div>

                            <!-- Details -->
                            <div class="flex-1 min-w-0">
                                <h3 class="text-sm font-black text-gray-900 truncate leading-tight">{{ $item['name'] }}</h3>
                                <div class="flex items-center gap-3 mt-1">
                                    <span class="text-[9px] font-black text-[#F53003]">{{ number_format($item['price'], 2) }} DHS</span>
                                    <span class="text-[8px] text-gray-300 font-bold uppercase tracking-widest">Qté: {{ $item['quantity'] }}</span>
                                </div>
                            </div>

                            <!-- Delete -->
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-300 hover:text-red-500 transition-colors">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>

                <!-- Divider -->
                <div class="border-t border-gray-50"></div>

                <!-- Summary & Action -->
                <div class="bg-gray-50/50 p-8">
                    <div class="space-y-3 mb-8">
                        <div class="flex justify-between items-center text-[10px] font-black text-gray-400 uppercase tracking-widest">
                            <span>Sous-total</span>
                            <span class="text-gray-900">{{ number_format($total, 2) }} DHS</span>
                        </div>
                        <div class="flex justify-between items-center text-[10px] font-black text-gray-400 uppercase tracking-widest">
                            <span>Livraison</span>
                            <span class="text-emerald-500">Gratuite</span>
                        </div>
                        <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                            <span class="text-xs font-black text-gray-900 uppercase tracking-[0.2em]">Total</span>
                            <span class="text-3xl font-black text-[#F53003] tracking-tighter">{{ number_format($total, 2) }} <span class="text-[10px] text-gray-400 font-bold ml-1">DHS</span></span>
                        </div>
                    </div>

                    <a href="{{ route('checkout.index') }}" style="background-color: #F53003 !important;" class="w-full flex justify-center items-center py-5 rounded-2xl shadow-xl shadow-[#F53003]/20 text-xs font-black text-white hover:bg-black transition-all transform hover:-translate-y-1 active:scale-95 uppercase tracking-widest">
                        Valider la commande
                    </a>
                    
                    <div class="mt-6 text-center">
                        <a href="{{ route('shop.index') }}" class="text-[9px] font-black text-gray-300 hover:text-[#F53003] uppercase tracking-widest transition-colors">
                            ← Continuer mes achats
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="bg-white rounded-[2.5rem] border border-gray-100 p-16 text-center shadow-xl">
                <div class="mx-auto w-20 h-20 mb-6 bg-gray-50 rounded-full flex items-center justify-center text-gray-200">
                    <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                </div>
                <h2 class="text-2xl font-black text-gray-900 mb-2">Panier vide</h2>
                <p class="text-gray-400 mb-8 text-sm font-bold">Votre panier attend d'être rempli.</p>
                <a href="{{ route('shop.index') }}" style="background-color: #F53003 !important;" class="inline-flex px-8 py-4 rounded-xl text-[10px] font-black text-white uppercase tracking-widest shadow-lg shadow-[#F53003]/20 transition-all transform hover:-translate-y-1">
                    Boutique
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

