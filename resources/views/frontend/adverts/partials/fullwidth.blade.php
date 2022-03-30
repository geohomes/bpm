@set('adverts', \App\Models\Advert::where(['status' => 'active', 'size' => 'fhb'])->inRandomOrder()->take(1)->get())
@if(!empty($adverts))
	<div class="row">
		@foreach($adverts as $advert)
			<div class="col-12 mb-4">
				<a href="{{ $advert->link }}" target="_blank" class="w-100 d-block" style="max-height: 120px;">
					<img src="{{ $advert->banner }}" class="img-fluid border w-100 h-100 object-cover">
				</a>
			</div>
		@endforeach
	</div>
@endif