@include('layouts.header')
    @include('frontend.layouts.navbar')
    <div class="bg-main-ash min-vh-100">
    	<section class="property-banner">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-md-8 col-lg-9">
						<div class="mb-4">
							@empty($property)
								<div class="alert alert-danger">Property No Found</div>
							@else
								<?php $property->views = $property->views + 1; $property->update(); ?>
								<div class="mb-4">
									<h3 class="text-main-dark mb-3">
										{{ retitle($property) }}
									</h3>
									<div class="mb-4 position-relative">
										<div class="position-absolute ml-4 mt-4" style="z-index: 2;">
								            <div class="d-flex align-items-center">
								                @if($property->promoted == true && $property->promotion->status ?? '' == 'active')
								                    <small class="bg-success text-white tiny-font px-3 py-1 mr-3">Promoted</small>
								                @endif
								                <small class="bg-info text-white tiny-font px-3 py-1 mr-3">
								                	{{ $property->views }} views
								                </small>
								                <?php $action = strtolower($property->action); $actions = \App\Models\Property::$actions; ?>
								                @if(isset($actions[$action]))
								                    <small class="bg-theme-color tiny-font text-white px-3 py-1 mr-3">{{ ucwords($actions[$action]) }}
								                        </small></small>
								                @endif
								                <small class="bg-white text-theme-color cursor-pointer px-3 py-1 rounded">
								                    <i class="icofont-share"></i>
								                </small>
								            </div>
								        </div>
								        <a href="{{ $property->image ?: '/images/banners/placeholder.png' }}" style="height: 340px;" class="mb-4 d-block">
											<img src="{{ $property->image ?: '/images/banners/placeholder.png' }}" class="img-fluid w-100 h-100 border object-cover">
								        </a>
									</div>
									@if($property->images()->count())
								        <div class="">
								        	<div class="row">
								        		@foreach($property->images as $image)
								        			<div class="col-6 col-md-3 mb-4">
								        				<a href="{{ $image->link }}" style="height: 160px;">
								        					<img src="{{ $image->link }}" class="img-fluid w-100 h-100 border">
								        				</a>
								        			</div>
								        		@endforeach
								        	</div>
								        </div>
							        @endif
									<div class="row">
							            <div class="col-12 col-md-6 mb-4">
							            	<div class="px-4 pt-4 bg-white mb-4">
							            		<div class="row">
								            		@if($property->user)
								            			<div class="col-3 col-md-4 col-lg-2 mb-4">
								            				<a href="tel:{{ $property->user->phone }}" class="text-center border-theme-color d-block py-2 text-theme-color text-decoration-none">
										            			<i class="icofont-phone"></i>
										            		</a>
								            			</div>
										            	<div class="col-3 col-md-4 col-lg-2 mb-4">	
										            		<a href="mailto:{{ $property->user->email }}" class="text-center border-theme-color d-block py-2 text-theme-color text-decoration-none">
										            			<i class="icofont-email"></i>
										            		</a>
										            	</div>
										            	@if($property->user->socials()->exists())
										            		@foreach($property->user->socials as $social)
											            		<div class="col-3 col-md-4 col-lg-2 mb-4">
											            			<a href="{{ $social->company == 'whatsapp' ? "tel:$social->phone" : $social->link }}" class="text-center border-theme-color d-block py-2 text-theme-color text-decoration-none">
												            			<i class="icofont-{{ $social->company }}"></i>
												            		</a>
												            	</div>
										            		@endforeach
										            	@endif
									            	@endif
								            	</div>
							            	</div>
							                <a href="javascript:;" class="btn btn-block bg-theme-color">
							                    <small class="text-white">
							                        NGN{{ number_format($property->price) }}
							                    </small>
							                </a>
							            </div>
							            <div class="col-12 col-md-6 mb-4">
							            	<div class="">
												<div class="text-main-dark d-block mb-3 pb-3 border-bottom">
													Location: {{ $property->address }}
												</div>
											</div>
							            </div>
							        </div>
							        <div class="p-4 border">
							        	<p class="text-main-dark">Description</p>
										<div class="text-main-dark">
											{{ $property->additional }}
										</div>
							        </div>
								</div>
							@endempty
						</div>
						<div class="">
							<div class="alert alert-info mb-4">Related Properties</div>
							@empty($related->count())
								<div class="alert alert-danger">No Related Properties</div>
							@else
								<div class="row">
									@foreach($related as $property)
										<div class="col-12 col-md-6 col-lg-4 mb-4">
											@include('frontend.properties.partials.card')
										</div>
									@endforeach
								</div>
							@endempty
						</div>
					</div>
					<div class="col-12 col-md-4 col-lg-3">
						<div class="mb-4">
				            @include('frontend.properties.partials.categories')
			            </div>
					</div>
				</div>
			</div>
		</section>
    </div>
	@include('frontend.layouts.bottom')
@include('layouts.footer')