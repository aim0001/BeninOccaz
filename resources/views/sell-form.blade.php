<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendre un article - BeninOccaz</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen py-8">
        <div class="max-w-2xl mx-auto px-4">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Vendre un article</h1>
                <p class="text-gray-600">Créez votre annonce en quelques minutes</p>
                <a href="/" class="inline-block mt-4 text-blue-600 hover:text-blue-800">← Retour à l'accueil</a>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <form action="{{ route('sell.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Photos -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Photos de l'article (max. 4)
                        </label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer hover:border-gray-400" onclick="document.getElementById('images').click()">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <p class="mt-2 text-sm text-gray-600">Cliquez pour ajouter des photos</p>
                            <input type="file" id="images" name="images[]" multiple accept="image/*" class="hidden">
                        </div>
                        <div id="preview" class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4"></div>
                    </div>

                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Titre de l'annonce</label>
                        <input type="text" id="title" name="title" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="ex: Chemise verte Zara"
                               value="{{ old('title') }}">
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea id="description" name="description" required rows="4"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                  placeholder="Décrivez votre article...">{{ old('description') }}</textarea>
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Catégorie</label>
                        <select id="category" name="category" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Sélectionnez une catégorie</option>
                            <option value="femme" {{ old('category') == 'femme' ? 'selected' : '' }}>Femme</option>
                            <option value="homme" {{ old('category') == 'homme' ? 'selected' : '' }}>Homme</option>
                            <option value="enfant" {{ old('category') == 'enfant' ? 'selected' : '' }}>Enfant</option>
                            <option value="maison" {{ old('category') == 'maison' ? 'selected' : '' }}>Maison</option>
                            <option value="electronique" {{ old('category') == 'electronique' ? 'selected' : '' }}>Électronique</option>
                        </select>
                    </div>

                    <!-- Size -->
                    <div>
                        <label for="taille" class="block text-sm font-medium text-gray-700 mb-2">Taille</label>
                        <input type="text" id="taille" name="taille" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="ex: M, 40, 9.5 US..."
                               value="{{ old('taille') }}">
                    </div>

                    <!-- Price -->
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Prix (FCFA)</label>
                        <input type="number" id="price" name="price" required min="1" step="0.01"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="ex: 2000"
                               value="{{ old('price') }}">
                    </div>

                    <!-- Condition -->
                    <div>
                        <label for="condition" class="block text-sm font-medium text-gray-700 mb-2">État</label>
                        <select id="condition" name="condition" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Choisissez l'état</option>
                            <option value="new_with_tags" {{ old('condition') == 'new_with_tags' ? 'selected' : '' }}>Neuf avec étiquette</option>
                            <option value="excellent" {{ old('condition') == 'excellent' ? 'selected' : '' }}>Excellent état</option>
                            <option value="good" {{ old('condition') == 'good' ? 'selected' : '' }}>Bon état</option>
                            <option value="fair" {{ old('condition') == 'fair' ? 'selected' : '' }}>État correct</option>
                            <option value="poor" {{ old('condition') == 'poor' ? 'selected' : '' }}>Mauvais état</option>
                        </select>
                    </div>

                    <!-- Delivery Method -->
                    <div>
                        <label for="delivery_method" class="block text-sm font-medium text-gray-700 mb-2">Méthode de livraison</label>
                        <select id="delivery_method" name="delivery_method" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Choisissez la méthode</option>
                            <option value="meetup" {{ old('delivery_method') == 'meetup' ? 'selected' : '' }}>Remise en main propre</option>
                            <option value="carrier" {{ old('delivery_method') == 'carrier' ? 'selected' : '' }}>Livraison par transporteur</option>
                        </select>
                    </div>

                    <!-- Meetup Location -->
                    <div id="meetup-location" style="display: none;">
                        <label for="meetup_location" class="block text-sm font-medium text-gray-700 mb-2">Lieu de rencontre</label>
                        <input type="text" id="meetup_location" name="meetup_location"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="ex: Place du Souvenir, Cotonou"
                               value="{{ old('meetup_location') }}">
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button type="submit" class="w-full bg-blue-600 text-white py-3 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 font-medium">
                            Publier l'annonce
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Show/hide meetup location
        document.getElementById('delivery_method').addEventListener('change', function() {
            const meetupDiv = document.getElementById('meetup-location');
            const meetupInput = document.getElementById('meetup_location');
            
            if (this.value === 'meetup') {
                meetupDiv.style.display = 'block';
                meetupInput.required = true;
            } else {
                meetupDiv.style.display = 'none';
                meetupInput.required = false;
            }
        });

        // Image preview
        document.getElementById('images').addEventListener('change', function(e) {
            const preview = document.getElementById('preview');
            preview.innerHTML = '';
            
            Array.from(e.target.files).slice(0, 4).forEach((file, index) => {
                if (file.type.startsWith('image/')) {
                    const div = document.createElement('div');
                    div.className = 'relative';
                    
                    const img = document.createElement('img');
                    img.src = URL.createObjectURL(file);
                    img.className = 'w-full h-32 object-cover rounded-lg';
                    
                    const name = document.createElement('p');
                    name.textContent = file.name;
                    name.className = 'text-xs text-gray-600 mt-1 truncate';
                    
                    div.appendChild(img);
                    div.appendChild(name);
                    preview.appendChild(div);
                }
            });
        });
    </script>
</body>
</html>
