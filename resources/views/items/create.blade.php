<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Créer une nouvelle annonce</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Upload Photos -->
            <div class="form-section">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Photos de l'article (max. 4)
                </label>
                <div class="photo-upload border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer hover:border-gray-400" onclick="document.getElementById('photos-input').click()">
                    <span>+ Ajoute des photos (max. 4)</span>
                    <input type="file" id="photos-input" name="images[]" multiple hidden accept="image/*">
                </div>
                <p class="text-sm text-gray-500 mt-2">Maximum 4 photos. Clique sur une image pour la retirer.</p>
                <div id="photo-preview" class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4"></div>
            </div>

            <!-- Titre -->
            <div class="form-section">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Titre</label>
                <input type="text" id="title" name="title" placeholder="ex : Chemise verte Zara" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ old('title') }}">
            </div>

            <!-- Description -->
            <div class="form-section">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea id="description" name="description" placeholder="ex : porté quelques fois, taille correctement" required
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                          rows="4">{{ old('description') }}</textarea>
            </div>

            <!-- Catégorie principale -->
            <div class="form-section">
                <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Catégorie principale</label>
                <select id="category" name="category" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option disabled selected>Sélectionne une catégorie</option>
                    <option value="femme" {{ old('category') == 'femme' ? 'selected' : '' }}>Femme</option>
                    <option value="homme" {{ old('category') == 'homme' ? 'selected' : '' }}>Homme</option>
                    <option value="enfant" {{ old('category') == 'enfant' ? 'selected' : '' }}>Enfant</option>
                    <option value="maison" {{ old('category') == 'maison' ? 'selected' : '' }}>Maison</option>
                    <option value="electronique" {{ old('category') == 'electronique' ? 'selected' : '' }}>Électronique</option>
                </select>
            </div>

            <!-- Taille -->
            <div class="form-section">
                <label for="taille" class="block text-sm font-medium text-gray-700 mb-2">Taille</label>
                <input type="text" id="taille" name="taille" placeholder="ex : M, 40, 9.5 US..." required
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ old('taille') }}">
            </div>

            <!-- Prix -->
            <div class="form-section">
                <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Prix (FCFA)</label>
                <input type="number" id="price" name="price" min="1" step="0.01" placeholder="ex : 2000" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ old('price') }}">
            </div>

            <!-- État -->
            <div class="form-section">
                <label for="condition" class="block text-sm font-medium text-gray-700 mb-2">État</label>
                <select id="condition" name="condition" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option disabled selected>Choisis l'état de l'article</option>
                    @foreach($conditions as $key => $label)
                        <option value="{{ $key }}" {{ old('condition') == $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Méthode de livraison -->
            <div class="form-section">
                <label for="delivery_method" class="block text-sm font-medium text-gray-700 mb-2">Méthode de livraison</label>
                <select id="delivery_method" name="delivery_method" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option disabled selected>Choisis la méthode de livraison</option>
                    @foreach($deliveryMethods as $key => $label)
                        <option value="{{ $key }}" {{ old('delivery_method') == $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Lieu de rencontre (si remise en main propre) -->
            <div class="form-section" id="meetup-location-section" style="display: none;">
                <label for="meetup_location" class="block text-sm font-medium text-gray-700 mb-2">Lieu de rencontre</label>
                <input type="text" id="meetup_location" name="meetup_location" placeholder="ex : Place du Souvenir, Cotonou"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ old('meetup_location') }}">
            </div>

            <!-- Boutons -->
            <div class="form-buttons flex space-x-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Publier l'annonce
                </button>
                <a href="{{ route('dashboard') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500">
                    Annuler
                </a>
            </div>
        </form>
    </div>

    <!-- Scripts -->
    <script>
        // Show/hide meetup location field based on delivery method
        const deliveryMethodSelect = document.getElementById('delivery_method');
        const meetupLocationSection = document.getElementById('meetup-location-section');

        deliveryMethodSelect.addEventListener('change', function() {
            if (this.value === 'meetup') {
                meetupLocationSection.style.display = 'block';
                document.getElementById('meetup_location').required = true;
            } else {
                meetupLocationSection.style.display = 'none';
                document.getElementById('meetup_location').required = false;
            }
        });

        // Upload photos with limit and removal
        const photosInput = document.getElementById('photos-input');
        const previewContainer = document.getElementById('photo-preview');
        let selectedFiles = [];

        photosInput.addEventListener('change', (event) => {
            const files = Array.from(event.target.files);
            if (selectedFiles.length + files.length > 4) {
                alert("Tu peux ajouter jusqu'à 4 photos maximum.");
                return;
            }

            files.forEach(file => {
                if (file.type.startsWith('image/')) {
                    selectedFiles.push(file);
                    displayPhoto(file);
                }
            });

            updateHiddenInput();
        });

        function displayPhoto(file) {
            const div = document.createElement('div');
            div.className = 'relative';

            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.className = 'w-full h-32 object-cover rounded-lg cursor-pointer';
            img.title = "Clique pour supprimer";

            const removeBtn = document.createElement('button');
            removeBtn.innerHTML = '×';
            removeBtn.className = 'absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm hover:bg-red-600';
            removeBtn.type = 'button';

            removeBtn.onclick = () => {
                const index = selectedFiles.indexOf(file);
                if (index > -1) {
                    selectedFiles.splice(index, 1);
                    div.remove();
                    updateHiddenInput();
                }
            };

            div.appendChild(img);
            div.appendChild(removeBtn);
            previewContainer.appendChild(div);
        }

        function updateHiddenInput() {
            const dataTransfer = new DataTransfer();
            selectedFiles.forEach(file => dataTransfer.items.add(file));
            photosInput.files = dataTransfer.files;
        }
    </script>
</x-app-layout>