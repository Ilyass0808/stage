@extends('layouts.client')

@section('content')
<div class="relative overflow-hidden bg-white py-16 border-b border-gray-100">
    <div class="absolute inset-0 bg-gradient-to-r from-[#F53003]/5 to-transparent opacity-50"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <h1 class="text-4xl font-black text-gray-900 mb-2 tracking-tight">Notre <span class="text-[#F53003]">Boutique</span></h1>
        <p class="text-gray-600 font-medium">Retrouvez tous nos produits exceptionnels dans un seul endroit.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
        <!-- Sidebar filters -->
        <div class="lg:col-span-1">
            <div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 sticky top-28 shadow-2xl shadow-gray-200/50">
                <form action="{{ route('shop.index') }}" method="GET" class="space-y-10">
                    <div>
                        <h3 class="text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-6 flex items-center">
                            <svg class="w-4 h-4 mr-3 text-[#F53003]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            Rechercher
                        </h3>
                        <div class="relative group">
                            <input type="text" name="search" placeholder="Nom du produit..." value="{{ request('search') }}" class="w-full pl-12 pr-4 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-[#F53003]/20 focus:bg-white transition-all text-sm font-bold text-gray-900 placeholder-gray-400">
                            <svg class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-[#F53003] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-6 flex items-center border-b border-gray-50 pb-4">
                            <svg class="w-4 h-4 mr-3 text-[#F53003] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 6h16M4 12h16M4 18h16"/></svg>
                            <span>Catégories</span>
                        </h3>
                        <div class="space-y-2">
                            <label class="flex items-center p-3 rounded-xl hover:bg-gray-50 cursor-pointer transition-colors group">
                                <input type="radio" name="category" value="" id="cat_all" {{ !request('category') ? 'checked' : '' }} class="hidden peer">
                                <div class="w-5 h-5 border-2 border-gray-200 rounded-full flex items-center justify-center mr-3 peer-checked:border-[#F53003] transition-all">
                                    <div class="w-2.5 h-2.5 rounded-full bg-[#F53003] scale-0 peer-checked:scale-100 transition-transform"></div>
                                </div>
                                <span class="text-sm font-bold text-gray-500 peer-checked:text-gray-900 transition-colors">Toutes les catégories</span>
                            </label>
                            @foreach($categories as $category)
                                <label class="flex items-center p-3 rounded-xl hover:bg-gray-50 cursor-pointer transition-colors group">
                                    <input type="radio" name="category" value="{{ $category->id }}" id="cat_{{ $category->id }}" {{ request('category') == $category->id ? 'checked' : '' }} class="hidden peer">
                                    <div class="w-5 h-5 border-2 border-gray-200 rounded-full flex items-center justify-center mr-3 peer-checked:border-[#F53003] transition-all">
                                        <div class="w-2.5 h-2.5 rounded-full bg-[#F53003] scale-0 peer-checked:scale-100 transition-transform"></div>
                                    </div>
                                    <span class="text-sm font-bold text-gray-500 peer-checked:text-gray-900 transition-colors">{{ $category->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="pt-6 space-y-4">
                        <button type="submit" style="background-color: #F53003 !important; color: white !important;" class="w-full text-white font-black px-6 py-4 rounded-2xl shadow-xl shadow-[#F53003]/20 hover:bg-[#ff4d24] transition-all transform hover:-translate-y-1 active:scale-95 text-xs uppercase tracking-widest">Filtrer / Rechercher</button>
                        <a href="{{ route('shop.index') }}" class="block text-center w-full py-4 text-[10px] font-black text-gray-400 hover:text-[#F53003] uppercase tracking-[0.2em] transition-colors">Réinitialiser</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Product Grid -->
        <div class="lg:col-span-3">
            <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse($products as $product)
                    @include('client.partials.product-card', ['product' => $product])
                @empty
                    <div class="col-span-full bg-white p-20 text-center rounded-[3rem] border border-gray-100 shadow-sm">
                        <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-8">
                            <svg class="h-12 w-12 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <h3 class="text-3xl font-black text-gray-900 mb-4 tracking-tight">Aucun produit trouvé</h3>
                        <p class="text-gray-500 max-w-sm mx-auto font-bold text-sm">Nous n'avons pas trouvé de produits correspondant à vos critères.</p>
                        <a href="{{ route('shop.index') }}" class="inline-block mt-10 text-[#F53003] font-black uppercase tracking-widest text-[10px] hover:underline">Voir tout le catalogue</a>
                    </div>
                @endforelse
            </div>
            
            <div class="mt-16 pagination-container">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
