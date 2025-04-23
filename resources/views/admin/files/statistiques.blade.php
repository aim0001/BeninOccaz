@extends('admin.template')

@section('title', 'Statistiques')

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

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .stat-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .stat-card-title {
        font-size: 16px;
        font-weight: 600;
        color: var(--dark);
    }

    .stat-card-value {
        font-size: 28px;
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

    .stat-card-footer.down {
        color: var(--danger);
    }

    .stat-card-footer i {
        margin-right: 5px;
    }

    /* Charts Container */
    .chart-container {
        background: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
    }

    .chart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .chart-title {
        font-size: 18px;
        font-weight: 600;
    }

    .chart-wrapper {
        position: relative;
        height: 300px;
        width: 100%;
    }

    /* Top Items */
    .top-items {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .top-items-card {
        background: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .top-items-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .top-items-title {
        font-size: 16px;
        font-weight: 600;
        color: var(--dark);
    }

    .top-item {
        display: flex;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .top-item:last-child {
        border-bottom: none;
    }

    .item-rank {
        font-weight: 700;
        width: 30px;
        color: var(--gray);
    }

    .item-img {
        width: 40px;
        height: 40px;
        border-radius: 5px;
        object-fit: cover;
        margin-right: 15px;
    }

    .item-info {
        flex: 1;
    }

    .item-name {
        font-weight: 500;
        margin-bottom: 3px;
    }

    .item-meta {
        font-size: 12px;
        color: var(--gray);
    }

    .item-value {
        font-weight: 600;
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
    }

    @media (max-width: 768px) {

        .stats-grid,
        .top-items {
            grid-template-columns: 1fr;
        }
    }
</style>
<!-- Filter Bar -->
<div class="filter-bar">
    <div class="filter-group">
        <label>Période :</label>
        <select class="filter-select">
            <option>7 derniers jours</option>
            <option>30 derniers jours</option>
            <option>3 derniers mois</option>
            <option>6 derniers mois</option>
            <option>Cette année</option>
            <option>Toutes périodes</option>
        </select>

        <div class="date-picker">
            <input type="date" id="start-date">
            <span>à</span>
            <input type="date" id="end-date">
        </div>
    </div>

    <button class="btn btn-secondary">
        <i class="fas fa-file-export"></i> Exporter Rapport
    </button>
</div>

<!-- Key Stats -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-card-header">
            <div class="stat-card-title">Chiffre d'Affaires</div>
            <i class="fas fa-money-bill-wave" style="color: var(--success);"></i>
        </div>
        <div class="stat-card-value">5,842,500 FCFA</div>
        <div class="stat-card-footer up">
            <i class="fas fa-arrow-up"></i> 15% vs période précédente
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-card-header">
            <div class="stat-card-title">Commission Totale</div>
            <i class="fas fa-percentage" style="color: var(--primary);"></i>
        </div>
        <div class="stat-card-value">292,125 FCFA</div>
        <div class="stat-card-footer up">
            <i class="fas fa-arrow-up"></i> 5% sur chaque vente
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-card-header">
            <div class="stat-card-title">Transactions</div>
            <i class="fas fa-exchange-alt" style="color: var(--info);"></i>
        </div>
        <div class="stat-card-value">1,248</div>
        <div class="stat-card-footer up">
            <i class="fas fa-arrow-up"></i> 22% vs période précédente
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-card-header">
            <div class="stat-card-title">Nouveaux Utilisateurs</div>
            <i class="fas fa-user-plus" style="color: var(--warning);"></i>
        </div>
        <div class="stat-card-value">342</div>
        <div class="stat-card-footer up">
            <i class="fas fa-arrow-up"></i> 8% vs période précédente
        </div>
    </div>
</div>

<!-- Charts Row 1 -->
<div class="chart-container">
    <div class="chart-header">
        <div class="chart-title">Évolution du Chiffre d'Affaires</div>
        <div>
            <button class="btn-secondary" style="padding: 5px 10px; font-size: 12px;">
                <i class="fas fa-ellipsis-h"></i>
            </button>
        </div>
    </div>
    <div class="chart-wrapper">
        <canvas id="revenueChart"></canvas>
    </div>
</div>

<!-- Top Items -->
<div class="top-items">
    <div class="top-items-card">
        <div class="top-items-header">
            <div class="top-items-title">Top 5 Vendeurs</div>
            <i class="fas fa-users" style="color: var(--primary);"></i>
        </div>

        <div class="top-item">
            <div class="item-rank">1</div>
            <img src="https://via.placeholder.com/40" alt="Vendeur" class="item-img">
            <div class="item-info">
                <div class="item-name">Jean Dupont</div>
                <div class="item-meta">45 ventes</div>
            </div>
            <div class="item-value">875,000 FCFA</div>
        </div>

        <div class="top-item">
            <div class="item-rank">2</div>
            <img src="https://via.placeholder.com/40" alt="Vendeur" class="item-img">
            <div class="item-info">
                <div class="item-name">Marie Koné</div>
                <div class="item-meta">38 ventes</div>
            </div>
            <div class="item-value">720,000 FCFA</div>
        </div>

        <div class="top-item">
            <div class="item-rank">3</div>
            <img src="https://via.placeholder.com/40" alt="Vendeur" class="item-img">
            <div class="item-info">
                <div class="item-name">Paul Akpabli</div>
                <div class="item-meta">32 ventes</div>
            </div>
            <div class="item-value">615,000 FCFA</div>
        </div>

        <div class="top-item">
            <div class="item-rank">4</div>
            <img src="https://via.placeholder.com/40" alt="Vendeur" class="item-img">
            <div class="item-info">
                <div class="item-name">Sophie Tossa</div>
                <div class="item-meta">28 ventes</div>
            </div>
            <div class="item-value">540,000 FCFA</div>
        </div>

        <div class="top-item">
            <div class="item-rank">5</div>
            <img src="https://via.placeholder.com/40" alt="Vendeur" class="item-img">
            <div class="item-info">
                <div class="item-name">David Koffi</div>
                <div class="item-meta">25 ventes</div>
            </div>
            <div class="item-value">485,000 FCFA</div>
        </div>
    </div>

    <div class="top-items-card">
        <div class="top-items-header">
            <div class="top-items-title">Top 5 Catégories</div>
            <i class="fas fa-tags" style="color: var(--success);"></i>
        </div>

        <div class="top-item">
            <div class="item-rank">1</div>
            <img src="https://via.placeholder.com/40/e2f0fd/6C63FF" alt="Catégorie" class="item-img">
            <div class="item-info">
                <div class="item-name">Vêtements</div>
                <div class="item-meta">312 articles vendus</div>
            </div>
            <div class="item-value">1,245,000 FCFA</div>
        </div>

        <div class="top-item">
            <div class="item-rank">2</div>
            <img src="https://via.placeholder.com/40/e2f0fd/FF6384" alt="Catégorie" class="item-img">
            <div class="item-info">
                <div class="item-name">Électronique</div>
                <div class="item-meta">198 articles vendus</div>
            </div>
            <div class="item-value">1,150,000 FCFA</div>
        </div>

        <div class="top-item">
            <div class="item-rank">3</div>
            <img src="https://via.placeholder.com/40/e2f0fd/36A2EB" alt="Catégorie" class="item-img">
            <div class="item-info">
                <div class="item-name">Livres</div>
                <div class="item-meta">287 articles vendus</div>
            </div>
            <div class="item-value">875,000 FCFA</div>
        </div>

        <div class="top-item">
            <div class="item-rank">4</div>
            <img src="https://via.placeholder.com/40/e2f0fd/FFCE56" alt="Catégorie" class="item-img">
            <div class="item-info">
                <div class="item-name">Maison</div>
                <div class="item-meta">156 articles vendus</div>
            </div>
            <div class="item-value">720,000 FCFA</div>
        </div>

        <div class="top-item">
            <div class="item-rank">5</div>
            <img src="https://via.placeholder.com/40/e2f0fd/4BC0C0" alt="Catégorie" class="item-img">
            <div class="item-info">
                <div class="item-name">Chaussures</div>
                <div class="item-meta">134 articles vendus</div>
            </div>
            <div class="item-value">652,000 FCFA</div>
        </div>
    </div>
</div>

<!-- Charts Row 2 -->
<div class="chart-container">
    <div class="chart-header">
        <div class="chart-title">Répartition des Transactions par Statut</div>
        <div>
            <button class="btn-secondary" style="padding: 5px 10px; font-size: 12px;">
                <i class="fas fa-ellipsis-h"></i>
            </button>
        </div>
    </div>
    <div class="chart-wrapper">
        <canvas id="statusChart"></canvas>
    </div>
</div>

<!-- Charts Row 3 -->
<div class="chart-container">
    <div class="chart-header">
        <div class="chart-title">Évolution des Inscriptions Utilisateurs</div>
        <div>
            <button class="btn-secondary" style="padding: 5px 10px; font-size: 12px;">
                <i class="fas fa-ellipsis-h"></i>
            </button>
        </div>
    </div>
    <div class="chart-wrapper">
        <canvas id="usersChart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
<script>
    // Définir la date par défaut
    document.addEventListener('DOMContentLoaded', function() {
        const today = new Date();
        const lastMonth = new Date();
        lastMonth.setMonth(today.getMonth() - 1);

        document.getElementById('start-date').valueAsDate = lastMonth;
        document.getElementById('end-date').valueAsDate = today;

        // Initialiser les graphiques
        initCharts();
    });

    function initCharts() {
        // Revenue Chart
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'],
                datasets: [{
                    label: 'Chiffre d\'Affaires (FCFA)',
                    data: [450000, 520000, 480000, 620000, 750000, 820000, 780000, 850000, 920000, 880000, 950000, 1100000],
                    borderColor: '#6C63FF',
                    backgroundColor: 'rgba(108, 99, 255, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.parsed.y.toLocaleString('fr-FR') + ' FCFA';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString('fr-FR') + ' FCFA';
                            }
                        }
                    }
                }
            }
        });

        // Status Chart
        const statusCtx = document.getElementById('statusChart').getContext('2d');
        const statusChart = new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Complétées', 'En attente', 'Échouées', 'Remboursées'],
                datasets: [{
                    data: [1248, 56, 24, 18],
                    backgroundColor: [
                        '#28A745',
                        '#FFC107',
                        '#DC3545',
                        '#17A2B8'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = Math.round((value / total) * 100);
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });

        // Users Chart
        const usersCtx = document.getElementById('usersChart').getContext('2d');
        const usersChart = new Chart(usersCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'],
                datasets: [{
                    label: 'Nouveaux Utilisateurs',
                    data: [45, 58, 62, 78, 85, 92, 88, 76, 105, 120, 132, 148],
                    backgroundColor: '#4D44DB',
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 20
                        }
                    }
                }
            }
        });
    }
</script>
@endsection