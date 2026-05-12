@extends('layouts.admin')

@section('page_title', 'Modifier: ' . $product->name)
@section('page_icon')
<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
@endsection

@section('content')
<div class="mb-12 border-b border-gray-100 pb-8">
    <a href="{{ route('admin.products.index') }}" class="text-[#F53003] hover:text-black font-black flex items-center text-[10px] uppercase tracking-widest mb-4 transition-colors">
        <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" /></svg>
        Retour au catalogue
    </a>
    <h1 class="text-3xl font-black text-gray-900 tracking-tight">Mise à jour <span class="text-[#F53003]">Produit</span></h1>
</div>

<form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    @csrf
    @method('PUT')
    
    <!-- Main Info -->
    <div class="lg:col-span-2 space-y-8">
        <div class="bg-white rounded-[2.5rem] border border-gray-100 p-10 shadow-sm">
            <h2 class="text-base font-black text-gray-900 uppercase tracking-widest mb-8 border-l-4 border-[#F53003] pl-4">Informations Générales</h2>
            
            <div class="space-y-6">
                <div>
                    <label class="block text-xs font-black text-gray-500 uppercase tracking-[0.2em] mb-3">Nom commercial</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" required class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 px-6 text-gray-900 font-bold focus:ring-2 focus:ring-[#F53003]/20 focus:border-[#F53003] transition-all">
                    @error('name')<span class="text-red-500 text-xs font-bold mt-2 block">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-xs font-black text-gray-500 uppercase tracking-[0.2em] mb-3">Description détaillée</label>
                    <textarea name="description" rows="6" class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 px-6 text-gray-900 font-bold focus:ring-2 focus:ring-[#F53003]/20 focus:border-[#F53003] transition-all leading-relaxed">{{ old('description', $product->description) }}</textarea>
                    @error('description')<span class="text-red-500 text-xs font-bold mt-2 block">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>

        <div class="bg-white rounded-[2.5rem] border border-gray-100 p-10 shadow-sm">
            <h2 class="text-base font-black text-gray-900 uppercase tracking-widest mb-8 border-l-4 border-[#F53003] pl-4">Prix et Inventaire</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label class="block text-xs font-black text-gray-500 uppercase tracking-[0.2em] mb-3">Prix de vente (DHS)</label>
                    <div class="relative">
                        <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" required class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 px-6 text-gray-900 font-black text-xl focus:ring-2 focus:ring-[#F53003]/20 focus:border-[#F53003] transition-all pl-20">
                        <div class="absolute left-6 top-1/2 -translate-y-1/2 text-gray-400 font-black text-[10px] uppercase tracking-widest border-r border-gray-200 pr-4">DHS</div>
                    </div>
                    @error('price')<span class="text-red-500 text-xs font-bold mt-2 block">{{ $message }}</span>@enderror
                </div>
                <div>
                    <label class="block text-xs font-black text-gray-500 uppercase tracking-[0.2em] mb-3">Quantité en stock</label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 px-6 text-gray-900 font-black text-xl focus:ring-2 focus:ring-[#F53003]/20 focus:border-[#F53003] transition-all">
                    @error('stock')<span class="text-red-500 text-xs font-bold mt-2 block">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>
    </div>

    <!-- Side Bar -->
    <div class="space-y-8">
        <!-- Category Selection -->
        <div class="bg-white rounded-[2.5rem] border border-gray-100 p-8 shadow-sm">
            <h2 class="text-xs font-black text-gray-900 uppercase tracking-widest mb-6">Classification</h2>
            <select name="category_id" required class="w-full bg-gray-50 border border-gray-100 rounded-xl py-4 px-6 text-gray-900 font-bold focus:ring-2 focus:ring-[#F53003]/20 focus:border-[#F53003] transition-all appearance-none">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')<span class="text-red-500 text-xs font-bold mt-2 block">{{ $message }}</span>@enderror
        </div>

        <!-- Image Upload -->
        <div class="bg-white rounded-[2.5rem] border border-gray-100 p-8 shadow-sm">
            <h2 class="text-xs font-black text-gray-900 uppercase tracking-widest mb-6">Visuels</h2>
            
            <div class="space-y-6">
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-wider">Actuels</p>
                <div class="grid grid-cols-3 gap-2 mb-4">
                    @foreach($product->images as $image)
                        <div class="aspect-square rounded-xl border border-gray-100 overflow-hidden p-1 bg-gray-50">
                            <img src="{{ Storage::url($image->image_path) }}" class="w-full h-full object-contain">
                        </div>
                    @endforeach
                    @if($product->images->isEmpty() && $product->image)
                        <div class="aspect-square rounded-xl border border-gray-100 overflow-hidden p-1 bg-gray-50">
                            <img src="{{ Storage::url($product->image) }}" class="w-full h-full object-contain">
                        </div>
                    @endif
                </div>

                <div class="border-t border-gray-50 pt-6">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-wider mb-4">Remplacer</p>
                    <div id="image-preview-container" class="grid grid-cols-2 gap-3 mb-4">
                        <div class="w-full aspect-square bg-gray-50 rounded-2xl border-2 border-dashed border-gray-100 flex items-center justify-center overflow-hidden">
                            <svg class="w-10 h-10 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        </div>
                    </div>
                    <div class="relative group">
                        <input type="file" name="images[]" id="images-input" multiple accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div class="w-full py-4 px-6 bg-gray-50 border border-gray-100 rounded-xl text-center group-hover:border-[#F53003] transition-colors">
                            <span class="text-[11px] font-black text-gray-500 uppercase tracking-widest group-hover:text-[#F53003]">Nouvelles images</span>
                        </div>
                    </div>
                </div>
                @error('images')<span class="text-red-500 text-xs font-bold mt-2 block">{{ $message }}</span>@enderror
            </div>
        </div>

        <!-- Action Button -->
        <button type="submit" style="background-color: #F53003 !important;" class="w-full text-white font-black py-6 rounded-2xl shadow-xl shadow-[#F53003]/20 hover:bg-black transition-all transform hover:-translate-y-1 active:scale-95 text-xs uppercase tracking-widest">
            Mettre à jour
        </button>
    </div>
</form>

<script>
    document.getElementById('images-input').onchange = function(evt) {
        const previewContainer = document.getElementById('image-preview-container');
        previewContainer.innerHTML = '';
        
        const files = Array.from(this.files);
        files.forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'w-full aspect-square bg-gray-50 rounded-2xl overflow-hidden border border-gray-100 p-2';
                div.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-contain">`;
                previewContainer.appendChild(div);
            }
            reader.readAsDataURL(file);
        });
    }
</script>
@endsection
