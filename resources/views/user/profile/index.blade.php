@include('layouts.header')
<div class="min-vh-100 bg-main-ash">
    @include('user.layouts.navbar')
    <div class="user-content pb-4">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="">
                        @if(empty(auth()->user()->profile))
                            <h6 class="alert alert-info mb-4">Setup Profile details</h6>
                            <div class="p-4 card-raduis bg-white border mb-4">
                                @include('user.profile.partials.add')
                            </div>
                        @else
                            @set('user', auth()->user())
                            @set('profile', $user->profile)
                            <div class="row">
                                <div class="col-12 col-md-6 mb-4">
                                    <div class="position-relative bg-info mb-4 px-4" style="border-bottom-right-radius: 25px; border-bottom-left-radius: 25px;">
                                        <div class="d-flex">
                                            <div class="position-relative rounded-circle mr-3" style="width: 70px; height: 70px; top: -20px;">
                                                <a href="{{ empty($profile->image) ? 'javascript:;' : $profile->image }}">
                                                    <img src="{{ empty($profile->image) ? '/images/profiles/avatar.jpg' : $profile->image }}" class="img-fluid w-100 h-100 object-cover border border-info rounded-circle profile-image-preview border">
                                                </a>
                                                <div class="upload-profile-image-loader d-none position-absolute" data-id="{{ auth()->id() }}" style="top: 30%; right: 35%;">
                                                    <img src="/images/spinner.svg" class="position-relative">
                                                </div>
                                            </div>
                                            <div class="text-center d-flex align-items-center position-relative   cursor-pointer" style="top: -35px;">
                                                <small class="upload-profile-image text-white mr-3 tiny-font rounded-circle bg-success border" style="width: 25px; height: 25px; line-height: 25px;">
                                                    <i class="icofont-camera"></i>
                                                </small>
                                                @if(!empty($profile->image))
                                                    <small class="btn btn-sm btn-danger tiny-font px-4 py-1 rounded-pill delete-profile-image" data-url="{{ route('user.profile.image.remove', ['id' => $profile->id]) }}" data-message="Are you sure to remove your profile image?">
                                                        Remove
                                                    </small>
                                                @endif
                                            </div> 
                                        </div>
                                        <div class="">
                                            <form action="javascript:;">
                                                <input type="file" name="image" accept="image/*" class="profile-image-input d-none" data-url="{{ route('user.profile.image.upload', ['id' => $profile->id ]) }}">
                                            </form>
                                        </div>
                                        <div class="pb-5">
                                            <h5 class="text-main-dark mb-3">
                                                {{ ucwords($user->name) }}
                                            </h5>
                                            <div class="d-flex align-items-center justify-content-between flex-wrap">
                                                <div class="d-flex align-items-center">
                                                    <small class="text-white mr-3 rounded-pill tiny-font px-4 py-1 border">
                                                        {{ ucwords($user->created_at->diffForHumans()) }}
                                                    </small>
                                                    <small class="text-white mr-3 rounded-pill tiny-font px-4 py-1 border">
                                                        {{ ucwords($profile->designation) }}
                                                    </small>
                                                </div>
                                                <div class="{{ $user->status == 'active' ? 'bg-success' : 'bg-secondary' }} text-center border rounded-circle" style="width: 25px; height: 25px; line-height: 20px;">
                                                    <small class="text-white position-relative tiny-font">
                                                        <i class="icofont-tick-mark"></i>
                                                    </small>
                                                </div>
                                            </div>        
                                        </div>   
                                    </div>
                                    @if($profile->role == 'artisan')
                                        @if($user->gigs()->exists())
                                            <div class="d-flex flex-wrap alert alert-info pt-4 icon-raduis mb-4">
                                                @foreach($user->gigs as $gig)
                                                    <div class="mr-3 mb-4 position-relative">
                                                        <small class="px-3 py-1 text-main-dark rounded-pill border border-info">
                                                            {{ ucfirst($gig->service->name) }}
                                                        </small>
                                                    </div>
                                                @endforeach
                                            </div>   
                                        @endif
                                    @endif
                                    <div class="">
                                        <div class="">
                                            <h6 class="alert m-0 d-flex justify-content-between cursor-pointer alert-info" data-toggle="collapse" data-target="#edit-profile-dion" aria-expanded="false" aria-controls="edit-profile-dion">
                                                <span>Manage Profile details</span>
                                                <span>
                                                    <i class="icofont-caret-down"></i>
                                                </span>
                                            </h6>
                                        </div>
                                        <div class="collapse show" id="edit-profile-dion">
                                            <div class="p-4 mt-4 card-raduis bg-white border">
                                                @include('user.profile.partials.edit')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    @if($profile->designation == 'corporate')
                                        <div class="bg-white p-4 shadow-sm mb-4 card-raduis">
                                            <div class="alert alert-info">Company Details</div>
                                            <form method="post" class="update-company-details-form" action="javascript:;" data-action="{{ route('user.profile.company.update', ['id' => $profile->id]) }}" autocomplete="off">
                                                <div class="form-row">
                                                    <div class="form-group col-lg-6">
                                                        <label class="text-muted">Company Name</label>
                                                        <div class="input-group">
                                                            <input type="text" name="companyname" class="form-control companyname" placeholder="Enter company name" value="{{ $profile->companyname }}">
                                                        </div>
                                                        <small class="error companyname-error text-danger"></small>
                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <label class="text-muted">RC Number</label>
                                                        <input type="text" class="form-control rcnumber" name="rcnumber" placeholder="e.g., 1714517" value="{{ $profile->rcnumber }}">
                                                        <small class="invalid-feedback rcnumber-error"></small>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-lg-6">
                                                        @set('documents', \App\Models\Profile::$documents)
                                                        <label class="text-muted">Document</label>
                                                        <select class="form-control custom-select document" name="document">
                                                            <option value="">-- Select document --</option>
                                                            @if(empty($documents))
                                                                <option value="">No documents listed</option>
                                                            @else
                                                                @foreach ($documents as $document)
                                                                    <option value="{{ $document }}" {{ $profile->document == $document ? 'selected' : '' }}>
                                                                        {{ ucfirst($document) }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        <small class="invalid-feedback document-error"></small>
                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <label class="text-muted">Document Number Selected</label>
                                                        <input type="text" class="form-control idnumber" name="idnumber" placeholder="e.g., 23098916521" value="{{ $profile->idnumber }}">
                                                        <small class="invalid-feedback idnumber-error"></small>
                                                    </div>
                                                </div>
                                                <div class="alert mb-3 update-company-details-message d-none"></div>
                                                <button type="submit" class="btn btn-lg px-4 icon-raduis btn-info text-white update-company-details-button mb-4">
                                                    <img src="/images/spinner.svg" class="mr-2 d-none update-company-details-spinner mb-1">
                                                    Save
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                    <div class="">
                                        <div class="alert alert-info d-flex justify-content-between mb-4">
                                            <div class="">Social handles</div>
                                            <a href="javascript:;" class="text-decoration-none" data-toggle="modal" data-target="#add-social">
                                                <i class="icofont-plus"></i>
                                            </a>
                                        </div>
                                        @include('user.socials.partials.add')
                                        @if($user->socials()->exists())
                                            <div class="row d-flex align-items-center">
                                                @foreach($user->socials->take(5) as $social)
                                                    <div class="col-4 col-md-3 mb-4">
                                                        <div class="card border-0 bg-white position-relative icon-raduis shadow-sm">
                                                            <div class="card-body">
                                                               <a href="{{ ($social->company == 'whatsapp' || $social->company == 'telegram') ? "tel:{$social->phone}" : $social->link }}" class="text-center bg-theme-color rounded-circle d-block md-circle text-decoration-none">
                                                                    <small class="text-white tiny-font">
                                                                        <i class="icofont-{{ $social->company }}"></i>
                                                                    </small>
                                                                </a> 
                                                            </div>
                                                            <div class="card-footer d-flex align-items-center">
                                                                <small class="text-warning mr-2 cursor-pointer" data-toggle="modal" data-target="#edit-social-{{ $social->id }}">
                                                                    <i class="icofont-edit"></i>
                                                                </small>
                                                                <small class="text-danger cursor-pointer delete-social" data-url="{{ route('user.social.delete', ['id' => $social->id]) }}" data-message="Delete social media handle?">
                                                                    <i class="icofont-trash"></i>
                                                                </small>
                                                            </div>  
                                                        </div>  
                                                    </div>
                                                    @include('user.socials.partials.edit')
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="alert alert-info">You have not added any social media handles.</div>
                                        @endif
                                    </div>
                                    <div class="mb-4">
                                        <?php $qualifications = \App\Models\Profile::$qualifications; ?>
                                        <h6 class="alert alert-info mb-4 d-flex align-items-center justify-content-between">
                                            <span>Certifications list</span>
                                            <a href="javascript:;" data-toggle="modal" data-target="#add-certification">Add</a>
                                        </h6>
                                        @if($user->certifications()->exists())
                                            <?php $certifications = $certifications; ?>
                                            <div class="row">
                                                @foreach($certifications as $certificate)
                                                    <div class="col-12 col-lg-6 mb-4">
                                                        <div class="card border-0 shadow">
                                                            <div class="card-body">
                                                                <div class="d-flex justify-content-between align-items-center">
                                                                    <a href="javascript:;" data-target="#edit-certification-{{ $certificate->id }}" data-toggle="modal">
                                                                        <small class="text-main-dark text-underline">
                                                                            {{ \Str::limit($qualifications[$certificate->qualification], 14) }}
                                                                        </small>
                                                                    </a>
                                                                    <a href="javascript:;" data-target="#edit-certification-{{ $certificate->id }}" data-toggle="modal">
                                                                        <small class="text-main-dark text-underline">
                                                                            {{ $certificate->year }}
                                                                        </small>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-footer bg-main-dark d-flex align-items-center justify-content-between">
                                                            <small class="text-white">
                                                                {{ $certificate->created_at->diffForHumans() }}
                                                            </small>
                                                            <div class="d-flex align-items-center">
                                                                <a href="javascript:;" data-target="#edit-certification-{{ $certificate->id }}" data-toggle="modal">
                                                                    <small class="mr-1 text-warning">
                                                                        <i class="icofont-edit"></i>
                                                                    </small>
                                                                </a>
                                                                <a href="javascript:;" data-url="{{ '' }}">
                                                                    <small class="mr-1 text-danger">
                                                                        <i class="icofont-trash"></i>
                                                                    </small>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @include('user.certifications.partials.edit')
                                                @endforeach
                                            </div>   
                                        @else
                                            <div class="alert alert-danger">No certifications. <a href="javascript:;" data-toggle="modal" data-target="#add-certification">Add certificate</a></div>
                                        @endif
                                        @include('user.certifications.partials.add')
                                    </div>
                                </div>
                            </div>   
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')    