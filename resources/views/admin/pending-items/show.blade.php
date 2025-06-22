<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Examiner l\'article en attente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('admin.pending-items') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition duration-200">
                    ← Retour aux articles en attente
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Article Details -->
                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $item->title }}</h3>
                                <span class="px-3 py-1 text-sm rounded-full bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200">
                                    En attente
                                </span>
                            </div>

                            <!-- Images -->
                            @if($item->images && count($item->images) > 0)
                            <div class="mb-6">
                                <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-3">Images</h4>
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                    @foreach($item->images as $image)
                                    <div class="aspect-square">
                                        <img src="{{ asset('storage/' . $image) }}" 
                                             alt="Image de {{ $item->title }}"
                                             class="w-full h-full object-cover rounded-lg cursor-pointer hover:opacity-75 transition duration-200"
                                             onclick="openImageModal('{{ asset('storage/' . $image) }}')">
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <!-- Description -->
                            <div class="mb-6">
                                <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-3">Description</h4>
                                <p class="text-gray-700 dark:text-gray-300 whitespace-pre-wrap">{{ $item->description }}</p>
                            </div>

                            <!-- Details -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-3">Détails du produit</h4>
                                    <dl class="space-y-2">
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Prix</dt>
                                            <dd class="text-lg font-bold text-green-600">{{ number_format($item->price, 0, ',', ' ') }} FCFA</dd>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Catégorie</dt>
                                            <dd class="text-sm text-gray-900 dark:text-gray-100">{{ $item->category }}</dd>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Taille</dt>
                                            <dd class="text-sm text-gray-900 dark:text-gray-100">{{ $item->taille }}</dd>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">État</dt>
                                            <dd class="text-sm text-gray-900 dark:text-gray-100">{{ $item->condition }}</dd>
                                        </div>
                                    </dl>
                                </div>
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-3">Livraison</h4>
                                    <dl class="space-y-2">
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Méthode</dt>
                                            <dd class="text-sm text-gray-900 dark:text-gray-100">{{ $item->delivery_method }}</dd>
                                        </div>
                                        @if($item->meetup_location)
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Lieu de rencontre</dt>
                                            <dd class="text-sm text-gray-900 dark:text-gray-100">{{ $item->meetup_location }}</dd>
                                        </div>
                                        @endif
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Seller Info -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Informations du vendeur</h4>
                            <div class="space-y-3">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Nom</dt>
                                    <dd class="text-sm text-gray-900 dark:text-gray-100">{{ $item->user->name ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</dt>
                                    <dd class="text-sm text-gray-900 dark:text-gray-100">{{ $item->user->email ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Téléphone</dt>
                                    <dd class="text-sm text-gray-900 dark:text-gray-100">{{ $item->user->phone ?? 'N/A' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Ville</dt>
                                    <dd class="text-sm text-gray-900 dark:text-gray-100">{{ $item->user->city ?? 'N/A' }}</dd>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submission Info -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Informations de soumission</h4>
                            <div class="space-y-3">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Date de soumission</dt>
                                    <dd class="text-sm text-gray-900 dark:text-gray-100">{{ $item->created_at->format('d/m/Y à H:i') }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Temps d'attente</dt>
                                    <dd class="text-sm text-gray-900 dark:text-gray-100">{{ $item->created_at->diffForHumans() }}</dd>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Actions</h4>
                            <div class="space-y-3">
                                <!-- Approve Form -->
                                <form method="POST" action="{{ route('admin.pending-items.approve', $item) }}">
                                    @csrf
                                    @method('PATCH')
                                    <div class="mb-3">
                                        <label for="approve_notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                            Notes d'approbation (optionnel)
                                        </label>
                                        <textarea id="approve_notes" name="admin_notes" rows="2"
                                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
                                                  placeholder="Notes pour le vendeur..."></textarea>
                                    </div>
                                    <button type="submit" 
                                            class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition duration-200"
                                            onclick="return confirm('Approuver cet article ?')">
                                        ✓ Approuver l'article
                                    </button>
                                </form>

                                <!-- Reject Form -->
                                <form method="POST" action="{{ route('admin.pending-items.reject', $item) }}">
                                    @csrf
                                    @method('PATCH')
                                    <div class="mb-3">
                                        <label for="reject_notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                            Raison du rejet (obligatoire)
                                        </label>
                                        <textarea id="reject_notes" name="admin_notes" rows="2" required
                                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
                                                  placeholder="Expliquez pourquoi cet article est rejeté..."></textarea>
                                    </div>
                                    <button type="submit" 
                                            class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition duration-200"
                                            onclick="return confirm('Rejeter cet article ?')">
                                        ✗ Rejeter l'article
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center hidden z-50">
        <div class="max-w-4xl max-h-full p-4">
            <img id="modalImage" src="" alt="" class="max-w-full max-h-full object-contain">
            <button onclick="closeImageModal()" class="absolute top-4 right-4 text-white text-2xl hover:text-gray-300">
                ✕
            </button>
        </div>
    </div>

    <script>
        function openImageModal(imageSrc) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('imageModal').classList.remove('hidden');
        }

        function closeImageModal() {
            document.getElementById('imageModal').classList.add('hidden');
        }

        // Close modal when clicking outside the image
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeImageModal();
            }
        });
    </script>
</x-app-layout>
