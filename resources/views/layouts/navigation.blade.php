<!-- MENU DESKTOP -->
<div class="container-menu-desktop">
	<div class="wrap-menu-desktop how-shadow1">
		<nav class="limiter-menu-desktop container">
			<!-- LOGO -->
			<a href="{{ url('/') }}" class="logo">
				<img src="{{ asset('images/icons/logo-transparent.png') }}" alt="IMG-LOGO" width="60%" height="100%">
			</a>

			<!-- MENU DESKTOP -->
			<div class="menu-desktop">
				<ul class="main-menu">
					<li><a href="{{ url('/') }}">Accueil</a></li>
					<li><a href="{{ url('/items') }}">Boutique</a></li>
					<li><a href="{{ url('/about') }}">A propos</a></li>
					<li><a href="{{ url('/contact') }}">Contact</a></li>
				</ul>
			</div>

			<!-- BARRE DE RECHERCHE + ICONES -->
			<div class="wrap-icon-header flex-w flex-r-m">
				<form action="{{ url('/search') }}" method="GET" class="search-bar-header">
					<input type="text" name="query" placeholder="Rechercher..." class="input-search-header">
					<button type="submit" class="btn-search-header"><i class="zmdi zmdi-search"></i></button>
				</form>

				@auth
					<!-- Icône panier -->
					<div class="icon-header-item">
						<a href="{{ url('/shopping-cart') }}"><i class="zmdi zmdi-shopping-cart"></i></a>
					</div>

					<!-- Icône notifications -->
					<div class="icon-header-item js-show-notifications">
						<a href="#"><i class="zmdi zmdi-notifications"></i></a>
					</div>

					<!-- Icône favoris -->
					<a href="#" class="icon-header-item">
						<i class="zmdi zmdi-favorite-outline"></i>
					</a>

					<!-- Icône messages -->
					<a href="#" class="icon-header-item">
						<i class="zmdi zmdi-email"></i>
					</a>

					<!-- Menu profil -->
					<div class="profile-dropdown" id="profileDropdown">
						<div class="profile-toggle" onclick="toggleProfileMenu()">
							<img src="{{ asset('images/profile.png') }}" alt="Profil" class="profile-icon">
							<i class="zmdi zmdi-chevron-down"></i>
						</div>
						<div class="profile-menu" id="profileMenu">
							<a href="{{ url('/profile') }}"><i class="zmdi zmdi-account"></i> Mon profil</a>
							<form method="POST" action="{{ route('logout') }}">
								@csrf
								<button type="submit"><i class="zmdi zmdi-power"></i> Déconnexion</button>
							</form>
						</div>
					</div>
				@endauth

				@guest
					<div class="profile-menu1 d-flex align-items-center">
						<a href="{{ url('/login') }}" class="btn btn-dark px-3">Connexion</a>
						<div class="mx-2" style="border-left: 2px solid #ccc; height: 25px;"></div>
						<a href="{{ url('/register') }}" class="btn custom-btn px-3">Inscription</a>
					</div>
				@endguest
			</div>
		</nav>
	</div>
</div>

<!-- Script menu déroulant du profil -->
<script>
	function toggleProfileMenu() {
		const menu = document.getElementById('profileMenu');
		menu.style.display = (menu.style.display === 'flex') ? 'none' : 'flex';
	}

	window.addEventListener('click', function(e) {
		const dropdown = document.getElementById('profileDropdown');
		const menu = document.getElementById('profileMenu');
		if (!dropdown.contains(e.target)) {
			menu.style.display = 'none';
		}
	});
</script>
