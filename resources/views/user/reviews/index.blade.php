@include('layouts.header')
<div class="min-vh-100 bg-main-ash">
    @include('user.layouts.navbar')
    <div class="user-content user-properties-banner pb-4">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div class="mb-3">
                    <h4 class="text-main-dark">All Reviews ({{ $reviews->count() }})</h4>
                    <div class="text-muted">Welcome <a href="{{ route('user.profile') }}">{{ auth()->user()->name }}</a>. List of all your reviews.</div>
                </div>
            </div>
            <div class="">
                @if(empty($reviews->count()))
                    <div class="alert-info alert">You have no reviews yet</div>
                @else
                    <div class="row">
                        @foreach($reviews as $review)
                            <div class="col-12 mb-4">
                                @include('user.reviews.partials.card')
                            </div>
                        @endforeach
                    </div>
                    {{ $reviews->links('vendor.pagination.default') }}
                @endif
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')    