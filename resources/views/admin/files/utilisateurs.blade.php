@extends('admin.template')

@section('title', 'Utilisateurs')

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

    /* User Stats */
    .user-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 20px;
    }

    .stat-card {
        background: white;
        border-radius: 10px;
        padding: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .stat-card-title {
        font-size: 14px;
        color: var(--gray);
        margin-bottom: 10px;
    }

    .stat-card-value {
        font-size: 22px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .stat-card-footer {
        font-size: 12px;
        color: var(--gray);
        display: flex;
        align-items: center;
    }

    .stat-card-footer.up {
        color: var(--success);
    }

    .stat-card-footer i {
        margin-right: 5px;
    }

    /* Users Table */
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

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
    }

    .user-type {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }

    .user-type.seller {
        background-color: rgba(108, 99, 255, 0.2);
        color: var(--secondary);
    }

    .user-type.buyer {
        background-color: rgba(40, 167, 69, 0.2);
        color: #155724;
    }

    .user-type.admin {
        background-color: rgba(220, 53, 69, 0.2);
        color: #721c24;
    }

    .user-status {
        display: inline-block;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        margin-right: 5px;
    }

    .user-status.active {
        background-color: var(--success);
    }

    .user-status.inactive {
        background-color: var(--gray);
    }

    .user-status.banned {
        background-color: var(--danger);
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

    .action-btn.btn-ban {
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

        .user-stats {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 480px) {
        .user-stats {
            grid-template-columns: 1fr;
        }
    }
</style>
<!-- Filter Bar -->
<div class="filter-bar">
    <div class="filter-group">
        <label>Filtrer par :</label>
        <select class="filter-select">
            <option>Tous les utilisateurs</option>
            <option>Vendeurs</option>
            <option>Acheteurs</option>
            <option>Vérifiés</option>
            <option>Non vérifiés</option>
        </select>

        <select class="filter-select">
            <option>Tous statuts</option>
            <option>Actifs</option>
            <option>Inactifs</option>
            <option>Bannis</option>
        </select>
    </div>

    <div class="search-box">
        <i class="fas fa-search"></i>
        <input type="text" placeholder="Rechercher un utilisateur...">
    </div>
</div>

<!-- User Stats -->
<div class="user-stats">
    <div class="stat-card">
        <div class="stat-card-title">Utilisateurs Total</div>
        <div class="stat-card-value">1,842</div>
        <div class="stat-card-footer up">
            <i class="fas fa-arrow-up"></i> 12% ce mois
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-card-title">Vendeurs</div>
        <div class="stat-card-value">756</div>
        <div class="stat-card-footer up">
            <i class="fas fa-arrow-up"></i> 8% ce mois
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-card-title">Acheteurs</div>
        <div class="stat-card-value">1,086</div>
        <div class="stat-card-footer up">
            <i class="fas fa-arrow-up"></i> 15% ce mois
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-card-title">Utilisateurs Bannis</div>
        <div class="stat-card-value">23</div>
        <div class="stat-card-footer">
            <i class="fas fa-minus"></i> Stable
        </div>
    </div>
</div>

<!-- Users Table -->
<div class="table-container">
    <div class="table-header">
        <div class="table-title">Liste des Utilisateurs</div>
        <div>
            <button class="btn btn-secondary">
                <i class="fas fa-file-export"></i> Exporter
            </button>
            <button class="btn">
                <i class="fas fa-plus"></i> Nouvel Utilisateur
            </button>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Utilisateur</th>
                <th>Email/Téléphone</th>
                <th>Type</th>
                <th>Inscription</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>#USR-45781</td>
                <td>
                    <img src="https://via.placeholder.com/40" alt="User" class="user-avatar">
                    Jean Dupont
                </td>
                <td>jean.dupont@example.com<br>+229 12 34 56 78</td>
                <td><span class="user-type seller">Vendeur</span></td>
                <td>15/05/2023</td>
                <td><span class="user-status active"></span> Actif</td>
                <td>
                    <button class="action-btn btn-view"><i class="fas fa-eye"></i></button>
                    <button class="action-btn btn-edit"><i class="fas fa-edit"></i></button>
                    <button class="action-btn btn-ban"><i class="fas fa-ban"></i></button>
                </td>
            </tr>
            <tr>
                <td>#USR-45780</td>
                <td>
                    <img src="https://via.placeholder.com/40" alt="User" class="user-avatar">
                    Marie Koné
                </td>
                <td>marie.kone@example.com<br>+229 98 76 54 32</td>
                <td><span class="user-type seller">Vendeur</span></td>
                <td>10/05/2023</td>
                <td><span class="user-status active"></span> Actif</td>
                <td>
                    <button class="action-btn btn-view"><i class="fas fa-eye"></i></button>
                    <button class="action-btn btn-edit"><i class="fas fa-edit"></i></button>
                    <button class="action-btn btn-ban"><i class="fas fa-ban"></i></button>
                </td>
            </tr>
            <tr>
                <td>#USR-45779</td>
                <td>
                    <img src="https://via.placeholder.com/40" alt="User" class="user-avatar">
                    Paul Akpabli
                </td>
                <td>paul.akpabli@example.com<br>+229 65 43 21 09</td>
                <td><span class="user-type buyer">Acheteur</span></td>
                <td>08/05/2023</td>
                <td><span class="user-status active"></span> Actif</td>
                <td>
                    <button class="action-btn btn-view"><i class="fas fa-eye"></i></button>
                    <button class="action-btn btn-edit"><i class="fas fa-edit"></i></button>
                    <button class="action-btn btn-ban"><i class="fas fa-ban"></i></button>
                </td>
            </tr>
            <tr>
                <td>#USR-45778</td>
                <td>
                    <img src="https://via.placeholder.com/40" alt="User" class="user-avatar">
                    Sophie Tossa
                </td>
                <td>sophie.tossa@example.com<br>+229 78 90 12 34</td>
                <td><span class="user-type seller">Vendeur</span></td>
                <td>05/05/2023</td>
                <td><span class="user-status inactive"></span> Inactif</td>
                <td>
                    <button class="action-btn btn-view"><i class="fas fa-eye"></i></button>
                    <button class="action-btn btn-edit"><i class="fas fa-edit"></i></button>
                    <button class="action-btn btn-ban"><i class="fas fa-ban"></i></button>
                </td>
            </tr>
            <tr>
                <td>#USR-45777</td>
                <td>
                    <img src="https://via.placeholder.com/40" alt="User" class="user-avatar">
                    David Koffi
                </td>
                <td>david.koffi@example.com<br>+229 56 78 90 12</td>
                <td><span class="user-type admin">Admin</span></td>
                <td>01/05/2023</td>
                <td><span class="user-status active"></span> Actif</td>
                <td>
                    <button class="action-btn btn-view"><i class="fas fa-eye"></i></button>
                    <button class="action-btn btn-edit"><i class="fas fa-edit"></i></button>
                </td>
            </tr>
            <tr>
                <td>#USR-45776</td>
                <td>
                    <img src="https://via.placeholder.com/40" alt="User" class="user-avatar">
                    Anna Lawson
                </td>
                <td>anna.lawson@example.com<br>+229 34 56 78 90</td>
                <td><span class="user-type buyer">Acheteur</span></td>
                <td>28/04/2023</td>
                <td><span class="user-status banned"></span> Banni</td>
                <td>
                    <button class="action-btn btn-view"><i class="fas fa-eye"></i></button>
                    <button class="action-btn btn-edit"><i class="fas fa-edit"></i></button>
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