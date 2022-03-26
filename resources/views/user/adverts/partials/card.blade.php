<div class="m-0 p-0 bg-white border position-relative">
	<div class="row no-gutters">
		@set('status', $advert->status)
		<div class="col-12 col-md-5">
			<div class="position-relative">
				<div class="position-absolute" style="top: -12px; left: 16px; z-index: 2;">
					<small class="text-white tiny-font px-3 py-1 bg-{{ $status == 'initialized' ? 'info' : ($status == 'active' ? 'success' : 'danger') }}">
						{{ ucfirst($status) }}
					</small>
				</div>
				<form action="javascript:;">
		            <input type="file" name="image" accept="image/*" class="advert-image-input-{{ $advert->id }} d-none" data-url="{{ route('advert.banner.upload', ['id' => $advert->id ]) }}">
		        </form>
		        <a href="{{ empty($advert->banner) ? 'javascript:;' : $advert->banner }}" class="position-relative d-block" style="height: 170px !important;">
					<img src="{{ empty($advert->banner) ? '/images/banners/placeholder.png' : $advert->banner }}" class="img-fluid h-100 object-cover w-100 advert-image-preview-{{ $advert->id }}">
				</a>
		        <div class="add-advert-image-loader-{{ $advert->id }} upload-image-loader d-none position-absolute rounded-circle text-center border" data-id="{{ $advert->id }}">
		            <img src="/images/spinner.svg">
		        </div>
				<div class="position-absolute bg-theme-color d-flex justify-content-between p-3 w-100" style="bottom: 0; z-index: 2;">
					<small class="text-muted">
						<i class="icofont-camera cursor-pointer text-white add-advert-image-{{ $advert->id }}" data-id="{{ $advert->id }}"></i>
					</small>
					<small class="text-white">
						{{ $advert->created_at->diffForHumans() }}
					</small>
				</div>
			</div>
		</div>
		<?php $duration = $advert->credit->duration ?? 1; ?>
		<div class="col-12 col-md-7 p-4">
			@if($status == 'initialized')
				<div class="row">
					<div class="col-6 mb-4">
            			<div class="dropdown">
				            <a href="javascript:;" class="btn btn-block btn-sm btn-outline-info" id="toggle-advert-status-{{ $advert->id }}" data-toggle="dropdown">
				                <small class="mr-1">
		                			<i class="icofont-stop"></i>
		                		</small>
		                		<small>Activate</small>
				            </a>
				            <div class="dropdown-menu border-0 shadow dropdown-menu-right" aria-labelledby="toggle-advert-status-{{ $advert->id }}" style="width: 260px !important;">
				            	<form method="post" class="activate-advert-form p-4" action="javascript:;" data-action="{{ route('user.advert.activate', ['id' => $advert->id]) }}">
				            		<div class="alert alert-info mb-4">This advert will start immediately after activation.</div>
				            		<input type="hidden" name="status" value="active">
				            		<div class="alert mb-3 activate-advert-message d-none"></div>
				            		<button type="submit" class="btn btn-info btn-block activate-advert-button">
				            			<img src="/images/spinner.svg" class="mr-2 d-none activate-advert-spinner mb-1">Activate
				            		</button>
				            	</form>
				            </div>
				        </div>
            		</div>
					<div class="col-6 mb-4">
			            @include('user.adverts.partials.remove')
					</div>
				</div>
				<div class="">
					<div class="progress progress-bar-height bg-light border mb-3">
	                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
	                </div>
	                <div class="d-flex justify-content-between align-items-center mb-3">
						<a href="javascript:;" class="d-flex justify-content-between text-main-dark text-underline text-main-dark" data-toggle="modal" data-target="#edit-advert-{{ $advert->id }}">0%</a>
						<a href="javascript:;" class="text-underline text-main-dark" data-toggle="modal" data-target="#edit-advert-{{ $advert->id }}">
							Total({{$duration }}days)
						</a>
					</div>
				</div>
            @elseif($status == 'paused')
            	<div class="row">
            		<div class="col-6 mb-4">
						<div class="dropdown">
				            <a href="javascript:;" class="btn btn-block btn-sm btn-success" id="resume-advert-{{ $advert->id }}" data-toggle="dropdown">
				                <small class="mr-1">
		                			<i class="icofont-play-alt-2"></i>
		                		</small>
		                		<small>Resume</small>
				            </a>
				            <div class="dropdown-menu border-0 shadow dropdown-menu-right" style="width: 260px !important;">
				            	<form method="post" class="resume-advert-form p-4" action="javascript:;" data-action="{{ route('user.advert.resume', ['id' => $advert->id]) }}">
				            		<div class="alert alert-success mb-4">This advert will resume immediately.</div>
				            		<input type="hidden" name="status" value="active">
				            		<div class="alert mb-3 resume-advert-message d-none"></div>
				            		<button type="submit" class="btn btn-success btn-block resume-advert-button">
				            			<img src="/images/spinner.svg" class="mr-2 d-none resume-advert-spinner mb-1">Resume
				            		</button>
				            	</form>
				            </div>
				        </div>
					</div>
            		<div class="col-6 mb-4">
            			<div class="dropdown">
				            <a href="javascript:;" class="btn btn-block btn-sm btn-outline-danger" id="toggle-advert-status-{{ $advert->id }}" data-toggle="dropdown">
				                <small class="mr-1">
		                			<i class="icofont-rewind"></i>
		                		</small>
		                		<small>Cancel</small>
				            </a>
				            <div class="dropdown-menu border-0 shadow dropdown-menu-right" aria-labelledby="toggle-advert-status-{{ $advert->id }}" style="width: 260px !important;">
				            	<form method="post" class="cancel-advert-form p-4" action="javascript:;" data-action="{{ route('user.advert.cancel', ['id' => $advert->id]) }}">
				            		<div class="alert alert-danger mb-4">This action is destructive and is irreversible.</div>
				            		<input type="hidden" name="status" value="active">
				            		<div class="alert mb-3 cancel-advert-message d-none"></div>
				            		<button type="submit" class="btn bg-theme-color text-white btn-block cancel-advert-button">
				            			<img src="/images/spinner.svg" class="mr-2 d-none cancel-advert-spinner mb-1">Cancel
				            		</button>
				            	</form>
				            </div>
				        </div>
					</div>
            	</div>
            	<div class="">
            		<?php $timing = \App\Helpers\Timing::calculate($duration, $advert->paused_at, $advert->started); ?>
	            	<div class="progress progress-bar-height mb-3">
	                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-dark" role="progressbar" aria-valuenow="{{ $timing->progress() }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $timing->progress() }}%"></div>
	                </div>
	                <div class="d-flex justify-content-between align-items-center mb-3">
						<a href="javascript:;" class="d-flex justify-content-between text-main-dark text-underline text-main-dark" data-toggle="modal" data-target="#edit-advert-{{ $advert->id }}">
							{{ $timing->progress() }}%
						</a>
						<div class="dropdown">
				            <a href="javascript:;" class="text-underline text-main-dark" id="advert-credit-{{ $advert->id }}" data-toggle="dropdown">
				            	({{ $timing->daysleft() }})days spent
				            </a>
				            <div class="dropdown-menu border-0 shadow dropdown-menu-right" aria-labelledby="advert-credit-{{ $advert->id }}" style="width: 240px !important;">
				            	<div class="px-4 py-3">
				            		Total {{ $duration }}days ({{ $advert->credit->units }}units)
				            	</div>
				            </div>
				        </div>
					</div>
            	</div>
	        @elseif($status == 'active')
	        	<div class="row">
					<div class="col-6 mb-4">
            			<div class="dropdown">
				            <a href="javascript:;" class="btn btn-block btn-sm btn-warning" id="resume-advert-{{ $advert->id }}" data-toggle="dropdown">
				                <small class="mr-1">
		                			<i class="icofont-pause"></i>
		                		</small>
		                		<small>Pause</small>
				            </a>
				            <div class="dropdown-menu border-0 shadow dropdown-menu-right" aria-labelledby="resume-advert-{{ $advert->id }}" style="width: 260px !important;">
				            	<form method="post" class="pause-advert-form p-4" action="javascript:;" data-action="{{ route('user.advert.pause', ['id' => $advert->id]) }}">
				            		<div class="alert alert-warning mb-4">This advert will be invisible till you resume it.</div>
				            		<input type="hidden" name="status" value="active">
				            		<div class="alert mb-3 pause-advert-message d-none"></div>
				            		<button type="submit" class="btn btn-warning btn-block pause-advert-button">
				            			<img src="/images/spinner.svg" class="mr-2 d-none pause-advert-spinner mb-1">Pause
				            		</button>
				            	</form>
				            </div>
				        </div>
            		</div>
					<div class="col-6 mb-4">
						<div class="dropdown">
				            <a href="javascript:;" class="btn btn-block btn-sm btn-outline-danger" id="toggle-advert-status-{{ $advert->id }}" data-toggle="dropdown">
				                <small class="mr-1">
		                			<i class="icofont-rewind"></i>
		                		</small>
		                		<small>Cancel</small>
				            </a>
				            <div class="dropdown-menu border-0 shadow dropdown-menu-right" aria-labelledby="toggle-advert-status-{{ $advert->id }}" style="width: 260px !important;">
				            	<form method="post" class="cancel-advert-form p-4" action="javascript:;" data-action="{{ route('user.advert.cancel', ['id' => $advert->id]) }}">
				            		<div class="alert alert-danger mb-4">This action is destructive and is irreversible.</div>
				            		<input type="hidden" name="status" value="active">
				            		<div class="alert mb-3 cancel-advert-message d-none"></div>
				            		<button type="submit" class="btn bg-theme-color text-white btn-block cancel-advert-button">
				            			<img src="/images/spinner.svg" class="mr-2 d-none cancel-advert-spinner mb-1">Cancel
				            		</button>
				            	</form>
				            </div>
				        </div>
					</div>
				</div>
				<div class="row">
	            	<?php  $timing = \App\Helpers\Timing::calculate($duration, $advert->expiry, $advert->started); ?>
	            	<div class="progress progress-bar-height mb-3">
	                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-dark" role="progressbar" aria-valuenow="{{ $timing->progress() }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $timing->progress() }}%"></div>
	                </div>
	                <div class="d-flex justify-content-between align-items-center mb-3">
						<a href="javascript:;" class="d-flex justify-content-between text-main-dark text-underline text-main-dark" data-toggle="modal" data-target="#edit-advert-{{ $advert->id }}">
							{{ $timing->progress() }}%
						</a>
						<div class="dropdown">
				            <a href="javascript:;" class="text-underline text-main-dark" id="advert-credit-{{ $advert->id }}" data-toggle="dropdown">
				            	({{ $timing->daysleft() }})days left
				            </a>
				            <div class="dropdown-menu border-0 shadow dropdown-menu-right" aria-labelledby="advert-credit-{{ $advert->id }}" style="width: 240px !important;">
				            	<div class="px-4 py-3">
				            		Total {{ $duration }}days ({{ $advert->credit->units ?? '' }}units)
				            	</div>
				            </div>
				        </div>
					</div>
				</div>
			@elseif($status == 'expired')
				<div class="row">
					<div class="col-6 mb-4">
            			<div class="dropdown">
				            <a href="javascript:;" class="btn btn-block btn-sm btn-info" id="resume-advert-{{ $advert->id }}" data-toggle="dropdown">
				                <small class="mr-1">
		                			<i class="icofont-renew"></i>
		                		</small>
		                		<small>Renew</small>
				            </a>
				            <div class="dropdown-menu border-0 shadow dropdown-menu-right" aria-labelledby="resume-advert-{{ $advert->id }}" style="width: 260px !important;">
				            	<form method="post" class="renew-advert-form p-4" action="javascript:;" data-action="{{ route('user.advert.renew', ['id' => $advert->id]) }}">
				            		<div class="alert alert-info mb-4">This advert will be activated after renewal.</div>
				            		<input type="hidden" name="status" value="active">
				            		<div class="alert mb-3 renew-advert-message d-none"></div>
				            		<button type="submit" class="btn btn-info btn-block renew-advert-button">
				            			<img src="/images/spinner.svg" class="mr-2 d-none renew-advert-spinner mb-1">Renew
				            		</button>
				            	</form>
				            </div>
				        </div>
            		</div>
					<div class="col-6 mb-4">
						@include('user.adverts.partials.remove')
					</div>
				</div>
				<div class="row">
	            	<?php  $timing = \App\Helpers\Timing::calculate($duration, $advert->expiry, $advert->started); ?>
	            	<div class="progress progress-bar-height mb-3">
	                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-dark" role="progressbar" aria-valuenow="{{ $timing->progress() }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $timing->progress() }}%"></div>
	                </div>
	                <div class="d-flex justify-content-between align-items-center mb-3">
						<a href="javascript:;" class="d-flex justify-content-between text-main-dark text-underline text-main-dark" data-toggle="modal" data-target="#edit-advert-{{ $advert->id }}">
							{{ $timing->progress() }}%
						</a>
						<div class="dropdown">
				            <a href="javascript:;" class="text-underline text-main-dark" id="advert-credit-{{ $advert->id }}" data-toggle="dropdown">
				            	({{ $timing->daysleft() }})days left
				            </a>
				            <div class="dropdown-menu border-0 shadow dropdown-menu-right" aria-labelledby="advert-credit-{{ $advert->id }}" style="width: 240px !important;">
				            	<div class="px-4 py-3">
				            		Total {{ $duration }}days ({{ $advert->credit->units ?? '' }}units)
				            	</div>
				            </div>
				        </div>
					</div>
				</div>
            @endif	
		</div>
	</div>
</div>