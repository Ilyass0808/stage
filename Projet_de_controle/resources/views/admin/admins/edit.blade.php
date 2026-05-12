@extends('layouts.admin')

@section('page_title', 'Modifier Admin: ' . $admin->name)

@section('content')
<div class="mb-8">
    <a href="{{ route('admin.admins.index') }}" class="text-indigo-600 hover:text-indigo-800 font-bold flex items-center text-sm mb-2">
        <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
        Retour à la liste
    </a>
    <h1 class="text-2xl font-black text-gray-900">Modifier l'Administrateur</h1>
</div>

<form action="{{ route('admin.admins.update', $admin) }}" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    @csrf
    @method('PUT')
    
    <!-- Account Info -->
    <div class="lg:col-span-2 space-y-8">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <h2 class="text-lg font-bold text-gray-900 mb-6">Informations du Compte</h2>
            
            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nom complet</label>
                        <input type="text" name="name" value="{{ old('name', $admin->name) }}" required class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                        @error('name')<span class="text-red-500 text-xs mt-1">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Adresse Email</label>
                        <input type="email" name="email" value="{{ old('email', $admin->email) }}" required class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                        @error('email')<span class="text-red-500 text-xs mt-1">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6 bg-indigo-50/50 rounded-2xl border border-indigo-100">
                    <div class="md:col-span-2">
                        <p class="text-sm font-bold text-indigo-900 mb-2">Changer le mot de passe (optionnel)</p>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-indigo-600 uppercase mb-2">Nouveau mot de passe</label>
                        <input type="password" name="password" class="w-full bg-white border border-indigo-200 rounded-xl py-3 px-4 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                        @error('password')<span class="text-red-500 text-xs mt-1">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-indigo-600 uppercase mb-2">Confirmer le nouveau mot de passe</label>
                        <input type="password" name="password_confirmation" class="w-full bg-white border border-indigo-200 rounded-xl py-3 px-4 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Permissions Side -->
    <div class="space-y-8">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <h2 class="text-lg font-bold text-gray-900 mb-6 flex items-center">
                <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.040L3 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622l-.382-3.016z" /></svg>
                Permissions
            </h2>
            
            <div class="space-y-4">
                @foreach($permissions as $permission)
                    <label class="flex items-center p-3 rounded-xl border {{ in_array($permission->id, $adminPermissions) ? 'border-indigo-200 bg-indigo-50/30' : 'border-gray-100' }} hover:bg-gray-50 cursor-pointer transition-all">
                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" {{ in_array($permission->id, $adminPermissions) ? 'checked' : '' }} class="w-5 h-5 text-indigo-600 rounded focus:ring-indigo-500">
                        <div class="ml-3">
                            <div class="text-sm font-bold text-gray-900">{{ $permission->name }}</div>
                            <div class="text-[10px] text-gray-400 uppercase tracking-widest">{{ $permission->slug }}</div>
                        </div>
                    </label>
                @endforeach
                @error('permissions')<span class="text-red-500 text-xs mt-1">{{ $message }}</span>@enderror
            </div>
        </div>

        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 rounded-2xl shadow-lg shadow-indigo-600/30 transition-all transform hover:-translate-y-1">
            Enregistrer les modifications
        </button>
    </div>
</form>
@endsection
