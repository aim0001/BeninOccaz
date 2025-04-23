<div class="sidebar">
    <div class="sidebar-header">
        <img src="https://via.placeholder.com/40" alt="Logo">
        <h3>MaAmir Admin</h3>
    </div>
    <div class="sidebar-menu">
        <ul>
            <li><a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
            <li><a href="{{ route('admin.annonces') }}" class="{{ request()->routeIs('admin.annonces') ? 'active' : '' }}"><i class="fas fa-shopping-bag"></i> <span>Annonces</span></a></li>
            <li><a href="{{ route('admin.transactions') }}" class="{{ request()->routeIs('admin.transactions') ? 'active' : '' }}"><i class="fas fa-exchange-alt"></i> <span>Transactions</span></a></li>
            <li><a href="{{ route('admin.utilisateurs') }}" class="{{ request()->routeIs('admin.utilisateurs') ? 'active' : '' }}"><i class="fas fa-users"></i> <span>Utilisateurs</span></a></li>
            <li><a href="{{ route('admin.litiges') }}" class="{{ request()->routeIs('admin.litiges') ? 'active' : '' }}"><i class="fas fa-exclamation-circle"></i> <span>Litiges</span></a></li>
            <li><a href="{{ route('admin.statistiques') }}" class="{{ request()->routeIs('admin.statistiques') ? 'active' : '' }}"><i class="fas fa-chart-line"></i> <span>Statistiques</span></a></li>
            <li><a href="{{ route('admin.parametres') }}" class="{{ request()->routeIs('admin.parametres') ? 'active' : '' }}"><i class="fas fa-cog"></i> <span>Paramètres</span></a></li>
        </ul>

        <!-- Bouton de déconnexion -->
        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> <span>Déconnexion</span>
                </button>
            </form>
        </div>
    </div>
</div>
<style>
    /* Styles pour le bouton de déconnexion */
    .sidebar-footer {
        margin-top: auto;
        /* Pousse le bouton vers le bas */
        padding: 15px 20px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .logout-btn {
        background: none;
        border: none;
        color: rgba(255, 255, 255, 0.8);
        cursor: pointer;
        display: flex;
        align-items: center;
        width: 100%;
        padding: 10px;
        font-size: 14px;
        transition: all 0.3s;
    }

    .logout-btn:hover {
        color: white;
        background-color: rgba(255, 255, 255, 0.1);
        border-left: 3px solid var(--danger);
    }

    .logout-btn i {
        margin-right: 10px;
        font-size: 16px;
    }
</style>