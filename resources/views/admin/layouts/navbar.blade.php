<div class="fixed-top bg-white">
	<div class="py-3">
		<div class="container-fluid">
			<div class="d-flex justify-content-between align-items-center">
				<div class="d-flex align-items-center">
					<div class="mr-3 cursor-pointer text-center">
				    	<a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-main-dark">Dashboard</a>
				    </div>
				    <div class="mr-3 cursor-pointer text-center">
				    	<a href="{{ route('home') }}" class="text-decoration-none text-theme-color" target="_blank">
				    		<i class="icofont-web"></i>
				    	</a>
				    </div>
				</div>
				<ul class="d-flex align-items-baseline">
					{{-- <div class="cursor-pointer position-relative mr-3">
						<small class="rounded-pill px-1 position-absolute bg-info text-center" style="top: -7.5px; right: -7.5px; z-index: 2;">
							<small class="text-white">13</small>
						</small>
						<div>
							<i class="icofont-ui-messaging"></i>
						</div>
					</div>
					<div class="cursor-pointer position-relative mr-3">
						<small class="rounded-pill px-1 position-absolute bg-danger text-center" style="top: -7.5px; right: -7.5px; z-index: 2;">
							<small class="text-white">56</small>
						</small>
						<div style="transform: rotate(-20deg);">
							<i class="icofont-notification"></i>
						</div>
					</div> --}}
				    <a href="{{ route('logout'); }}" class="text-decoration-none text-center mr-3">
				    	<i class="icofont-power text-danger"></i>
				    </a>
				    <div class="dropdown">
	                    <a href="javascript:;" class="text-decoration-none d-block cursor-pointer" id="user-{{ auth()->id() }}" data-toggle="dropdown" data-offset="0, 15">
	                        <small class="text-main-dark">
	                            <i class="icofont-navigation-menu"></i>
	                        </small>
	                    </a>
	                    <div class="dropdown-menu border-0 icon-raduis shadow dropdown-menu-right" aria-labelledby="user-{{ auth()->id() }}" style="width: 280px !important; max-height: 480px; overflow-y: scroll;">
	                    	<a href="{{ route('admin.payments') }}" class="dropdown-item d-flex justify-content-between align-items-center">
	                            <span class="text-main-dark">Payments</span>
	                            <small class="text-theme-color">
	                            	<i class="icofont-long-arrow-right"></i>
	                            </small>
	                        </a>
	                        <div class="dropdown-divider"></div>
	                        <a href="{{ route('admin.countries') }}" class="dropdown-item d-flex justify-content-between align-items-center">
	                            <span class="text-main-dark">Countries</span>
	                            <small class="text-theme-color">
	                            	<i class="icofont-long-arrow-right"></i>
	                            </small>
	                        </a>
	                        <div class="dropdown-divider"></div>
	                        <a href="{{ route('admin.reviews') }}" class="dropdown-item d-flex justify-content-between align-items-center">
	                            <span class="text-main-dark">Users</span>
	                            <small class="text-theme-color">
	                            	<i class="icofont-long-arrow-right"></i>
	                            </small>
	                        </a>
	                        <div class="dropdown-divider"></div>
	                        <a href="{{ route('admin.properties') }}" class="dropdown-item d-flex justify-content-between align-items-center">
                                <span class="text-main-dark">Properties</span>
                                <small class="text-theme-color">
	                            	<i class="icofont-long-arrow-right"></i>
	                            </small>
                            </a>
	                    </div>
	                </div>
				</ul>
			</div>
		</div>
	</div>
</div>

