<x-app-layout>	
	<!-- Product -->
	<div class="bg0 m-t-23 p-b-140 ">
		<div class="container">
			<div class="flex-w flex-sb-m p-b-52">
				<div class="flex-w flex-l-m filter-tope-group m-tb-10">
				<div class="dropdown-container">
					<button class="dropdown-btn" data-filter=".women"><p>Femme</p></button>
					<div class="dropdown-menu">
						<a href="#">Vêtements</a>
						<a href="#">Sac</a>
						<a href="#">Chaussure</a>
						<a href="#">Accessoire</a>
						<a href="#">Autres</a>

					</div>
				</div>

				<div class="dropdown-container">
					<button class="dropdown-btn" data-filter=".men"><p>Homme</p></button>
					<div class="dropdown-menu">
					<a href="#">Vêtements</a>
						<a href="#">Sac</a>
						<a href="#">Chaussure</a>
						<a href="#">Accessoire</a>
						<a href="#">Autres</a>
					</div>
				</div>

				<div class="dropdown-container">
					<button class="dropdown-btn" data-filter=".kids"><p>Enfant</p></button>
					<div class="dropdown-menu">
						<a href="#">Vêtements</a>
						<a href="#">Jouets</a>
						<a href="#">Chaussure</a>
						<a href="#">Sac</a>
						<a href="#">Autres</a>

					</div>
				</div>

				<div class="dropdown-container">
					<button class="dropdown-btn" data-filter=".maison"><p>Maison</p></button>
					<div class="dropdown-menu">
						<a href="#">Meubles</a>
						<a href="#">Décoration</a>
						<a href="#">Cuisine</a>
						<a href="#">Autres</a>
					</div>
				</div>

				<div class="dropdown-container">
					<button class="dropdown-btn" data-filter=".Électronique"><p>Électronique</p></button>
					<div class="dropdown-menu">
						<a href="#">Téléphones</a>
						<a href="#">TV</a>
						<a href="#">Ordinateurs</a>
						<a href="#">Autres</a>
					</div>
				</div>	
				
				<!-- Search product -->
				<div class="dis-none panel-search w-full p-t-10 p-b-15">
					<div class="bor8 dis-flex p-l-15">
						<button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
							<i class="zmdi zmdi-search"></i>
						</button>

						<input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product" placeholder="Search">
					</div>
				</div>

				<!-- Test Button for Modal -->
				<div class="p-b-20" style="text-align: center;">
					<button onclick="testModal()" style="background: #4f46e5; color: white; padding: 10px 20px; border: none; border-radius: 5px; margin-right: 10px; cursor: pointer;">
						🧪 Test Modal
					</button>
					<span style="color: #666; font-size: 12px;">Click to test modal functionality</span>
				</div>

			<div class="row isotope-grid">
				@foreach ($items as $item)
					<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item {{ $item->category }}">
						<!-- Block2 -->
						<div class="block2 product-card" data-item-id="{{ $item->id }}">
							<div class="block2-pic hov-img0">
								<img src="{{ asset('images/' . $item->images) }}" alt="{{ $item->title }}">
								<a href="{{ url('/product-detail', $item->id) }}" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
									Voir détails
								</a>

								<!-- Hover Details Overlay -->
								<div class="product-hover-details">
									<div class="hover-content">
										<h4 class="hover-title">{{ $item->title }}</h4>
										<p class="hover-price">{{ number_format($item->price, 0, ',', ' ') }} FCFA</p>
										<p class="hover-description">{{ Str::limit($item->description, 80) }}</p>
										<div class="hover-meta">
											<span class="hover-condition">{{ ucfirst($item->condition) }}</span>
											<span class="hover-category">{{ ucfirst($item->category) }}</span>
										</div>
									</div>
								</div>
							</div>
							<div class="block2-txt flex-w flex-t p-t-14">
								<div class="block2-txt-child1 flex-col-l ">
									<a href="javascript:void(0)" class="stext-104 cl4 hov-cl1 trans-04 product-title-link" data-item-id="{{ $item->id }}">
										{{ $item->title }}
									</a>
									<span class="stext-105 cl3">
										{{ number_format($item->price, 0, ',', ' ') }} FCFA
									</span>
								</div>
							</div>
						</div>
					</div>
				@endforeach

			</div>

			<!-- Load more -->
			
			<div class="flex-c-m flex-w w-full p-t-45 ">
				<div class="Voir_Plus">
					<a href="#" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
						<p>Voir plus</p>
					</a>
				</div>
			</div>
		</div>
	</div>
		
	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>

	<!-- Product Details Modal -->
	<div class="wrap-modal1 js-product-modal p-t-60 p-b-20" id="productModal">
		<div class="overlay-modal1 js-hide-product-modal"></div>

		<div class="container">
			<div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
				<button class="how-pos3 hov3 trans-04 js-hide-product-modal">
					<img src="images/icons/icon-close.png" alt="CLOSE">
				</button>

				<div class="row" id="modalContent">
					<!-- Content will be loaded dynamically -->
				</div>
			</div>
		</div>
	</div>

	<!-- Message Modal -->
	<div class="wrap-modal1 js-message-modal p-t-60 p-b-20" id="messageModal">
		<div class="overlay-modal1 js-hide-message-modal"></div>

		<div class="container">
			<div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
				<button class="how-pos3 hov3 trans-04 js-hide-message-modal">
					<img src="images/icons/icon-close.png" alt="CLOSE">
				</button>

				<div class="row">
					<div class="col-md-8 col-lg-6 m-lr-auto">
						<div class="p-l-25 p-r-30 p-lr-0-lg">
							<h4 class="mtext-105 cl2 txt-center p-b-30">
								Contacter le vendeur
							</h4>

							<form id="messageForm" method="POST" action="{{ route('messages.store') }}">
								@csrf
								<input type="hidden" id="receiverId" name="receiver_id" value="">
								<input type="hidden" id="itemId" name="item_id" value="">

								<div class="bor8 m-b-20">
									<textarea class="stext-111 cl2 plh3 size-120 p-lr-28 p-tb-25" name="message" placeholder="Votre message concernant cet article..." required></textarea>
								</div>

								<button type="submit" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
									Envoyer le message
								</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Original Modal1 -->
	<div class="wrap-modal1 js-modal1 p-t-60 p-b-20">
		<div class="overlay-modal1 js-hide-modal1"></div>

		<div class="container">
			<div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
				<button class="how-pos3 hov3 trans-04 js-hide-modal1">
					<img src="images/icons/icon-close.png" alt="CLOSE">
				</button>

				<div class="row">
					<div class="col-md-6 col-lg-7 p-b-30">
						<div class="p-l-25 p-r-30 p-lr-0-lg">
							<div class="wrap-slick3 flex-sb flex-w">
								<div class="wrap-slick3-dots"></div>
								<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

								<div class="slick3 gallery-lb">
									<div class="item-slick3" data-thumb="images/product-detail-01.jpg">
										<div class="wrap-pic-w pos-relative">
											<img src="images/product-detail-01.jpg" alt="IMG-PRODUCT">

											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/product-detail-01.jpg">
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div>

									<div class="item-slick3" data-thumb="images/product-detail-02.jpg">
										<div class="wrap-pic-w pos-relative">
											<img src="images/product-detail-02.jpg" alt="IMG-PRODUCT">

											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/product-detail-02.jpg">
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div>

									<div class="item-slick3" data-thumb="images/product-detail-03.jpg">
										<div class="wrap-pic-w pos-relative">
											<img src="images/product-detail-03.jpg" alt="IMG-PRODUCT">

											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/product-detail-03.jpg">
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-md-6 col-lg-5 p-b-30">
						<div class="p-r-50 p-t-5 p-lr-0-lg">
							<h4 class="mtext-105 cl2 js-name-detail p-b-14">
								Lightweight Jacket
							</h4>

							<span class="mtext-106 cl2">
								$58.79
							</span>

							<p class="stext-102 cl3 p-t-23">
								Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.
							</p>
							
							<!--  -->
							<div class="p-t-33">
								<div class="flex-w flex-r-m p-b-10">
									<div class="size-203 flex-c-m respon6">
										Size
									</div>

									<div class="size-204 respon6-next">
										<div class="rs1-select2 bor8 bg0">
											<select class="js-select2" name="time">
												<option>Choose an option</option>
												<option>Size S</option>
												<option>Size M</option>
												<option>Size L</option>
												<option>Size XL</option>
											</select>
											<div class="dropDownSelect2"></div>
										</div>
									</div>
								</div>

								<div class="flex-w flex-r-m p-b-10">
									<div class="size-203 flex-c-m respon6">
										Color
									</div>

									<div class="size-204 respon6-next">
										<div class="rs1-select2 bor8 bg0">
											<select class="js-select2" name="time">
												<option>Choose an option</option>
												<option>Red</option>
												<option>Blue</option>
												<option>White</option>
												<option>Grey</option>
											</select>
											<div class="dropDownSelect2"></div>
										</div>
									</div>
								</div>

								<div class="flex-w flex-r-m p-b-10">
									<div class="size-204 flex-w flex-m respon6-next">
										<div class="wrap-num-product flex-w m-r-20 m-tb-10">
											<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-minus"></i>
											</div>

											<input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product" value="1">

											<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-plus"></i>
											</div>
										</div>

										<button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
											Add to cart
										</button>
									</div>
								</div>	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<script>
		$(".js-select2").each(function(){
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		})
	</script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/slick/slick.min.js"></script>
	<script src="js/slick-custom.js"></script>
<!--===============================================================================================-->
	<script src="vendor/parallax100/parallax100.js"></script>
	<script>
        $('.parallax100').parallax100();
	</script>
<!--===============================================================================================-->
	<script src="vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
	<script>
		$('.gallery-lb').each(function() { // the containers for all your galleries
			$(this).magnificPopup({
		        delegate: 'a', // the selector for gallery item
		        type: 'image',
		        gallery: {
		        	enabled:true
		        },
		        mainClass: 'mfp-fade'
		    });
		});
	</script>
<!--===============================================================================================-->
	<script src="vendor/isotope/isotope.pkgd.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/sweetalert/sweetalert.min.js"></script>
	<script>
		$('.js-addwish-b2, .js-addwish-detail').on('click', function(e){
			e.preventDefault();
		});

		$('.js-addwish-b2').each(function(){
			var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-b2');
				$(this).off('click');
			});
		});

		$('.js-addwish-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-detail');
				$(this).off('click');
			});
		});

		/*---------------------------------------------*/

		$('.js-addcart-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to cart !", "success");
			});
		});

		// Product Modal Functionality
		$('.product-title-link').on('click', function(e) {
			e.preventDefault();
			var itemId = $(this).data('item-id');
			console.log('Clicked item ID:', itemId); // Debug
			loadProductModal(itemId);
		});

		// Product Modal Controls
		$('.js-hide-product-modal').on('click', function(){
			$('.js-product-modal').removeClass('show-modal1');
		});

		$('.js-product-modal .overlay-modal1').on('click', function(){
			$('.js-product-modal').removeClass('show-modal1');
		});

		// Message Modal Controls
		$('.js-hide-message-modal').on('click', function(){
			$('.js-message-modal').removeClass('show-modal1');
		});

		$('.js-message-modal .overlay-modal1').on('click', function(){
			$('.js-message-modal').removeClass('show-modal1');
		});

		// Load Product Modal Content
		function loadProductModal(itemId) {
			console.log('Loading modal for item:', itemId); // Debug
			$.ajax({
				url: '/api/items/' + itemId,
				method: 'GET',
				success: function(item) {
					console.log('Item data received:', item); // Debug
					var modalContent = `
						<div class="col-md-6 col-lg-7 p-b-30">
							<div class="p-l-25 p-r-30 p-lr-0-lg">
								<div class="wrap-pic-w pos-relative">
									<img src="/images/${item.images}" alt="${item.title}" class="product-modal-image">
								</div>
							</div>
						</div>
						<div class="col-md-6 col-lg-5 p-b-30">
							<div class="p-r-50 p-t-5 p-lr-0-lg">
								<h4 class="mtext-105 cl2 p-b-14">
									${item.title}
								</h4>
								<span class="mtext-106 cl2">
									${new Intl.NumberFormat('fr-FR').format(item.price)} FCFA
								</span>
								<p class="stext-102 cl3 p-t-23">
									${item.description}
								</p>
								<div class="p-t-20">
									<div class="flex-w flex-r-m p-b-10">
										<div class="size-204 flex-w flex-m respon6-next">
											<div class="wrap-num-product flex-w m-r-20 m-tb-10">
												<span class="stext-102 cl3">Condition: </span>
												<span class="stext-102 cl6 p-l-10">${item.condition}</span>
											</div>
										</div>
									</div>
									<div class="flex-w flex-r-m p-b-10">
										<div class="size-204 flex-w flex-m respon6-next">
											<div class="wrap-num-product flex-w m-r-20 m-tb-10">
												<span class="stext-102 cl3">Catégorie: </span>
												<span class="stext-102 cl6 p-l-10">${item.category}</span>
											</div>
										</div>
									</div>
								</div>
								<div class="product-modal-actions" style="display: flex; gap: 15px; margin-top: 20px; flex-wrap: wrap;">
									<a href="/product-detail/${item.id}" class="btn-acheter" style="background: linear-gradient(135deg, #4f46e5, #7c3aed); color: white; padding: 12px 24px; border: none; border-radius: 8px; font-weight: bold; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; transition: all 0.3s ease; flex: 1; min-width: 120px;">
										Acheter
									</a>
									<button type="button" class="btn-discuter" onclick="openMessageModal(${item.user_id}, ${item.id})" style="background: linear-gradient(135deg, #059669, #0d9488); color: white; padding: 12px 24px; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; transition: all 0.3s ease; flex: 1; min-width: 120px;">
										Discuter
									</button>
								</div>
							</div>
						</div>
					`;
					$('#modalContent').html(modalContent);
					$('.js-product-modal').addClass('show-modal1');
					console.log('Modal content set and shown'); // Debug
				},
				error: function() {
					swal("Erreur", "Impossible de charger les détails du produit", "error");
				}
			});
		}

		// Open Message Modal
		function openMessageModal(userId, itemId) {
			$('#receiverId').val(userId);
			$('#itemId').val(itemId);
			$('.js-product-modal').removeClass('show-modal1');
			$('.js-message-modal').addClass('show-modal1');
		}

		// Handle Message Form Submission
		$('#messageForm').on('submit', function(e) {
			e.preventDefault();

			$.ajax({
				url: $(this).attr('action'),
				method: 'POST',
				data: $(this).serialize(),
				success: function(response) {
					$('.js-message-modal').removeClass('show-modal1');
					swal("Succès", "Votre message a été envoyé avec succès!", "success");
					$('#messageForm')[0].reset();
				},
				error: function() {
					swal("Erreur", "Impossible d'envoyer le message. Veuillez réessayer.", "error");
				}
			});
		});

		// Make openMessageModal globally available
		window.openMessageModal = openMessageModal;

		// Test function to verify modal functionality
		function testModal() {
			console.log('Test modal function called');
			// Test with the first item if available
			var firstItem = $('.product-title-link').first();
			if (firstItem.length > 0) {
				var itemId = firstItem.data('item-id');
				console.log('Testing with item ID:', itemId);
				loadProductModal(itemId);
			} else {
				console.log('No items found for testing');
				swal("Test", "No items available for testing", "info");
			}
		}

		// Make test function globally available
		window.testModal = testModal;

	</script>
<!--===============================================================================================-->
	<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script>
		$('.js-pscroll').each(function(){
			$(this).css('position','relative');
			$(this).css('overflow','hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});

			$(window).on('resize', function(){
				ps.update();
			})
		});
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</x-app-layout>