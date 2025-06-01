<form action="{{ route('items.update', $item->id) }}" method="POST" enctype="multipart/form-data" class="form-annonce">
    @csrf
    @method('PATCH') <!-- 📌 Indique qu’on fait une modification -->

    <div class="form-section">
        <label for="photos" class="photo-upload">
            + Ajoute des nouvelles photos
            <input type="file" id="photos" name="photos[]" multiple hidden accept="image/*">
        </label>
        <p class="photo-tip">🎯 Attire l’œil des acheteurs : utilise des photos de qualité.</p>
        
        <!-- 📷 Prévisualisation des images existantes -->
        <div id="photo-preview">
            @foreach ($item->photos as $photo)
                <img src="{{ asset('storage/' . $photo) }}" style="max-width: 100px; margin: 5px;">
                <input type="checkbox" name="remove_photos[]" value="{{ $photo }}"> Supprimer
            @endforeach
        </div>
    </div>

    <div class="form-section">
        <label for="titre">Titre</label>
        <input type="text" id="titre" name="titre" value="{{ $item->titre }}" required>
    </div>

    <div class="form-section">
        <label for="description">Décris ton article</label>
        <textarea id="description" name="description" required>{{ $item->description }}</textarea>
    </div>

    <div class="form-section">
        <label for="categorie">Catégorie</label>
        <select id="categorie" name="categorie" required>
            <option disabled>Sélectionne une catégorie</option>
            <option value="vetements" {{ $item->categorie == 'vetements' ? 'selected' : '' }}>Vêtements</option>
            <option value="electronique" {{ $item->categorie == 'electronique' ? 'selected' : '' }}>Électronique</option>
            <option value="maison" {{ $item->categorie == 'maison' ? 'selected' : '' }}>Maison</option>
        </select>
    </div>

    <div class="form-section">
        <label for="prix">Prix (FCFA)</label>
        <input type="number" id="prix" name="prix" min="1" step="0.01" value="{{ $item->prix }}" required>
    </div>

    <div class="form-buttons">
        <button type="submit" class="btn-primary">Modifier</button>
    </div>
</form>
<script>
document.getElementById('photos').addEventListener('change', function(event) {
    const preview = document.getElementById('photo-preview');
    
    Array.from(event.target.files).forEach(file => {
        if (file.type.startsWith('image/')) {
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.style.maxWidth = '100px';
            img.style.margin = '5px';
            preview.appendChild(img);
        }
    });
});
</script>
