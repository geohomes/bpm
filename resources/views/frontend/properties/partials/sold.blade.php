
@set('properties', \App\Models\Property::where(['action' => 'sold'])->take(3)->inRandomOrder()->get())
@if(!empty($properties))
    <div class="alert alert-success mb-4">Sold Properties</div>
    @foreach($properties as $property)
        <div class="card border-0 mb-4 bg-transparent position-relative rounded-0">
            <div class="position-relative">
            	<div class="position-absolute ml-4 mt-4">
                    <small class="bg-success px-3 py-1">
                        <small class="text-white">
                            {{ ucwords($property->action) }}
                        </small>
                    </small>
                </div>
                <div style="height: 200px;">
                    <img src="{{ $property->image }}" class="img-fluid object-cover border rounded-0 w-100 h-100" alt="{{ ucwords($property->status) }}">
                </div>
            </div>
            <div class="card-footer bg-theme-color">
            	<small class="text-white">
                    Sold {{ $property->currency->symbol ?? 'NGN' }}{{ number_format($property->price) }}
                </small>
            </div>
        </div>
    @endforeach
@endif