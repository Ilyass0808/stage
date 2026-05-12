@extends('layouts.admin')

@section('page_title', 'Ajouter une catégorie')
@section('page_icon')
<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" /></svg>
@endsection

@section('content')
<div class="mb-12 border-b border-gray-100 pb-8">
    <a href="{{ route('admin.categories.index') }}" class="text-[#F53003] hover:text-black font-black flex items-center text-[10px] uppercase tracking-widest mb-4 transition-colors">
        <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" /></svg>
        Retour à la liste
    </a>
    <h1 class="text-3xl font-black text-gray-900 tracking-tight">Nouvelle <span class="text-[#F53003]">Catégorie</span></h1>
</div>

<div class="bg-white rounded-[2.5rem] border border-gray-100 p-10 shadow-sm max-w-3xl">
    <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-8">
        @csrf
        <div>
            <label class="block text-xs font-black text-gray-500 uppercase tracking-[0.2em] mb-4 border-l-4 border-[#F53003] pl-4">Nom de la catégorie</label>
            <input type="text" name="name" placeholder="Ex: Informatique, Mode, Maison..." class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 px-6 text-gray-900 font-black text-xl focus:ring-2 focus:ring-[#F53003]/20 focus:border-[#F53003] transition-all placeholder-gray-200" value="{{ old('name') }}" required>
            @error('name')<span class="text-red-500 text-xs font-bold mt-2 block">{{ $message }}</span>@enderror
        </div>

        <div>
            <label class="block text-xs font-black text-gray-500 uppercase tracking-[0.2em] mb-4 border-l-4 border-gray-200 pl-4">Description (Optionnel)</label>
            <textarea name="description" rows="5" placeholder="Décrivez brièvement le type de produits dans cette catégorie..." class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 px-6 text-gray-900 font-bold focus:ring-2 focus:ring-[#F53003]/20 focus:border-[#F53003] transition-all placeholder-gray-200 leading-relaxed">{{ old('description') }}</textarea>
            @error('description')<span class="text-red-500 text-xs font-bold mt-2 block">{{ $message }}</span>@enderror
        </div>

        <div class="flex items-center space-x-6 pt-4">
            <button type="submit" style="background-color: #F53003 !important;" class="flex-1 text-white font-black py-5 rounded-2xl shadow-xl shadow-[#F53003]/20 hover:bg-black transition-all transform hover:-translate-y-1 active:scale-95 text-xs uppercase tracking-widest">
                Enregistrer la catégorie
            </button>
            <a href="{{ route('admin.categories.index') }}" class="px-10 py-5 text-gray-400 bg-gray-50 rounded-2xl hover:bg-gray-100 hover:text-gray-900 transition-all font-black text-xs uppercase tracking-widest border border-gray-100">
                Annuler
            </a>
        </div>
    </form>
</div>
@endsection
