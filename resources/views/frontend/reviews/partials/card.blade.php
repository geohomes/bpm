<div class="card border-0 rounded-0">
	<div class="card-body">
		<div class="d-flex justify-content-between">
			<div class="d-flex mb-2">
				@for ($rate = 1; $rate < 5; $rate++)
					<div class="mr-3 text-warning">
						<i class="icofont-ui-rating"></i>
					</div>
				@endfor
			</div>
			<small class="text-success">
				<small>{{ '' }}</small>
			</small>
		</div>
		<div class="">
			<div class="text-main-dark">
				{{ \Str::limit(ucfirst($review->review), 24) }}
			</div>
		</div>
	</div>
	<div class="card-footer bg-theme-color d-flex justify-content-between">
		<small class="text-white">
			<em>By</em> {{ ucwords($review->user->name ?? 'Nill') }}
		</small>
		<small class="text-white">
			{{ $review->created_at->diffForHumans() }}
		</small>
	</div>
</div>