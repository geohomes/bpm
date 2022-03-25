<div class="card p-0 border-0 shadow-sm position-relative">
	<div class="position-relative" style="height: 240px;">
		<a href="{{ route('account.profile', ['id' => $agent->id, 'name' => \Str::slug($agent->user->name)]) }}" class="text-decoration-none w-100 h-100 d-block">
			<img src="{{ empty($agent->image) ? '/images/avatar.png' : $agent->image }}" class="img-fluid object-cover h-100 w-100">
		</a>
		<div class="position-absolute w-100 px-4" style="top: 20px; z-index: 2;">
			<div class="d-flex justify-content-between">
				<div class="">
					@if($agent->user->properties()->exists())
						<div class="px-3 py-1 bg-success">
							<small class="text-white counter">
								{{ $agent->user->properties()->count() }} listing(s)
							</small>
						</div>
					@else
						<div class="px-3 py-1 bg-theme-color">
							<small class="text-white">
								No listings
							</small>
						</div>
					@endif
				</div>
				<div class="">
					@if($agent->user->socials()->exists())
                        <div class="">
                            @foreach($agent->user->socials->take(4) as $social)
                                <a href="{{ ($social->company == 'whatsapp' || $social->company == 'telegram') ? "tel:{$social->phone}" : $social->link }}" class="text-decoration-none sm-circle bg-theme-color text-center d-block mb-3">
                                    <small class="text-white tiny-font">
                                        <i class="icofont-{{ $social->company }}"></i>
                                    </small>
                                </a>
                            @endforeach
                        </div>
                    @endif
				</div>
			</div>
		</div>
		<div class="position-absolute px-4 py-2 w-100" style="bottom: 0; background-color: rgba(160, 15, 15, 0.5); z-index: 2;">
			<div class="d-flex justify-content-between align-items-center">
				<div class="d-flex align-items-center">
					<div class="text-main-dark mr-2">
						<i class="icofont-location-pin"></i>
					</div>
					<div class="text-white">
						{{ \Str::limit(ucwords($agent->city), 10) }}
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="card-body bg-transparent pt-5">
		<div class="d-flex align-items-center">
			<div class="text-center rounded-circle {{ $agent->certified ? 'bg-success' : 'bg-secondary' }} mr-2 sm-circle">
				<small class="text-white tiny-font">
					<i class="icofont-tick-mark"></i>
				</small>
			</div>
			<div class="">
				<a href="{{ route('account.profile', ['id' => $agent->id, 'name' => \Str::slug($agent->user->name)]) }}" class="text-main-dark">
					{{ ucwords($agent->user->name) }}
				</a>
			</div>
		</div>
		<div class="mb-3">
			<a href="{{ route('account.profile', ['id' => $agent->id, 'name' => \Str::slug($agent->user->name)]) }}">
				<small class="text-main-dark text-underline">
					{{ \Str::limit(ucfirst($agent->description), 34) }}
				</small>
			</a>
		</div>
	</div>
	<div class="card-footer d-flex justify-content-between bg-white py-3">
		<div class="d-flex align-items-center">
			<a href="{{ empty($agent->email) ? 'javascript:;' : "mailto:{$agent->email}" }}" class="text-center mr-2 text-decoration-none sm-circle border text-center rounded-circle">
				<small class="text-muted">
					<i class="icofont-email"></i>
				</small>
			</a>
			<a href="{{ empty($agent->phone) ? 'javascript:;' : "tel:{$agent->phone}" }}" class="text-center mr-2 text-decoration-none sm-circle border text-center rounded-circle">
				<small class="text-success">
					<i class="icofont-phone"></i>
				</small>
			</a>
			<a href="{{ empty($agent->website) ? 'javascript:;' : $agent->website }}" class="text-center mr-2 text-decoration-none sm-circle border text-center rounded-circle" target="_blank">
				<small class="text-muted">
					<i class="icofont-web"></i>
				</small>
			</a>
		</div>
		<div>
			<a href="{{ route('account.profile', ['id' => $agent->id, 'name' => \Str::slug($agent->user->name)]) }}" class="text-theme-color text-decoration-none">
				<i class="icofont-long-arrow-right"></i>
			</a>
		</div>
	</div>
</div>	