@extends('layouts.admin')
@section('page_title', 'Catégories')
@section('page_icon')
<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>
@endsection

@section('content')
<div class="mb-12 flex flex-col sm:flex-row justify-between items-start sm:items-end border-b border-gray-100 pb-8">
    <div>
        <h2 class="text-[9px] font-black text-[#F53003] tracking-[0.3em] uppercase mb-2">Organisation</h2>
        <h1 class="text-4xl font-black text-gray-900 tracking-tight">Gestion des <span class="text-[#F53003]">Catégories</span></h1>
    </div>
    <a href="{{ route('admin.categories.create') }}" style="background-color: #F53003 !important;" class="mt-6 sm:mt-0 text-white px-8 py-4 rounded-2xl font-black shadow-xl shadow-[#F53003]/20 transition-all flex items-center transform hover:-translate-y-1 active:scale-95 text-[10px] uppercase tracking-widest hover:bg-black">
        <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" /></svg>
        Nouvelle Catégorie
    </a>
</div>

<div class="bg-white rounded-[2.5rem] border border-gray-100 overflow-hidden shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50/50 border-b border-gray-100">
                    <th class="px-8 py-6 text-xs font-black text-gray-500 uppercase tracking-[0.2em]">Identifiant</th>
                    <th class="px-8 py-6 text-xs font-black text-gray-500 uppercase tracking-[0.2em]">Nom de la Catégorie</th>
                    <th class="px-8 py-6 text-xs font-black text-gray-500 uppercase tracking-[0.2em]">Produits Liés</th>
                    <th class="px-8 py-6 text-xs font-black text-gray-500 uppercase tracking-[0.2em] text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 text-gray-900">
                @foreach($categories as $category)
                <tr class="hover:bg-gray-50 transition-colors group">
                    <td class="px-8 py-6">
                        <span class="text-gray-400 font-black text-xs">#{{ str_pad($category->id, 3, '0', STR_PAD_LEFT) }}</span>
                    </td>
                    <td class="px-8 py-6">
                        <div class="text-base font-black text-gray-900 tracking-tight group-hover:text-[#F53003] transition-colors capitalize">{{ $category->name }}</div>
                    </td>
                    <td class="px-8 py-6">
                        <span class="bg-[#F53003]/5 text-[#F53003] px-3.5 py-1.5 rounded-md text-[10px] font-black border border-[#F53003]/10 uppercase tracking-widest">
                            {{ $category->products_count }} Articles
                        </span>
                    </td>
                    <td class="px-8 py-6 text-right space-x-2">
                        <a href="{{ route('admin.categories.edit', $category) }}" class="inline-flex items-center justify-center w-11 h-11 rounded-xl bg-gray-50 border border-gray-100 text-gray-400 hover:bg-[#F53003] hover:text-white transition-all transform hover:scale-110 shadow-sm">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                        </a>
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer cette catégorie ?');">
                            @csrf
                            @method('DELETE')
                            <button class="inline-flex items-center justify-center w-11 h-11 rounded-xl bg-red-50 border border-red-100 text-red-500 hover:bg-red-500 hover:text-white transition-all transform hover:scale-110 shadow-sm">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if($categories->hasPages())
    <div class="px-8 py-6 border-t border-gray-100 bg-gray-50/30">
        {{ $categories->links() }}
    </div>
    @endif
</div>
@endsection
