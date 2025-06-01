<x-app-layout>
    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data" class="form-annonce">
        @csrf

        <!-- Upload Photos -->
        <div class="form-section">
            <label class="photo-upload">
                + Ajoute des photos (max. 4)
                <input type="file" id="photos-input" name="photos[]" multiple hidden accept="image/*">
            </label>
            <p class="photo-tip"> Maximum 4 photos. Clique sur une image pour la retirer.</p>
            <div id="photo-preview" class="preview-grid"></div>
        </div>

        <!-- Titre -->
        <div class="form-section">
            <label for="titre">Titre</label>
            <input type="text" id="titre" name="titre" placeholder="ex : Chemise verte Zara" required class="form-input">
        </div>

        <!-- Description -->
        <div class="form-section">
            <label for="description">Décris ton article</label>
            <textarea id="description" name="description" placeholder="ex : porté quelques fois, taille correctement" required class="form-input"></textarea>
        </div>

        <!-- Catégorie principale -->
        <div class="form-section">
            <label for="categorie">Catégorie principale</label>
            <select id="categorie" name="categorie" required class="form-input">
                <option disabled selected>Sélectionne une catégorie</option>
                <option value="femme">Femme</option>
                <option value="homme">Homme</option>
                <option value="enfant">Enfant</option>
                <option value="maison">Maison</option>
                <option value="electronique">Électronique</option>
            </select>
        </div>

        <!-- Sous-catégorie -->
        <div class="form-section" id="sous-categorie-section" style="display: none;">
            <label for="sous_categorie">Sous-catégorie</label>
            <select id="sous_categorie" name="sous_categorie" class="form-input">
                <!-- Options générées dynamiquement -->
            </select>
        </div>

        <!-- 📏 Taille -->
        <div class="form-section">
            <label for="taille">Taille</label>
            <input type="text" id="taille" name="taille" placeholder="ex : M, 40, 9.5 US..." required>
        </div>
        <!-- Prix -->
        <div class="form-section">
            <label for="prix">Prix (FCFA)</label>
            <input type="number" id="prix" name="prix" min="1" step="0.01" placeholder="ex : 2000" required class="form-input">
        </div>

        <!-- 📦 État -->
        <div class="form-section">
            <label for="etat">État</label>
            <select id="etat" name="etat" required>
                <option disabled selected>Choisis l’état de l’article</option>
                <option value="Neuf avec étiquette">Neuf avec étiquette</option>
                <option value="Très bon état">Très bon état</option>
                <option value="État correct">État correct</option>
            </select>
        </div>

        <form method="POST" action="{{ route('cart.store') }}">
            @csrf
            <div class="form-buttons"> <button type="submit" class="btn-primary">Ajouter</button> </div>
        </form>

    </form>

    <!-- Scripts -->
    <script>
        const categorieSelect = document.getElementById('categorie');
        const sousCategorieSelect = document.getElementById('sous_categorie');
        const sousCategorieSection = document.getElementById('sous-categorie-section');

        const sousCategories = {
            femme: ['Vêtements', 'Sac', 'Chaussure', 'Accessoire', 'Autres'],
            homme: ['Vêtements', 'Sac', 'Chaussure', 'Accessoire', 'Autres'],
            enfant: ['Vêtements', 'Jouets', 'Chaussure', 'Sac', 'Autres'],
            maison: ['Meubles', 'Décoration', 'Cuisine', 'Autres'],
            electronique: ['Téléphones', 'TV', 'Ordinateurs', 'Autres'],
        };

        categorieSelect.addEventListener('change', function () {
            const selected = this.value;
            const options = sousCategories[selected] || [];

            sousCategorieSelect.innerHTML = '<option disabled selected>Choisis une sous-catégorie</option>';
            options.forEach(opt => {
                const option = document.createElement('option');
                option.value = opt.toLowerCase();
                option.textContent = opt;
                sousCategorieSelect.appendChild(option);
            });

            sousCategorieSection.style.display = options.length ? 'block' : 'none';
        });

        // Upload photos avec limite et suppression
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
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.className = 'preview-img';
            img.title = "Clique pour supprimer";

            img.onclick = () => {
                const index = selectedFiles.indexOf(file);
                if (index > -1) {
                    selectedFiles.splice(index, 1);
                    img.remove();
                    updateHiddenInput();
                }
            };

            previewContainer.appendChild(img);
        }

        function updateHiddenInput() {
            const dataTransfer = new DataTransfer();
            selectedFiles.forEach(file => dataTransfer.items.add(file));
            photosInput.files = dataTransfer.files;
        }
    </script>

</x-app-layout>
