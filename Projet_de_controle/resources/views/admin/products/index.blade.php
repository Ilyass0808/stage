@extends('layouts.admin')

@section('page_title', 'Gestion des Produits')
@section('page_icon')
<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
@endsection

@section('content')
<div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-end border-b border-gray-100 pb-6">
    <div>
        <h2 class="text-[8px] font-black text-[#F53003] tracking-[0.2em] uppercase mb-1">Catalogue</h2>
        <h1 class="text-2xl font-black text-gray-900 tracking-tight">Produits en <span class="text-[#F53003]">Stock</span></h1>
    </div>
    @if(auth()->user()->hasPermission('ajouter-produits'))
    <a href="{{ route('admin.products.create') }}" style="background-color: #F53003 !important;" class="mt-4 sm:mt-0 text-white px-6 py-3 rounded-xl font-black shadow-lg shadow-[#F53003]/20 transition-all flex items-center transform hover:-translate-y-1 active:scale-95 text-[9px] uppercase tracking-widest hover:bg-black">
        <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" /></svg>
        Nouveau Produit
    </a>
    @endif
</div>

<div class="bg-white rounded-[2.5rem] border border-gray-100 overflow-hidden shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50/50 border-b border-gray-100">
                    <th class="px-8 py-6 text-xs font-black text-gray-500 uppercase tracking-[0.2em]">Produit</th>
                    <th class="px-8 py-6 text-xs font-black text-gray-500 uppercase tracking-[0.2em]">Catégorie</th>
                    <th class="px-8 py-6 text-xs font-black text-gray-500 uppercase tracking-[0.2em]">Prix Unitaire</th>
                    <th class="px-8 py-6 text-xs font-black text-gray-500 uppercase tracking-[0.2em]">Niveau de Stock</th>
                    <th class="px-8 py-6 text-xs font-black text-gray-500 uppercase tracking-[0.2em] text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 text-gray-900">
                @foreach($products as $product)
                <tr class="hover:bg-gray-50 transition-colors group">
                    <td class="px-8 py-6">
                        <div class="flex items-center">
                            <div class="h-16 w-16 rounded-2xl bg-gray-50 flex-shrink-0 overflow-hidden p-2 border border-gray-100 group-hover:scale-110 transition-transform duration-500">
                                @if($product->image)
                                    <img src="{{ Str::startsWith($product->image, 'http') ? $product->image : Storage::url($product->image) }}" class="h-full w-full object-contain">
                                @else
                                    <div class="h-full w-full flex items-center justify-center text-gray-300">
                                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                    </div>
                                @endif
                            </div>
                            <div class="ml-6">
                                <div class="text-base font-black text-gray-900 group-hover:text-[#F53003] transition-colors tracking-tight leading-tight capitalize">{{ $product->name }}</div>
                                <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest mt-1">ID: #{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <span class="px-3 py-1 text-[10px] font-black rounded-md bg-gray-50 text-gray-500 border border-gray-100 uppercase tracking-widest">
                            {{ $product->category->name }}
                        </span>
                    </td>
                    <td class="px-8 py-6">
                        <div class="text-base font-black text-gray-900 tracking-tighter">{{ number_format($product->price, 2) }} <span class="text-[10px] text-gray-400 ml-1">DHS</span></div>
                    </td>
                    <td class="px-8 py-6">
                        @if($product->stock > 10)
                            <div class="flex items-center text-emerald-600">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 mr-2 animate-pulse"></span>
                                <span class="text-xs font-black uppercase tracking-widest">{{ $product->stock }} En Stock</span>
                            </div>
                        @elseif($product->stock > 0)
                            <div class="flex items-center text-amber-600">
                                <span class="w-2 h-2 rounded-full bg-amber-500 mr-2"></span>
                                <span class="text-xs font-black uppercase tracking-widest">{{ $product->stock }} Critique</span>
                            </div>
                        @else
                            <div class="flex items-center text-red-600">
                                <span class="w-2 h-2 rounded-full bg-red-500 mr-2"></span>
                                <span class="text-xs font-black uppercase tracking-widest">Rupture</span>
                            </div>
                        @endif
                    </td>
                    <td class="px-8 py-6 text-right space-x-2">
                        @if(auth()->user()->hasPermission('modifier-produits'))
                        <a href="{{ route('admin.products.edit', $product) }}" class="inline-flex items-center justify-center w-11 h-11 rounded-xl bg-gray-50 border border-gray-100 text-gray-400 hover:bg-[#F53003] hover:text-white transition-all transform hover:scale-110 shadow-sm">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                        </a>
                        @endif

                        @if(auth()->user()->hasPermission('supprimer-produits'))
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline-block" onsubmit="return confirm('Supprimer ce produit ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center justify-center w-11 h-11 rounded-xl bg-red-50 border border-red-100 text-red-500 hover:bg-red-500 hover:text-white transition-all transform hover:scale-110 shadow-sm">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    @if($products->hasPages())
    <div class="px-8 py-6 border-t border-gray-100 bg-gray-50/30">
        {{ $products->links() }}
    </div>
    @endif
</div>
@endsection
