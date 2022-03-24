<footer class="position-relative">
	<section class="bottom-section position-relative">
		<div class="container-fluid">
			<div class="row pb-3">
				<div class="col-12 col-md-7 col-lg-5 mb-4">
					<a href="{{ route('home') }}" class="d-block mb-3" style="width: 210px;">
	                    <img src="/images/logos/logo.png" class="img-fluid object-cover" alt="Best Property Market">
	                </a>
					<div class="text-main-dark mb-4">
						Over the past 25 years that we have been in existence, we have identified and outlined some core values which guide everything we do as a company. These core values define our brand, culture, and business strategies.
					</div>
					<a href="{{ route('about') }}" class="btn btn-lg bg-theme-color text-white px-4 mb-4">Learn More</a>
					<div class="mb-4">
						<h5 class="text-main-dark mb-3 rounded">To send a message, <a href="{{ route('contact') }}" class="text-decoration-underline">Click Here</a>. To call us now, <a href="tel:{{ env('OFFICE_PHONE') }}" class="text-decoration-underline">Click Here</a>.</h5>
					</div>
					<div class="d-flex mb-4">
						<a href="" class="d-block bg-theme-color text-center rounded md-circle  text-decoration-none mr-3">
							<small class="text-white">
								<i class="icofont-facebook"></i>
							</small>
						</a>
						<a href="" class="d-block bg-theme-color text-center rounded md-circle  text-decoration-none mr-3">
							<small class="text-white">
								<i class="icofont-instagram"></i>
							</small>
						</a>
						<a href="" class="d-block bg-theme-color text-center rounded md-circle  text-decoration-none mr-3">
							<small class="text-white">
								<i class="icofont-twitter"></i>
							</small>
						</a>
						<a href="" class="d-block bg-theme-color text-center rounded md-circle  text-decoration-none mr-3">
							<small class="text-white">
								<i class="icofont-whatsapp"></i>
							</small>
						</a>
					</div>
					<div class="">
						<div class="row">
							<div class="col-6 col-md-4">
								<a href="javascript:;" class="d-block w-100">
									<img src="/images/assets/istore.png" class="img-fluid w-100">
								</a>
							</div>
							<div class="col-6 col-md-4">
								<a href="javascript:;" class="d-block w-100">
									<img src="/images/assets/gplay.png" class="img-fluid w-100">
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-5 col-lg-3 mb-4">
					<h4 class="text-theme-color mb-4">Useful Links</h4>
					<div class="mb-3">
	                    <a class="d-block bg-main-ash text-decoration-none text-main-dark p-3 d-flex justify-content-between align-items-center" data-toggle="collapse" href="#services-nav-collapse" aria-expanded="false" aria-controls="services-nav-collapse">
	                        <div class="text-main-dark">Services</div>
	                        <span class="text-theme-color">
	                            <i class="icofont-caret-down"></i>
	                        </span>
	                    </a>
		                <div class="collapse" id="services-nav-collapse">
		                    <div class="card card-body">
		                        <a href="{{ route('artisans') }}" class="d-flex justify-content-between text-decoration-none">
		                            <small class="text-main-dark">Artisans</small>
		                            <small class="bg-danger rounded-pill px-3">
		                                <small class="text-white mb-2 tiny-font position-relative" style="top: -1px;">
		                                    +{{ \App\Models\Profile::where(['role' => 'artisan'])->count() }}
		                                </small>
		                            </small>
		                        </a>
		                    </div>
		                    <div class="card card-body">
		                        <a href="{{ route('agents') }}" class="d-flex justify-content-between text-decoration-none">
		                            <small class="text-main-dark">Agents</small>
		                            <small class="bg-danger rounded-pill px-3">
		                                <small class="text-white mb-2 tiny-font position-relative" style="top: -1px;">
		                                    +{{ \App\Models\Profile::where(['role' => 'agent'])->count() }}
		                                </small>
		                            </small>
		                        </a>
		                    </div>
		                    <div class="card card-body">
		                        <a href="{{ route('dealers') }}" class="d-flex justify-content-between text-decoration-none">
		                            <small class="text-main-dark">Dealers</small>
		                            <small class="bg-danger rounded-pill px-3">
		                                <small class="text-white mb-2 tiny-font position-relative" style="top: -1px;">
		                                    +{{ \App\Models\Profile::where(['role' => 'dealer'])->count() }}
		                                </small>
		                            </small>
		                        </a>
		                    </div>
		                </div>
		            </div>
					<a href="{{ route('news') }}" class="mb-3 p-3 text-decoration-none d-block bg-main-ash text-main-dark">News</a>
					<div class="mb-3">
		                <div class="">
		                    <a class="d-block bg-main-ash text-decoration-none text-main-dark px-3 py-3 icon-raduis d-flex justify-content-between align-items-center" data-toggle="collapse" href="#property-nav-collapse" aria-expanded="false" aria-controls="property-nav-collapse">
		                        <div class="text-main-dark">Properties</div>
		                        <span class="text-theme-color">
		                            <i class="icofont-caret-down"></i>
		                        </span>
		                    </a>
		                </div>
		                <div class="collapse" id="property-nav-collapse">
		                    <div class="card card-body">
		                        <a href="{{ route('properties') }}" class="d-flex justify-content-between">
		                            <small class="text-main-dark">Properties</small>
		                            <small class="bg-danger rounded-pill px-3">
		                                <small class="text-white mb-2 tiny-font position-relative" style="top: -1px;">
		                                    +{{ \App\Models\Property::count() }}
		                                </small>
		                            </small>
		                        </a>
		                    </div>
		                </div>
		            </div>
		            <a href="https://geoprecisegroup.com" class="mb-3 p-3 text-decoration-none d-block bg-main-ash text-main-dark" target="_blank">Surveying</a>
					<a href="{{ route('membership') }}" class="mb-3 p-3 text-decoration-none d-block bg-main-ash text-main-dark">Membership</a>
					<a href="{{ route('blog') }}" class="mb-3 p-3 text-decoration-none d-block bg-main-ash text-main-dark">Blog</a>
					<div class="mb-3">
		                <div class="">
		                    <a class="d-block bg-main-ash text-decoration-none text-main-dark px-3 py-3 icon-raduis d-flex justify-content-between align-items-center" data-toggle="collapse" href="#products-nav-collapse" aria-expanded="false" aria-controls="products-nav-collapse">
		                        <div class="text-main-dark">Products</div>
		                        <span class="text-theme-color">
		                            <i class="icofont-caret-down"></i>
		                        </span>
		                    </a>
		                </div>
		                <div class="collapse" id="products-nav-collapse">
		                    <div class="card card-body">
		                        <a href="{{ route('materials') }}" class="d-flex justify-content-between">
		                            <small class="text-main-dark">Building Materials</small>
		                            <small class="bg-danger rounded-pill px-3">
		                                <small class="text-white mb-2 tiny-font position-relative" style="top: -1px;">
		                                    +{{ \App\Models\Material::count() }}
		                                </small>
		                            </small>
		                        </a>
		                    </div>
		                </div>
		            </div>
		            <a href="https://geohomesgroup.com" class="mb-3 p-3 text-decoration-none d-block bg-main-ash text-main-dark" target="_blank">Consultancy</a>
				</div>
				<div class="col-12 col-md-12 col-lg-4 mb-4">
					<div class="">
						<h4 class="text-theme-color mb-4">Our Newsletter</h4>
						<div class="mb-4 text-white p-3 border rounded bg-main-dark">Subscribe to our newsletter to get latest updates from our global properties hub.</div>
						<form class="p-4 border rounded mb-4" action="javascript:;">
							<div class="form-group input-group-lg">
								<label class="text-main-dark">Email</label>
								<input type="email" name="newsletter" class="form-control" placeholder="Enter your email">
							</div>
							<button type="submit" class="btn btn-lg bg-theme-color btn-block text-white mb-3">
						        <img src="/images/spinner.svg" class="mr-2 d-none login-spinner mb-1">
						        Subscribe
						    </button>
						</form>
					</div>
					<div class="row">
						<div class="col-12 mb-4">
							<div class="w-100 h-100" id="contactmap">
								<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.6468249831787!2d7.492911815325601!3d6.439381725920649!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1044a3d8f51f6071%3A0x6b07f5ee68d7e660!2s26%20Moorehouse%20St%2C%20Ogui%20400001%2C%20Enugu!5e0!3m2!1sen!2sng!4v1637755718285!5m2!1sen!2sng" allowfullscreen="" loading="lazy" class="w-100 h-100 rounded"></iframe>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="py-4 bg-main-dark border-top-dark-500">
		<div class="container">
			<small class="text-white m-0">&copy Copyright Geohomes Services Limited {{ date('Y') }}</small>
		</div>
	</section>
</footer>
