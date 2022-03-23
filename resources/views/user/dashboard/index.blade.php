@include('layouts.header')
<div class="min-vh-100 bg-main-ash">
    @include('user.layouts.navbar')
    <div class="user-content user-dashboard-banner pb-4">
        <div class="container">
            @if(!empty($reference))
                @if(isset($verify['status']))
                    <div class="alert mb-4 {{ $verify['status'] === 0 ? 'alert-danger' : 'alert-success' }}">
                        {{ $verify['info'] }}
                    </div>
                @endif
            @endif
            @if(!empty(auth()->user()->name))
                <div class="alert-info alert mb-4 d-flex justify-content-between al;align-items-center">
                    <div class="">
                        <span class="mr-2">Welcome</span>
                        <a href="{{ route('user.profile') }}">
                            {{ ucwords(auth()->user()->name) }}
                        </a>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="row">
                        @include('user.dashboard.partials.panels')
                    </div>
                    {{-- Subscription section starts --}}
                    @include('user.subscriptions.partials.card')
                    {{-- Advert section starts --}}
                    <div class="">
                        <div class="d-flex justify-content-between alert alert-info mb-4 icon-raduis">
                            <span class="">Adverts</span>
                            <a href="javascript:;" class="" data-toggle="modal" data-target="#post-advert">Post advert</a>
                            @include('user.adverts.partials.post')
                        </div>
                        <?php $adverts = \App\Models\Advert::latest()->where(['user_id' => auth()->id()])->get(); ?>
                        @if(empty($adverts->count()))
                            <div class="alert alert-danger">You have no adverts. <a href="javascript:;" class="text-underline" data-toggle="modal" data-target="#post-advert">Post advert</a>.</div>
                        @else
                             <div class="row">
                                @foreach($adverts as $advert)
                                    <div class="col-12 mb-4">
                                        @include('user.adverts.partials.card')
                                    </div>
                                    @include('user.adverts.partials.edit')
                                @endforeach
                            </div>
                        @endif
                    </div>   
                </div>
                <div class="col-12 col-lg-6">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <div class="card position-relative shadow-sm border-0" >
                                <div class="card-header py-5 bg-theme-color">
                                    <h4 class="text-white">Total Payments</h4>
                                    <h3 class="text-white">
                                        ${{ number_format(\App\Models\Payment::where(['user_id' => auth()->id()])->sum('amount')) }}
                                    </h3>
                                </div>
                                <div class="card-body py-0 position-relative" style="top: -20px;">
                                    <div class="row">
                                        <div class="col-12 col-md-6 mb-3">
                                            <div class="alert alert-info icon-raduis mb-3 p-4">
                                                <h5>Adverts</h5>
                                                <div>
                                                    ${{ number_format(\App\Models\Payment::where(['user_id' => auth()->user()->id, 'type' => 'advert'])->sum('amount')) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <div class="alert alert-info icon-raduis mb-3 p-4">
                                                <h5>Subscriptions</h5>
                                                <div>
                                                    ${{ number_format(\App\Models\Payment::where(['user_id' => auth()->user()->id, 'type' => 'subscription'])->sum('amount')) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(auth()->user()->profile)
                            @if(auth()->user()->profile->role !== 'dealer')
                                <div class="col-12 mb-4">
                                    <div class="card bg-info card-raduis shadow-sm">
                                        <div class="card-body">
                                            <div class="">
                                                <h5 class="text-white mb-3">List Building Materials</h5>
                                                <div class="mb-3">With over 5,000 weekly visitors, you stand a change to leverage our platform.</div>
                                                <a href="{{ route('logout', ['redirect' => 'signup']) }}" class="btn bg-main-dark text-white px-4">Get Started</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if(auth()->user()->profile->role !== 'agent')
                                <div class="col-12 mb-4">
                                    <div class="card bg-info card-raduis shadow-sm">
                                        <div class="card-body">
                                            <div class="">
                                                <h5 class="text-white mb-3">List Your Properties</h5>
                                                <div class="mb-3">With over 5,000 weekly visitors, you stand a change to leverage our platform.</div>
                                                <a href="{{ route('logout', ['redirect' => 'signup']) }}" class="btn bg-main-dark text-white px-4">Get Started</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if(auth()->user()->profile->role !== 'artisan')
                                <div class="col-12 mb-4">
                                    <div class="card bg-info card-raduis shadow-sm">
                                        <div class="card-body">
                                            <div class="">
                                                <h5 class="text-white mb-3">List Your Services</h5>
                                                <div class="mb-3">Become an artisan, With over 5,000 weekly visitors, you stand a change to leverage our platform.</div>
                                                <a href="{{ route('logout', ['redirect' => 'signup']) }}" class="btn bg-main-dark text-white px-4">Get Started</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                    @if(auth()->user()->profile)
                        @if(auth()->user()->profile->role == 'agent')
                            <div class="">
                                <div class="alert alert-info mb-4 d-flex justify-content-between align-items-center">
                                    <small>Recent properties</small>
                                    <small>
                                        <a href="{{ route('user.property.add') }}" class="text-primary">List property</a>
                                    </small>
                                </div>
                                @if(empty($properties->count()))
                                    <div class="alert alert-warning mb-4">No properties listed yet</div>
                                @else
                                    <div class="row">
                                        @foreach($properties as $property)
                                            <div class="col-12 col-md-4 col-lg-6 mb-4">
                                                @include('user.properties.partials.card')
                                            </div>
                                        @endforeach
                                    </div>
                                    @if($properties->total() > 4)
                                        <a href="{{ route('user.properties') }}" class="alert alert-info mb-4 d-block">See all listed properties</a>
                                    @endif
                                @endif
                            </div>   
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')    