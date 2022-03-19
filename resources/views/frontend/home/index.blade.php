@include('layouts.header')
    @include('frontend.layouts.navbar')
    <div class="bg-main-ash min-vh-100">
        <div class="home-banner position-relative">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-9 col-lg-6">
                        <div class="mb-4">
                            <p class="text-white">Global Properties Listing</p>
                            <h1 class="text-white font-weight-bolder shadow-sm">Buy<span class="text-theme-color">,</span> Rent <span class="font-weight-bolder text-theme-color">or</span> Sell Real Estate Properties<span class="text-theme-color font-weight-bolder">.</span></h1>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6 mb-4">
                                <a href="{{ route('properties') }}" class="btn text-white btn-block bg-theme-color icon-raduis btn-lg">Find Properties</a>
                            </div>
                            <div class="col-12 col-md-6 mb-4">
                                <a href="{{ route('signup') }}" class="btn text-white btn-block bg-main-dark icon-raduis btn-lg">List Properties</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="home-properties">
            <div class="container-fluid">
                <div class="">
                    <div class="">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div class="">
                                <h4 class="text-main-dark mb-4">Promoted Properties</h4>
                                <ul class="nav nav-pills " id="" role="tablist">
                                    @set('actions', \App\Models\Property::$actions)
                                    @if(!empty($actions))
                                        @foreach($actions as $action => $value)
                                            @if($action !== 'sold')
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link border-theme-color mr-3 mb-4 py-1 text-main-dark px-4 {{ $action == 'rent' ? 'active' : '' }}" id="pills-{{ $action }}-tab" data-toggle="pill" href="#pills-{{ $action }}" role="tab" aria-controls="pills-{{ $action }}" aria-selected="true">
                                                        <small class="position-relative" style="top: -2.5px;">
                                                            <small>{{ ucwords($value) }}</small>
                                                        </small>
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                            <div class="d-flex">
                                <a href="{{ route('properties') }}" class="btn text-white btn-sm bg-theme-color d-block mb-4">
                                    <i class="icofont-long-arrow-right"></i>
                                </a>
                                @set('categories', \App\Models\Property::$categories)
                                @if(!empty($categories))
                                    <div class="dropdown ml-3">
                                        <a class="btn btn-sm border-theme-color text-main-dark text-decoration-none" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                            <i class="icofont-caret-down"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right border-0 shadow-sm icon-raduis" aria-labelledby="dropdownMenuButton">
                                            @foreach($categories as $category => $values)
                                                <a class="dropdown-item d-flex justify-content-between align-items-center" href="{{ route('properties.category', ['category' => $category]) }}">
                                                    <small class="text-main-dark">
                                                        {{ ucfirst($category) }}s
                                                    </small>
                                                    <small class="tiny-font px-2 bg-theme-color text-white rounded-pill">
                                                        {{ \App\Models\Property::where(['category' => $category])->get()->count() }}
                                                    </small>
                                                </a>
                                                <div class="dropdown-divider"></div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div> 
                        <div class="tab-content" id="">
                            @if(empty($properties->count()))
                                <div class="alert-info alert">No Properties Yet</div>
                            @else
                                @if(!empty($actions))
                                    @foreach($actions as $action => $value)
                                        @if($action !== 'sold')
                                            <div class="tab-pane fade show {{ $action == 'rent' ? 'active' : '' }}" id="pills-{{ $action }}" role="tabpanel" aria-labelledby="pills-{{ $action }}-tab">
                                                <div class="row">
                                                    @foreach($properties as $property)
                                                        @if($property->action == $action)
                                                            <div class="col-12 col-md-6 col-lg-4 mb-4">
                                                                @include('frontend.properties.partials.card')
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>  
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    <div class="row">
                                        @foreach($properties as $property)
                                            <div class="col-12 col-md-6 col-lg-4 mb-4">
                                                @include('frontend.properties.partials.card')
                                            </div>
                                        @endforeach
                                    </div>  
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white" style="padding: 160px 0;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-5 mb-4">
                        <div class="mb-4">
                            <h2 class="text-main-dark">Why Choose Our Properties</h2>
                        </div>
                        <div>
                            <div class="d-flex align-items-center mb-4">
                                <div class="text-center">
                                    <div class="lg-circle rounded-circle bg-theme-color text-white mr-3">
                                        <div class="position-relative" style="top: 5px;">
                                            <i class="icofont-live-support"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <h4 class="text-main-dark">24/7 Tech Support</h4>
                                    <div class="text-main-dark">Lorem ipsum dolor sit amet, consect</div>
                                </div>      
                            </div>
                            <div class="d-flex align-items-center mb-4">
                                <div class="text-center">
                                    <div class="lg-circle rounded-circle bg-theme-color text-white mr-3">
                                        <div class="position-relative" style="top: 5px;">
                                            <i class="icofont-dashboard-web"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <h4 class="text-main-dark">User Admin Panel</h4>
                                    <div class="text-main-dark">Lorem ipsum dolor sit amet, consectetur</div>
                                </div>      
                            </div>
                            <div class="d-flex align-items-center mb-4">
                                <div class="text-center">
                                    <div class="lg-circle rounded-circle bg-theme-color text-white mr-3">
                                        <div class="position-relative" style="top: 5px;">
                                            <i class="icofont-responsive"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <h4 class="text-main-dark">Mobile Friendly</h4>
                                    <div class="text-main-dark">Lorem ipsum dolor sit amet</div>
                                </div>      
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-7 mb-4">
                        <div class="">
                            <img src="/images/banners/rin.jpg" class="img-fluid">
                        </div>
                    </div>
                </div> 
            </div>  
        </div>
        <div class="top-countries position-relative">
            <div class="container-fluid">
                <div class="row align-items-baseline">
                    <div class="col-12 col-md-6 mb-4">
                        <div class="">
                            <h4 class="text-white mb-4">Explore Top Countries</h4>
                            <div class="mb-4 text-white text-shadow-dark">Take a tour with us as we show your new, big and best cities of the world. Just incase you want to invest on a property, you can take a peak over this section to see very beautiful cities you can own a home.</div>
                            <a href="{{ route('signup') }}" class="btn text-white px-4 bg-main-dark icon-raduis btn-lg">Explore Countries</a>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="row">
                            <div class="col-12 col-md-6 mb-4">
                                <div class="text-white">
                                    <div class="bg-main-dark rounded-circle text-center mb-4" style="width: 50px; height: 50px; line-height: 50px;">
                                        <small class="text-white">{{ '567' }}</small>
                                    </div>
                                    <h4 class="text-main-dark">Rome</h4>
                                    <div class="text-white text-shadow-dark">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-4">
                                <div class="text-white">
                                    <div class="bg-main-dark rounded-circle text-center mb-4" style="width: 50px; height: 50px; line-height: 50px;">
                                        <small class="text-white">{{ '411' }}</small>
                                    </div>
                                    <h4 class="text-main-dark">Paris</h4>
                                    <div class="text-white text-shadow-dark">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('frontend.layouts.bottom')
@include('layouts.footer')