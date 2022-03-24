@include('layouts.header')
    @include('frontend.layouts.navbar')
    <div class="bg-main-ash min-vh-100">
    	<section class="" style="padding: 140px 0;">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-md-7 col-lg-9">
						@empty($properties->count())
							<div class="alert alert-info">No Properties Listed</div>
						@else
							<div class="alert alert-info mb-4">
								{{ $name == 'land' ? 'Landed' : ucfirst($name) }} Properties ({{ $properties->total() }})
							</div>
							<div class="row">
								@foreach($properties as $property)
									<div class="col-12 col-md-6 col-lg-4 mb-4">
										@include('frontend.properties.partials.card')
									</div>
								@endforeach
							</div>
							{{ $properties->appends(request()->query())->links('vendor.pagination.default') }}
						@endempty
					</div>
					<div class="col-12 col-md-5 col-lg-3">
						<div class="mb-4">
							@include('frontend.properties.partials.categories')
						</div>
						<div class="mb-4">
							@include('frontend.properties.partials.sold')
						</div>
					</div>
				</div>
			</div>
		</section>
    </div>
	@include('frontend.layouts.bottom')
@include('layouts.footer')