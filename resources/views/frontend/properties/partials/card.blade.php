<?php $title = ucfirst(retitle($property)); ?>
<div class="card border-0 bg-white w-100 card-raduis position-relative">
    <div class="position-absolute w-100 px-4 mt-4" style="z-index: 2;">
        <div class="d-flex justify-content-between">
            <div class="">
                <div class="d-flex align-items-center flex-wrap">
                    <?php $actions = \App\Models\Property::$actions; $action = strtolower($property->action); ?>
                    @if(isset($actions[$action]))
                        <small class="bg-theme-color px-3 py-1 mr-3 mb-3">
                            <small class="text-white">
                                {{ ucwords($actions[$action]) }}
                            </small>
                        </small>
                    @endif
                    <small class="bg-theme-color px-3 py-1 mr-3 mb-3">
                        <small class="text-white">
                            {{ ucwords($property->category) }}
                        </small>
                    </small>
                </div>
                @if($property->promoted)
                    <a href="" class="d-block">
                        <small class="bg-success px-3 py-1 mr-3 mb-3">
                            <small class="text-white">Promoted</small>
                        </small>
                    </a>  
                @endif
            </div>
            <div>
                <a href="javascript:;" class="d-block text-decoration-none mb-3">
                    <small class="bg-white border text-theme-color rounded cursor-pointer px-2 py-1">
                        <i class="icofont-share"></i>
                    </small>
                </a>
                <a href="javascript:;" class="d-block text-decoration-none">
                    <small class="bg-white border text-theme-color rounded cursor-pointer px-2 py-1">
                        <i class="icofont-love"></i>
                    </small>
                </a> 
            </div>
        </div>   
    </div>
    <div class="position-relative" style="height: 280px; line-height: 280px;">
        <a href="{{ route('property.category.id.slug', ['category' => $property->category, 'id' => $property->id ?? 0, 'slug' => \Str::slug($title)]) }}" class="text-decoration-none rounded-top">
            <img src="{{ empty($property->image) ? '/images/banners/holder.png' : $property->image }}" class="img-fluid w-100 h-100 object-cover rounded-top">
        </a>
        <div class="position-absolute w-100 px-3 d-flex align-items-center justify-content-between" style="height: 45px; line-height: 45px; bottom: 0; background-color: rgba(0, 0, 0, 0.6);">
            <div class="">
                <small class="text-theme-color">
                    <i class="icofont-location-pin"></i>
                </small>
                <small class="text-white">
                    {{ \Str::limit(ucwords($property->city), 18) }}
                </small>
            </div>
            <div>
                <small class="text-theme-color">
                    <i class="icofont-camera"></i>
                </small>
                <small class="text-white">
                    {{ $property->images()->count() + (empty($property->image) ? 0 : 1) }}
                </small>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="font-weight-bolder mb-3">
            <a href="{{ route('property.category.id.slug', ['category' => $property->category, 'id' => $property->id ?? 0, 'slug' => \Str::slug($title)]) }}" class="text-main-dark text-underline">
                {{ \Str::limit($title, 44) }}
            </a>
        </div>
        <h4 class="text-theme-color">
            {{ $property->currency->symbol ?? 'NGN' }}{{ number_format($property->price) }}
        </h4>
        <div class="geodir-card-text">
            <a href="{{ route('property.category.id.slug', ['category' => $property->category->name ?? 'any', 'id' => $property->id ?? 0, 'slug' => \Str::slug($title)]) }}" class="text-underline text-main-dark">
                <span class="">
                    {{ \Str::limit($property->additional, 65) }}
                </span>
            </a>
        </div>
    </div>
    <div class="card-footer d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <div class="rounded-circle lg-circle m-0">
                <div class="p-1 m-0 border border-{{ $property->status == 'active' ? 'success' : 'danger' }} rounded-circle w-100 h-100">
                    @if(empty($property->user->profile->image))
                        <div class="w-100 h-100 border rounded-circle text-center" style="background-color: {{ randomrgba() }};">
                            <small class="text-main-dark">
                                {{ substr(strtoupper($property->user->name), 0, 1) }}
                            </small>
                        </div>
                    @else
                        <img src="{{ $property->user->profile->image }}" class="img-fluid object-cover rounded-circle w-100 h-100 border">
                    @endif
                </div>
            </div>
            <div class="ml-2">
                <a href="javascript:;" class="text-decoration-none d-block">
                    <small class="text-main-dark">
                        {{ $property->user ? \Str::limit(ucwords($property->user->name), 18) : 'Our Agent' }}
                    </small>
                </a>
                <small class="text-muted">
                    {{ $property->created_at->diffForHumans() }}
                </small>
            </div>      
        </div>
        <div class="">
            <a href="{{ route('property.category.id.slug', ['category' => $property->category, 'id' => $property->id ?? 0, 'slug' => \Str::slug($title)]) }}" class="text-theme-color text-decoration-none">
                <i class="icofont-long-arrow-right"></i>
            </a>
        </div>
    </div>
</div>