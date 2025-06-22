<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gestion des Articles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Back to Dashboard -->
            <div class="mb-6">
                <a href="{{ route('admin.dashboard') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition duration-200">
                    ← Retour au tableau de bord
                </a>
            </div>

            <!-- Items Table -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Liste des Articles</h3>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Article
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Vendeur
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Prix
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Statut
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Date
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($items as $item)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                @if($item->images && count(json_decode($item->images)) > 0)
                                                    <img class="h-10 w-10 rounded-lg object-cover" 
                                                         src="{{ asset('storage/' . json_decode($item->images)[0]) }}" 
                                                         alt="{{ $item->title }}">
                                                @else
                                                    <div class="h-10 w-10 rounded-lg bg-gray-300 dark:bg-gray-600 flex items-center justify-center">
                                                        <span class="text-xs font-medium text-gray-700 dark:text-gray-300">IMG</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                    {{ Str::limit($item->title, 30) }}
                                                </div>
                                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $item->category }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $item->user->name ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        {{ number_format($item->price, 0, ',', ' ') }} FCFA
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $item->is_sold ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' : 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' }}">
                                            {{ $item->is_sold ? 'Vendu' : 'Disponible' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $item->created_at->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('items.show', $item) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                                Voir
                                            </a>
                                            <form method="POST" action="{{ route('admin.items.toggle-status', $item) }}" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                                    {{ $item->is_sold ? 'Marquer disponible' : 'Marquer vendu' }}
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('admin.items.delete', $item) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300" 
                                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">
                                                    Supprimer
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $items->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
