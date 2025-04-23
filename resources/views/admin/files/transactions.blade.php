@extends('admin.template')

@section('title', 'Transactions')

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

    .date-picker {
        display: flex;
        align-items: center;
    }

    .date-picker input {
        padding: 8px 15px;
        border: 1px solid #e0e0e0;
        border-radius: 5px;
        font-size: 14px;
        outline: none;
        margin-right: 10px;
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

    /* Summary Cards */
    .summary-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 20px;
    }

    .summary-card {
        background: white;
        border-radius: 10px;
        padding: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .summary-card-title {
        font-size: 14px;
        color: var(--gray);
        margin-bottom: 10px;
    }

    .summary-card-value {
        font-size: 22px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .summary-card-footer {
        font-size: 12px;
        color: var(--gray);
        display: flex;
        align-items: center;
    }

    .summary-card-footer.up {
        color: var(--success);
    }

    .summary-card-footer.down {
        color: var(--danger);
    }

    .summary-card-footer i {
        margin-right: 5px;
    }

    /* Transactions Table */
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

    .transaction-item {
        width: 30px;
        height: 30px;
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }

    .transaction-item.clothing {
        background-color: #6C63FF;
    }

    .transaction-item.electronics {
        background-color: #FF6384;
    }

    .transaction-item.books {
        background-color: #36A2EB;
    }

    .transaction-item.home {
        background-color: #FFCE56;
    }

    .status {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }

    .status.completed {
        background-color: rgba(40, 167, 69, 0.2);
        color: #155724;
    }

    .status.pending {
        background-color: rgba(255, 193, 7, 0.2);
        color: #856404;
    }

    .status.failed {
        background-color: rgba(220, 53, 69, 0.2);
        color: #721c24;
    }

    .status.refunded {
        background-color: rgba(23, 162, 184, 0.2);
        color: #0c5460;
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

    .action-btn.btn-refund {
        background-color: var(--warning);
        color: #333;
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

        .date-picker {
            width: 100%;
            margin-bottom: 10px;
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

        .summary-cards {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 480px) {
        .summary-cards {
            grid-template-columns: 1fr;
        }
    }
</style>

<!-- Filter Bar -->
<div class="filter-bar">
    <div class="filter-group">
        <label>Filtrer par :</label>
        <select class="filter-select">
            <option>Toutes les transactions</option>
            <option>Complétées</option>
            <option>En attente</option>
            <option>Échouées</option>
            <option>Remboursées</option>
        </select>

        <div class="date-picker">
            <input type="date" id="start-date">
            <span>à</span>
            <input type="date" id="end-date">
        </div>
    </div>

    <div class="search-box">
        <i class="fas fa-search"></i>
        <input type="text" placeholder="Rechercher une transaction...">
    </div>
</div>

<!-- Summary Cards -->
<div class="summary-cards">
    <div class="summary-card">
        <div class="summary-card-title">Transactions Total</div>
        <div class="summary-card-value">1,845,000 FCFA</div>
        <div class="summary-card-footer up">
            <i class="fas fa-arrow-up"></i> 12% ce mois
        </div>
    </div>
    <div class="summary-card">
        <div class="summary-card-title">Commission Totale</div>
        <div class="summary-card-value">92,250 FCFA</div>
        <div class="summary-card-footer up">
            <i class="fas fa-arrow-up"></i> 5% sur chaque vente
        </div>
    </div>
    <div class="summary-card">
        <div class="summary-card-title">Transactions Complètes</div>
        <div class="summary-card-value">143</div>
        <div class="summary-card-footer up">
            <i class="fas fa-arrow-up"></i> 8% ce mois
        </div>
    </div>
    <div class="summary-card">
        <div class="summary-card-title">Transactions Échouées</div>
        <div class="summary-card-value">7</div>
        <div class="summary-card-footer down">
            <i class="fas fa-arrow-down"></i> 2% ce mois
        </div>
    </div>
</div>

<!-- Transactions Table -->
<div class="table-container">
    <div class="table-header">
        <div class="table-title">Historique des Transactions</div>
        <div>
            <button class="btn btn-secondary">
                <i class="fas fa-file-export"></i> Exporter
            </button>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Article</th>
                <th>Vendeur</th>
                <th>Acheteur</th>
                <th>Montant</th>
                <th>Commission</th>
                <th>Date</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>#TRX-78945</td>
                <td>
                    <div class="transaction-item clothing">
                        <i class="fas fa-tshirt"></i>
                    </div>
                    Chemise homme
                </td>
                <td>Jean D.</td>
                <td>Marie K.</td>
                <td>25,000 FCFA</td>
                <td>1,250 FCFA</td>
                <td>15/06/2023</td>
                <td><span class="status completed">Complété</span></td>
                <td>
                    <button class="action-btn btn-view"><i class="fas fa-eye"></i></button>
                    <button class="action-btn btn-refund"><i class="fas fa-undo"></i></button>
                </td>
            </tr>
            <tr>
                <td>#TRX-78944</td>
                <td>
                    <div class="transaction-item books">
                        <i class="fas fa-book"></i>
                    </div>
                    Livre "L'Étranger"
                </td>
                <td>Marie K.</td>
                <td>Paul A.</td>
                <td>5,000 FCFA</td>
                <td>250 FCFA</td>
                <td>14/06/2023</td>
                <td><span class="status completed">Complété</span></td>
                <td>
                    <button class="action-btn btn-view"><i class="fas fa-eye"></i></button>
                    <button class="action-btn btn-refund"><i class="fas fa-undo"></i></button>
                </td>
            </tr>
            <tr>
                <td>#TRX-78943</td>
                <td>
                    <div class="transaction-item electronics">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    Smartphone S10
                </td>
                <td>Paul A.</td>
                <td>Sophie T.</td>
                <td>150,000 FCFA</td>
                <td>7,500 FCFA</td>
                <td>13/06/2023</td>
                <td><span class="status pending">En attente</span></td>
                <td>
                    <button class="action-btn btn-view"><i class="fas fa-eye"></i></button>
                    <button class="action-btn btn-refund"><i class="fas fa-undo"></i></button>
                </td>
            </tr>
            <tr>
                <td>#TRX-78942</td>
                <td>
                    <div class="transaction-item home">
                        <i class="fas fa-couch"></i>
                    </div>
                    Table basse
                </td>
                <td>David K.</td>
                <td>Anna L.</td>
                <td>35,000 FCFA</td>
                <td>1,750 FCFA</td>
                <td>12/06/2023</td>
                <td><span class="status failed">Échoué</span></td>
                <td>
                    <button class="action-btn btn-view"><i class="fas fa-eye"></i></button>
                </td>
            </tr>
            <tr>
                <td>#TRX-78941</td>
                <td>
                    <div class="transaction-item clothing">
                        <i class="fas fa-shoe-prints"></i>
                    </div>
                    Chaussures Nike
                </td>
                <td>Sophie T.</td>
                <td>Thomas P.</td>
                <td>25,000 FCFA</td>
                <td>1,250 FCFA</td>
                <td>10/06/2023</td>
                <td><span class="status refunded">Remboursé</span></td>
                <td>
                    <button class="action-btn btn-view"><i class="fas fa-eye"></i></button>
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

        // Définir la date par défaut (aujourd'hui)
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('start-date').value = today;
        document.getElementById('end-date').value = today;
    });
</script>
@endsection