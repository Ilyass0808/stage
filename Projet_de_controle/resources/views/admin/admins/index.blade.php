@extends('layouts.admin')

@section('page_title', 'Gestion des Administrateurs')

@section('content')
<div class="mb-8 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-black text-gray-900">Administrateurs</h1>
        <p class="text-gray-500 text-sm">Gérez les comptes admin et leurs permissions.</p>
    </div>
    <a href="{{ route('admin.admins.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl font-bold shadow-lg shadow-indigo-600/20 transition-all flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
        Nouvel Admin
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Nom & Email</th>
                <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Permissions</th>
                <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Date d'ajout</th>
                <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @foreach($admins as $admin)
            <tr class="hover:bg-gray-50/50 transition-colors">
                <td class="px-6 py-4">
                    <div class="flex items-center">
                        <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold">
                            {{ substr($admin->name, 0, 1) }}
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-bold text-gray-900">{{ $admin->name }}</div>
                            <div class="text-xs text-gray-500">{{ $admin->email }}</div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4">
                    <div class="flex flex-wrap gap-1">
                        @forelse($admin->permissions as $perm)
                            <span class="px-2 py-0.5 text-[10px] font-bold rounded-full bg-green-50 text-green-600 border border-green-100">
                                {{ $perm->name }}
                            </span>
                        @empty
                            <span class="text-xs text-gray-400 italic">Aucune permission</span>
                        @endforelse
                    </div>
                </td>
                <td class="px-6 py-4 text-sm text-gray-500">
                    {{ $admin->created_at->format('d/m/Y') }}
                </td>
                <td class="px-6 py-4 text-right space-x-3">
                    <a href="{{ route('admin.admins.edit', $admin) }}" class="text-indigo-600 hover:text-indigo-900 inline-block p-2 hover:bg-indigo-50 rounded-lg transition-all">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                    </a>
                    @if($admin->id !== auth()->id())
                    <form action="{{ route('admin.admins.destroy', $admin) }}" method="POST" class="inline-block" onsubmit="return confirm('Supprimer cet administrateur ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900 p-2 hover:bg-red-50 rounded-lg transition-all">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                        </button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
