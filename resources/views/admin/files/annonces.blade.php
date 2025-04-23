@extends('admin.template')

@section('title', 'Annonces')

@section('content')
<style>
    /* Filter Bar */
    .filter-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        background: white;
        padding: 15px 20px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .filter-group {
        display: flex;
        align-items: center;
    }

    .filter-group label {
        margin-right: 10px;
        font-size: 14px;
        color: var(--gray);
    }

    .filter-select {
        padding: 8px 15px;
        border: 1px solid #e0e0e0;
        border-radius: 5px;
        font-size: 14px;
        outline: none;
        margin-right: 15px;
        min-width: 150px;
    }

    .filter-select:focus {
        border-color: var(--primary);
    }

    .search-box {
        position: relative;
    }

    .search-box input {
        padding: 8px 15px 8px 35px;
        border: 1px solid #e0e0e0;
        border-radius: 20px;
        font-size: 14px;
        outline: none;
        transition: all 0.3s;
        min-width: 250px;
    }

    .search-box input:focus {
        border-color: var(--primary);
    }

    .search-box i {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--gray);
    }

    .btn {
        padding: 8px 15px;
        border-radius: 5px;
        border: none;
        background-color: var(--primary);
        color: white;
        cursor: pointer;
        font-size: 14px;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
    }

    .btn i {
        margin-right: 5px;
    }

    .btn:hover {
        background-color: var(--secondary);
    }

    .btn-secondary {
        background-color: white;
        border: 1px solid #e0e0e0;
        color: var(--gray);
    }

    .btn-secondary:hover {
        background-color: #f8f9fa;
        color: var(--dark);
    }

    /* Annonces Table */
    .table-container {
        background: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
    }

    .table-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .table-title {
        font-size: 18px;
        font-weight: 600;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #e0e0e0;
    }

    th {
        font-weight: 600;
        color: var(--dark);
        font-size: 14px;
    }

    td {
        font-size: 14px;
    }

    .annonce-img {
        width: 50px;
        height: 50px;
        border-radius: 5px;
        object-fit: cover;
    }

    .status {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }

    .status.active {
        background-color: rgba(40, 167, 69, 0.2);
        color: #155724;
    }

    .status.pending {
        background-color: rgba(255, 193, 7, 0.2);
        color: #856404;
    }

    .status.rejected {
        background-color: rgba(220, 53, 69, 0.2);
        color: #721c24;
    }

    .status.sold {
        background-color: rgba(108, 99, 255, 0.2);
        color: var(--secondary);
    }

    .actions {
        display: flex;
        align-items: center;
    }

    .action-btn {
        padding: 5px 10px;
        border-radius: 5px;
        border: none;
        background-color: var(--primary);
        color: white;
        cursor: pointer;
        font-size: 12px;
        transition: all 0.3s;
        margin-right: 5px;
    }

    .action-btn:hover {
        background-color: var(--secondary);
    }

    .action-btn.btn-view {
        background-color: var(--success);
    }

    .action-btn.btn-edit {
        background-color: var(--warning);
        color: #333;
    }

    .action-btn.btn-delete {
        background-color: var(--danger);
    }

    /* Pagination */
    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .pagination a {
        padding: 8px 15px;
        margin: 0 5px;
        border-radius: 5px;
        border: 1px solid #e0e0e0;
        color: var(--gray);
        text-decoration: none;
        transition: all 0.3s;
    }

    .pagination a.active,
    .pagination a:hover {
        background-color: var(--primary);
        color: white;
        border-color: var(--primary);
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .filter-bar {
            flex-direction: column;
            align-items: flex-start;
        }

        .filter-group {
            margin-bottom: 10px;
            width: 100%;
            flex-wrap: wrap;
        }

        .search-box {
            width: 100%;
            margin-top: 10px;
        }

        .search-box input {
            width: 100%;
        }
    }

    @media (max-width: 768px) {
        table {
            display: block;
            overflow-x: auto;
        }
    }
</style>

<!-- Filter Bar -->
<div class="filter-bar">
    <div class="filter-group">
        <label>Filtrer par :</label>
        <select class="filter-select">
            <option>Toutes les annonces</option>
            <option>Actives</option>
            <option>En attente</option>
            <option>Vendues</option>
            <option>Rejetées</option>
        </select>

        <select class="filter-select">
            <option>Toutes catégories</option>
            <option>Vêtements</option>
            <option>Chaussures</option>
            <option>Livres</option>
            <option>Électronique</option>
            <option>Maison</option>
        </select>

        <select class="filter-select">
            <option>Tous les vendeurs</option>
            <option>Vendeur vérifié</option>
            <option>Nouveau vendeur</option>
        </select>
    </div>

    <div class="search-box">
        <i class="fas fa-search"></i>
        <input type="text" placeholder="Rechercher une annonce...">
    </div>
</div>

<!-- Annonces Table -->
<div class="table-container">
    <div class="table-header">
        <div class="table-title">Liste des Annonces</div>
        <div>
            <button class="btn btn-secondary">
                <i class="fas fa-file-export"></i> Exporter
            </button>
            <button class="btn">
                <i class="fas fa-plus"></i> Nouvelle Annonce
            </button>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Titre</th>
                <th>Catégorie</th>
                <th>Vendeur</th>
                <th>Prix</th>
                <th>Date</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>#ANN-45781</td>
                <td><img src="https://via.placeholder.com/50" alt="Produit" class="annonce-img"></td>
                <td>Chemise homme en coton</td>
                <td>Vêtements</td>
                <td>Jean D.</td>
                <td>12,500 FCFA</td>
                <td>15/06/2023</td>
                <td><span class="status active">Active</span></td>
                <td class="actions">
                    <button class="action-btn btn-view"><i class="fas fa-eye"></i></button>
                    <button class="action-btn btn-edit"><i class="fas fa-edit"></i></button>
                    <button class="action-btn btn-delete"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
            <tr>
                <td>#ANN-45780</td>
                <td><img src="https://via.placeholder.com/50" alt="Produit" class="annonce-img"></td>
                <td>Livre "L'Étranger" - Camus</td>
                <td>Livres</td>
                <td>Marie K.</td>
                <td>5,000 FCFA</td>
                <td>14/06/2023</td>
                <td><span class="status sold">Vendue</span></td>
                <td class="actions">
                    <button class="action-btn btn-view"><i class="fas fa-eye"></i></button>
                    <button class="action-btn btn-edit"><i class="fas fa-edit"></i></button>
                    <button class="action-btn btn-delete"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
            <tr>
                <td>#ANN-45779</td>
                <td><img src="https://via.placeholder.com/50" alt="Produit" class="annonce-img"></td>
                <td>Smartphone Samsung Galaxy S10</td>
                <td>Électronique</td>
                <td>Paul A.</td>
                <td>150,000 FCFA</td>
                <td>13/06/2023</td>
                <td><span class="status active">Active</span></td>
                <td class="actions">
                    <button class="action-btn btn-view"><i class="fas fa-eye"></i></button>
                    <button class="action-btn btn-edit"><i class="fas fa-edit"></i></button>
                    <button class="action-btn btn-delete"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
            <tr>
                <td>#ANN-45778</td>
                <td><img src="https://via.placeholder.com/50" alt="Produit" class="annonce-img"></td>
                <td>Chaussures de sport Nike</td>
                <td>Chaussures</td>
                <td>Sophie T.</td>
                <td>25,000 FCFA</td>
                <td>12/06/2023</td>
                <td><span class="status pending">En attente</span></td>
                <td class="actions">
                    <button class="action-btn btn-view"><i class="fas fa-eye"></i></button>
                    <button class="action-btn btn-edit"><i class="fas fa-edit"></i></button>
                    <button class="action-btn btn-delete"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
            <tr>
                <td>#ANN-45777</td>
                <td><img src="https://via.placeholder.com/50" alt="Produit" class="annonce-img"></td>
                <td>Table basse en bois</td>
                <td>Maison</td>
                <td>David K.</td>
                <td>35,000 FCFA</td>
                <td>10/06/2023</td>
                <td><span class="status rejected">Rejetée</span></td>
                <td class="actions">
                    <button class="action-btn btn-view"><i class="fas fa-eye"></i></button>
                    <button class="action-btn btn-edit"><i class="fas fa-edit"></i></button>
                    <button class="action-btn btn-delete"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="pagination">
        <a href="#"><i class="fas fa-angle-left"></i></a>
        <a href="#" class="active">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
        <a href="#"><i class="fas fa-angle-right"></i></a>
    </div>
</div>
<script>
    // Animation pour le chargement des lignes du tableau
    document.addEventListener('DOMContentLoaded', function() {
        const tableRows = document.querySelectorAll('tbody tr');
        tableRows.forEach((row, index) => {
            setTimeout(() => {
                row.style.opacity = '1';
                row.style.transform = 'translateX(0)';
            }, index * 50);
        });

        // Effet hover sur les lignes du tableau
        tableRows.forEach(row => {
            row.addEventListener('mouseenter', () => {
                row.style.backgroundColor = '#f8f9fa';
            });
            row.addEventListener('mouseleave', () => {
                row.style.backgroundColor = '';
            });
        });
    });
</script>
@endsection