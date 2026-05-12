@extends('layouts.admin')
@section('page_title', 'Utilisateurs')
@section('page_icon')
<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
@endsection

@section('content')
<div class="mb-12 flex flex-col sm:flex-row justify-between items-start sm:items-end border-b border-gray-100 pb-8">
    <div>
        <h2 class="text-[9px] font-black text-[#F53003] tracking-[0.3em] uppercase mb-2">Communauté</h2>
        <h1 class="text-4xl font-black text-gray-900 tracking-tight">Liste des <span class="text-[#F53003]">Utilisateurs</span></h1>
    </div>
</div>

<div class="bg-white rounded-[2.5rem] border border-gray-100 overflow-hidden shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50/50 border-b border-gray-100">
                    <th class="px-8 py-6 text-xs font-black text-gray-500 uppercase tracking-[0.2em]">Identifiant</th>
                    <th class="px-8 py-6 text-xs font-black text-gray-500 uppercase tracking-[0.2em]">Nom Complet</th>
                    <th class="px-8 py-6 text-xs font-black text-gray-500 uppercase tracking-[0.2em]">Adresse Email</th>
                    <th class="px-8 py-6 text-xs font-black text-gray-500 uppercase tracking-[0.2em]">Inscription</th>
                    <th class="px-8 py-6 text-xs font-black text-gray-500 uppercase tracking-[0.2em] text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 text-gray-900">
                @foreach($users as $user)
                <tr class="hover:bg-gray-50 transition-colors group">
                    <td class="px-8 py-6">
                        <span class="text-gray-400 font-black text-xs">#{{ str_pad($user->id, 4, '0', STR_PAD_LEFT) }}</span>
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex items-center">
                            <div class="h-10 w-10 rounded-xl bg-gray-50 text-gray-400 flex items-center justify-center font-black text-xs mr-4 border border-gray-100 group-hover:bg-[#F53003] group-hover:text-white transition-colors">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <span class="text-sm font-black text-gray-900 capitalize">{{ $user->name }}</span>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <span class="text-sm font-medium text-gray-600">{{ $user->email }}</span>
                    </td>
                    <td class="px-8 py-6">
                        <span class="text-[10px] font-black text-gray-500 uppercase tracking-tight">{{ $user->created_at->format('d M Y') }}</span>
                    </td>
                    <td class="px-8 py-6 text-right">
                        @if(auth()->user()->hasPermission('supprimer-utilisateurs'))
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer ce client ?');">
                            @csrf
                            @method('DELETE')
                            <button class="inline-flex items-center px-5 py-2.5 rounded-xl bg-red-50 text-red-500 text-[10px] font-black uppercase tracking-widest border border-red-100 hover:bg-red-500 hover:text-white transition-all transform hover:scale-105 active:scale-95 shadow-sm">
                                Bannir / Supprimer
                            </button>
                        </form>
                        @else
                        <span class="text-[10px] font-black text-gray-300 uppercase tracking-widest">Aucune Action</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if($users->hasPages())
    <div class="px-8 py-6 border-t border-gray-100 bg-gray-50/30">
        {{ $users->links() }}
    </div>
    @endif
</div>
@endsection
