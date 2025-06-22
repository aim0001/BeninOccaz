<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Articles en attente d\'approbation') }}
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

            <!-- Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-orange-100 dark:bg-orange-900/20 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-orange-800 dark:text-orange-200">En attente</h3>
                    <p class="text-2xl font-bold text-orange-600">{{ $pendingItems->total() }}</p>
                </div>
                <div class="bg-green-100 dark:bg-green-900/20 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-green-800 dark:text-green-200">Approuvés aujourd'hui</h3>
                    <p class="text-2xl font-bold text-green-600">{{ \App\Models\Item::approved()->whereDate('approved_at', today())->count() }}</p>
                </div>
                <div class="bg-red-100 dark:bg-red-900/20 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-red-800 dark:text-red-200">Rejetés aujourd'hui</h3>
                    <p class="text-2xl font-bold text-red-600">{{ \App\Models\Item::rejected()->whereDate('updated_at', today())->count() }}</p>
                </div>
            </div>

            <!-- Pending Items Table -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                        Articles en attente d'approbation ({{ $pendingItems->total() }})
                    </h3>
                    
                    @if($pendingItems->count() > 0)
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
                                        Catégorie
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Date de soumission
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($pendingItems as $item)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-12 w-12">
                                                @if($item->images && count($item->images) > 0)
                                                    <img class="h-12 w-12 rounded-lg object-cover" 
                                                         src="{{ asset('storage/' . $item->images[0]) }}" 
                                                         alt="{{ $item->title }}">
                                                @else
                                                    <div class="h-12 w-12 rounded-lg bg-gray-300 dark:bg-gray-600 flex items-center justify-center">
                                                        <span class="text-xs font-medium text-gray-700 dark:text-gray-300">IMG</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                    {{ Str::limit($item->title, 40) }}
                                                </div>
                                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                                    {{ Str::limit($item->description, 60) }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-gray-100">{{ $item->user->name ?? 'N/A' }}</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $item->user->email ?? 'N/A' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        {{ number_format($item->price, 0, ',', ' ') }} FCFA
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                            {{ $item->category }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $item->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('admin.pending-items.show', $item) }}" 
                                               class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs transition duration-200">
                                                Examiner
                                            </a>
                                            <form method="POST" action="{{ route('admin.pending-items.approve', $item) }}" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" 
                                                        class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs transition duration-200"
                                                        onclick="return confirm('Approuver cet article ?')">
                                                    Approuver
                                                </button>
                                            </form>
                                            <button onclick="openRejectModal({{ $item->id }}, '{{ $item->title }}')"
                                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs transition duration-200">
                                                Rejeter
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $pendingItems->links() }}
                    </div>
                    @else
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">Aucun article en attente</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Tous les articles ont été traités.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Rejeter l'article</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                    Vous êtes sur le point de rejeter l'article: <strong id="rejectItemTitle"></strong>
                </p>
                <form id="rejectForm" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mb-4">
                        <label for="admin_notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Raison du rejet (obligatoire)
                        </label>
                        <textarea id="admin_notes" name="admin_notes" rows="3" required
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
                                  placeholder="Expliquez pourquoi cet article est rejeté..."></textarea>
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeRejectModal()"
                                class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition duration-200">
                            Annuler
                        </button>
                        <button type="submit"
                                class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition duration-200">
                            Rejeter
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openRejectModal(itemId, itemTitle) {
            document.getElementById('rejectItemTitle').textContent = itemTitle;
            document.getElementById('rejectForm').action = `/admin/pending-items/${itemId}/reject`;
            document.getElementById('rejectModal').classList.remove('hidden');
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
            document.getElementById('admin_notes').value = '';
        }
    </script>
</x-app-layout>
