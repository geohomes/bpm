<?php $role = auth()->user()->profile ? auth()->user()->profile->role : null; ?>
<div class="col-6 mb-4">
    <div class="icon-raduis alert bg-pink position-relative m-0">
        <div class="py-2">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="text-main-dark text-shadow-white m-0">
                    {{ number_format(auth()->user()->reviews->count()) }}
                </h5>
            </div>
            <a href="{{ route('user.reviews') }}" class="text-white">Reviews</a>
        </div>
    </div>
</div>
@if($role === 'agent')
    <div class="col-6 mb-4">
        <div class="icon-raduis alert bg-info m-0">
            <div class="py-2">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="text-main-dark text-shadow-white m-0">
                        {{ number_format(auth()->user()->properties->count()) }}
                    </h5>
                </div>
                <a href="{{ route('user.properties') }}" class="text-white">Properties</a>
            </div>
        </div>
    </div>
@endif
@if($role === 'dealer')
    <div class="col-6 mb-4">
        <div class="icon-raduis position-relative alert bg-info m-0">
            <div class="py-2">
                <div class="d-flex justify-content-between align-items-center align-items-center">
                    <h5 class="text-main-dark text-shadow-white m-0">
                        {{ number_format(auth()->user()->materials->count()) }}
                    </h5>
                </div>
                <a href="{{ route('user.materials') }}" class="text-white">Materials</a>
            </div>
        </div>
    </div>
@endif
@if($role === 'artisan')
    <div class="col-6 mb-4">
        <div class="icon-raduis position-relative alert bg-info m-0">
            <div class="py-2">
                <div class="d-flex justify-content-between align-items-center align-items-center">
                    <h5 class="text-main-dark text-shadow-white m-0">
                        {{ number_format(auth()->user()->gigs->count()) }}
                    </h5>
                </div>
                <a href="{{ route('user.gigs') }}" class="text-white">Services</a>
            </div>
        </div>
    </div>
@endif
<div class="col-12 mb-4">
    <div class="card-raduis alert alert-info p-4 m-0 position-relative border-0" >
        <div class="pb-0 position-relative">
            <div class="mb-3">
                <h4 class="">Total Credits</h4>
                <?php $credits = \App\Models\Credit::where(['user_id' => auth()->id()])->get(); ?>
                <h6 class="">
                    {{ empty($credits->count()) ? 0 : number_format($credits->sum('units')) }} Units
                </h6>
            </div>
            <div class="d-flex">
                <a href="javascript:;" class="btn bg-info text-white px-3 icon-raduis mr-3" data-toggle="modal" data-target="#buy-credit">Buy Credit</a>
                @include('user.credits.partials.buy')
                <a href="{{ route('user.credits') }}" class="btn bg-info text-white px-3 icon-raduis">View all</a>
            </div>
        </div>
    </div>
</div>
