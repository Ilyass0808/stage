@extends('layouts.client')

@section('content')
<div class="py-16 min-h-screen bg-gray-50/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between mb-12 border-b border-gray-100 pb-8">
            <div>
                <h2 class="text-[9px] font-black text-[#F53003] tracking-[0.3em] uppercase mb-2">Ma Sélection</h2>
                <h1 class="text-3xl font-black text-gray-900 tracking-tight">Mes <span class="text-[#F53003]">Favoris</span></h1>
            </div>
            <div class="text-gray-400 font-black uppercase tracking-widest text-[9px]">
                {{ count($wishlists) }} {{ count($wishlists) > 1 ? 'Produits' : 'Produit' }}
            </div>
        </div>

        @if($wishlists->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($wishlists as $wishlist)
                    @php $product = $wishlist->product; @endphp
                    <div class="group relative bg-white rounded-[2.5rem] border border-gray-100 overflow-hidden hover:border-[#F53003]/30 transition-all duration-500 hover:shadow-2xl hover:shadow-[#F53003]/5 hover:-translate-y-2">
                        
                        <!-- Remove Button -->
                        <form action="{{ route('wishlist.remove', $product) }}" method="POST" class="absolute top-5 right-5 z-20">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-white/90 backdrop-blur-sm text-[#F53003] p-2.5 rounded-xl shadow-lg border border-gray-100 hover:bg-[#F53003] hover:text-white transition-all transform hover:scale-110" title="Retirer">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" /></svg>
                            </button>
                        </form>

                        <div class="relative aspect-square bg-gray-50/50 overflow-hidden flex items-center justify-center p-8 border-b border-gray-50">
                            @if($product->image)
                                <img src="{{ Str::startsWith($product->image, 'http') ? $product->image : Storage::url($product->image) }}" class="max-w-full max-h-full object-contain group-hover:scale-105 transition-transform duration-700">
                            @else
                                <svg class="w-10 h-10 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            @endif
                            <div class="absolute inset-0 bg-white/20 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            <a href="{{ route('shop.show', $product) }}" class="absolute inset-0 z-10"></a>
                        </div>
                        
                        <div class="p-7">
                            <div class="mb-1.5">
                                <span class="text-[7px] font-black text-[#F53003] uppercase tracking-[0.2em]">{{ $product->category->name }}</span>
                            </div>
                            <a href="{{ route('shop.show', $product) }}" class="block font-black text-gray-900 hover:text-[#F53003] truncate text-base mb-3 transition-colors tracking-tight capitalize">{{ $product->name }}</a>
                            <div class="flex justify-between items-center mb-6">
                                <span class="font-black text-xl text-gray-900 tracking-tighter">{{ number_format($product->price, 2) }} <span class="text-[9px] text-gray-400 ml-0.5">DHS</span></span>
                                <span class="text-[8px] font-black uppercase tracking-widest {{ $product->stock > 0 ? 'text-emerald-500' : 'text-red-500' }}">
                                    {{ $product->stock > 0 ? 'En Stock' : 'Épuisé' }}
                                </span>
                            </div>
                            <form action="{{ route('cart.add', $product) }}" method="POST">
                                @csrf
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" style="background-color: #F53003 !important;" class="w-full text-center py-3.5 text-white text-[9px] font-black uppercase tracking-widest rounded-xl shadow-xl shadow-[#F53003]/20 hover:bg-black transition-all transform hover:-translate-y-1 active:scale-95 disabled:opacity-30 disabled:transform-none" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                    Ajouter au Panier
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-[3.5rem] border border-gray-100 p-24 text-center max-w-3xl mx-auto shadow-xl">
                <div class="mx-auto w-32 h-32 mb-8 bg-gray-50 rounded-full flex items-center justify-center text-[#F53003] relative overflow-hidden">
                    <div class="absolute inset-0 bg-[#F53003]/5 animate-pulse"></div>
                    <svg class="h-12 w-12 relative z-10" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" /></svg>
                </div>
                <h3 class="text-3xl font-black text-gray-900 mb-4 tracking-tight">Votre wishlist est vide</h3>
                <p class="text-gray-400 mb-12 text-lg font-medium">Ajoutez les produits qui vous plaisent pour les retrouver plus tard.</p>
                <a href="{{ route('shop.index') }}" style="background-color: #F53003 !important;" class="inline-flex items-center justify-center px-12 py-5 rounded-2xl shadow-xl shadow-[#F53003]/20 text-sm font-black text-white hover:bg-black transition-all transform hover:-translate-y-1 active:scale-95 uppercase tracking-widest">
                    Explorer la Boutique
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
