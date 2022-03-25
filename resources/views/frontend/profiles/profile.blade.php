@include('layouts.header')
    @include('frontend.layouts.navbar')
    <div class="bg-main-ash min-vh-100">
    	<section class="position-relative" style="padding: 140px 0;">
			<div class="container-fluid">
				@if(empty($profile))
					<div class="alert alert-info">Profile Not Found</div>
				@else
					<div class="row">
						<div class="col-12 col-md-5 col-lg-3">
							<div class="mb-4 p-5 rounded icon-raduis bg-white shadow-sm text-center">
								<div class="" style="height: 160px;">
									<img src="{{ empty($profile->image) ? '/images/avatar.png' : $profile->image }}" class="img-fluid w-100 h-100 rounded border object-cover">
								</div>
							</div>
							<div class="mb-4">
								<div class="d-flex align-items-center mb-4 pb-3 border-bottom">
									<div class="">
										<h5 class="text-main-dark mb-0">
											{{ ucwords($profile->user->name) }} 
											@set('roles', \App\Models\Profile::$roles)
											@if(!empty($roles))
												@foreach($roles as $role => $description)
													@foreach($description as $key => $value)
														@if($profile->role == $role && $profile->code == $value['code'])
																({{ ucwords($value['name']) }})
														@endif
													@endforeach
												@endforeach
											@endif
										</h5>
									</div>
								</div>
								@if($profile->role == 'artisan')
									@if($profile->user->services()->exists())
										@foreach($profile->user->services->take(5) as $service)
											<div class="d-flex flex-wrap">
												<small class="px-3 py-1 bg-success text-white rounded-pill mb-3 mr-2">
													{{ $service->skill->name ?? '' }}
												</small>
											</div>
										@endforeach
									@endif
								@endif
								<div class="text-main-dark mb-4">
									{{ ucfirst($profile->description) }}
								</div>
								<div class="">
									<div class="row">
										<div class="col-4 mb-3">
											<a href="{{ empty($profile->phone) ? 'javascript:;' : 'tel:'.$profile->phone }}" class="btn btn-info btn-block icon-raduis">
												<small class="">
													<i class="icofont-phone"></i>
												</small>
											</a>
										</div>
										<div class="col-4 mb-3">
											<a href="{{ empty($profile->email) ? 'javascript:;' : 'mailto:'.$profile->email }}" class="btn btn-info btn-block icon-raduis">
												<span class="">
													<i class="icofont-send-mail"></i>
												</span>
											</a>
										</div>
										<div class="col-4 mb-3">
											<a href="{{ empty($profile->website) ? 'javascript:;' : $profile->website }}" class="btn btn-info btn-block icon-raduis" target="_blank">
												<small class="">
													<i class="icofont-web"></i>
												</small>
											</a>
										</div>
									</div>
									<p class="">
										<small class="text-theme-color">
											<i class="icofont-location-pin"></i>
										</small>
										<small class="text-main-dark">
											{{ ucwords($profile->city).', '.ucwords($profile->state) }}
										</small>
									</p>
									@if($profile->user->socials()->exists())
										<div class="d-flex align-items-center justify-content-between icon-raduis bg-white shadow-sm w-100 p-3">
											@foreach($profile->user->socials->take(5) as $social)
												<a href="{{ ($social->company == 'whatsapp' || $social->company == 'telegram') ? "tel:{$social->phone}" : $social->link }}" class="text-center bg-theme-color rounded-circle border text-decoration-none" style="height: 35px; width: 35px; line-height: 30px;">
													<small class="text-white">
														<i class="icofont-{{ $social->company }}"></i>
													</small>
												</a>
											@endforeach
										</div>
									@endif
								</div>
							</div>
						</div>
						<div class="col-12 col-md-7 col-lg-9">
							<div class="">
								<div class="alert alert-info d-flex justify-content-between mb-4">
									<div class="">Recent Reviews ({{ $profile->reviews()->count() }})</div>
									<a class="text-decoration-none" href="javascript:;" data-toggle="modal" aria-haspopup="true" aria-expanded="false" data-target="#add-review">
			                           <small class="">
			                                <i class="icofont-plus"></i>
			                            </small>
			                        </a>
			                        @include('frontend.reviews.partials.add')
								</div>
								@if(!auth()->check())
									<div class="alert alert-danger mb-4">Please login to review this profile.</div>
								@endif
								<div class="">
									@if(empty($profile->reviews()->count()))
										<div class="alert alert-danger mb-4">No reviews yet</div>
									@else
										@set('reviews', $profile->reviews->paginate(5))
										<div class="row">
											@foreach($reviews as $review)
												<div class="col-12 mb-4">
													@include('frontend.reviews.partials.card')
												</div>
											@endforeach
										</div>
										{{ $reviews->appends(request()->query())->onEachSide(1)->links('vendor.pagination.default') }}
									@endif
								</div>
							</div>
						</div>
					</div>
				@endif
			</div>
		</section>
    </div>
	@include('frontend.layouts.bottom')
@include('layouts.footer')