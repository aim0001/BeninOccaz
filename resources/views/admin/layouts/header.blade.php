<div class="header">
    <h1>@yield('header-title', 'Tableau de Bord')</h1>
    <div class="user-profile">
        <img src="https://via.placeholder.com/40" alt="User">
        <div class="user-info">
            <h4>{{ Auth::user()->name }}</h4>
            <p>Administrateur</p>
        </div>
    </div>
</div>