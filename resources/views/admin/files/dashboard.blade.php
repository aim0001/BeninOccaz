@extends('admin.template')

@section('title', 'Dashboard')

@section('content')
<style>
    /* Cards */
    .cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .card {
        background: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .card-title {
        font-size: 14px;
        color: var(--gray);
        font-weight: 500;
    }

    .card-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }

    .card-icon.primary {
        background-color: var(--primary);
    }

    .card-icon.success {
        background-color: var(--success);
    }

    .card-icon.warning {
        background-color: var(--warning);
    }

    .card-icon.danger {
        background-color: var(--danger);
    }

    .card-value {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .card-footer {
        font-size: 12px;
        color: var(--gray);
    }

    /* Tables */
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

    .status {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }

    .status.pending {
        background-color: rgba(255, 193, 7, 0.2);
        color: #856404;
    }

    .status.completed {
        background-color: rgba(40, 167, 69, 0.2);
        color: #155724;
    }

    .status.failed {
        background-color: rgba(220, 53, 69, 0.2);
        color: #721c24;
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
    }

    .action-btn:hover {
        background-color: var(--secondary);
    }

    /* Chart Container */
    .chart-container {
        background: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .cards {
            grid-template-columns: 1fr;
        }
    }
</style>
<!-- Cards -->
<div class="cards">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Transactions Total</div>
            <div class="card-icon primary">
                <i class="fas fa-money-bill-wave"></i>
            </div>
        </div>
        <div class="card-value">1,245,000 FCFA</div>
        <div class="card-footer">+12% ce mois</div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="card-title">Commission Totale</div>
            <div class="card-icon success">
                <i class="fas fa-percentage"></i>
            </div>
        </div>
        <div class="card-value">62,250 FCFA</div>
        <div class="card-footer">5% sur chaque vente</div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="card-title">Annonces Actives</div>
            <div class="card-icon warning">
                <i class="fas fa-shopping-bag"></i>
            </div>
        </div>
        <div class="card-value">287</div>
        <div class="card-footer">+24 nouvelles</div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="card-title">Utilisateurs</div>
            <div class="card-icon danger">
                <i class="fas fa-users"></i>
            </div>
        </div>
        <div class="card-value">1,532</div>
        <div class="card-footer">+58 nouveaux</div>
    </div>
</div>

<!-- Recent Transactions -->
<div class="table-container">
    <div class="table-header">
        <div class="table-title">Transactions Récentes</div>
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Rechercher...">
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Vendeur</th>
                <th>Acheteur</th>
                <th>Montant</th>
                <th>Commission</th>
                <th>Statut</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>#TRX-78945</td>
                <td>Jean D.</td>
                <td>Marie K.</td>
                <td>25,000 FCFA</td>
                <td>1,250 FCFA</td>
                <td><span class="status completed">Complété</span></td>
                <td><button class="action-btn">Voir</button></td>
            </tr>
            <tr>
                <td>#TRX-78944</td>
                <td>Paul A.</td>
                <td>Sophie T.</td>
                <td>15,000 FCFA</td>
                <td>750 FCFA</td>
                <td><span class="status pending">En attente</span></td>
                <td><button class="action-btn">Voir</button></td>
            </tr>
            <tr>
                <td>#TRX-78943</td>
                <td>Lucie M.</td>
                <td>David K.</td>
                <td>32,000 FCFA</td>
                <td>1,600 FCFA</td>
                <td><span class="status completed">Complété</span></td>
                <td><button class="action-btn">Voir</button></td>
            </tr>
            <tr>
                <td>#TRX-78942</td>
                <td>Eric B.</td>
                <td>Anna L.</td>
                <td>18,500 FCFA</td>
                <td>925 FCFA</td>
                <td><span class="status failed">Échoué</span></td>
                <td><button class="action-btn">Voir</button></td>
            </tr>
            <tr>
                <td>#TRX-78941</td>
                <td>Sarah J.</td>
                <td>Thomas P.</td>
                <td>42,000 FCFA</td>
                <td>2,100 FCFA</td>
                <td><span class="status completed">Complété</span></td>
                <td><button class="action-btn">Voir</button></td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Recent Disputes -->
<div class="table-container">
    <div class="table-header">
        <div class="table-title">Litiges Récents</div>
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Rechercher...">
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Transaction</th>
                <th>Raison</th>
                <th>Statut</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>#DSP-10045</td>
                <td>#TRX-78942</td>
                <td>Article non conforme</td>
                <td><span class="status pending">En cours</span></td>
                <td>12/06/2023</td>
                <td><button class="action-btn">Traiter</button></td>
            </tr>
            <tr>
                <td>#DSP-10044</td>
                <td>#TRX-78938</td>
                <td>Livraison non reçue</td>
                <td><span class="status pending">En cours</span></td>
                <td>10/06/2023</td>
                <td><button class="action-btn">Traiter</button></td>
            </tr>
            <tr>
                <td>#DSP-10043</td>
                <td>#TRX-78935</td>
                <td>Problème de paiement</td>
                <td><span class="status completed">Résolu</span></td>
                <td>08/06/2023</td>
                <td><button class="action-btn">Voir</button></td>
            </tr>
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
<script>
    // Simple animation for cards on load
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.card');
        cards.forEach((card, index) => {
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });

        // Add hover effect to table rows
        const tableRows = document.querySelectorAll('tbody tr');
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
@endpush