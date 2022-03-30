@include('layouts.header')
    @include('frontend.layouts.navbar')
    <div class="position-relative">
    	<section class="contact-banner">
			<div class="container">
				<h1 class="text-theme-color mb-4">Send a <span class="text-white">Message</span></h1>
				<div class="row">
					<div class="col-12 col-lg-8 mb-4">
						<form class="contact-form p-4 mb-4 rounded border" action="javascript:;" method="post">
							<div class="form-row">
						        <div class="form-group col-md-6">
						            <label class="text-white">Fullname</label>
							        <input type="text" name="fullname" class="form-control fullname" placeholder="Enter email or phone">
						            <small class="error fullname-error text-danger"></small>
						        </div>
						        <div class="form-group col-md-6">
						            <label class="text-white">Designation</label>
						            <select class="custom-select form-control type">
						            	<option value="">Select Designation</option>
						            	<option value="Company">Company</option>
						            	<option value="Individual">Individual</option>
						            </select>
						            <small class="error password-error text-danger"></small>
						        </div>
						    </div>
						    <div class="form-row">
						     	<div class="form-group col-md-6">
						            <label class="text-white">Email</label>
							        <input type="email" name="email" class="form-control email" placeholder="e.g., email@you.com">
						            <small class="error email-error text-danger"></small>
						        </div>
						        <div class="form-group col-md-6">
						            <label class="text-white">Phone</label>
						            <input type="number" name="phone" class="form-control phone" placeholder="e.g., 09062972785">
						            <small class="error phone-error text-danger"></small>
						        </div>
						    </div>
						    <div class="mb-4">
						    	<label class="text-white">Message</label>
						    	<textarea class="form-control message" name="message" rows="4" placeholder="Enter message here"></textarea>
						    	<small class="error message-error text-danger"></small>
						    </div>
						    <button type="submit" class="btn btn-lg bg-theme-color icon-raduis btn-block text-white contact-form-button mb-4">
						        <img src="/images/spinner.svg" class="mr-2 d-none contact-form-spinner mb-1">
						        Send
						    </button>
						    <div class="alert px-3 contact-form-message d-none mb-3"></div>
						</form>
						<div class="row">
							<div class="col-12 mb-4">
								<div class="w-100 h-100" id="contactmap">
									<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.6468249831787!2d7.492911815325601!3d6.439381725920649!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1044a3d8f51f6071%3A0x6b07f5ee68d7e660!2s26%20Moorehouse%20St%2C%20Ogui%20400001%2C%20Enugu!5e0!3m2!1sen!2sng!4v1637755718285!5m2!1sen!2sng" allowfullscreen="" loading="lazy" class="w-100 h-100 rounded"></iframe>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12 col-lg-4">
						<h3 class="text-white">Office Addresses</h3>
						<div class="mb-4">
							<p class="text-theme-color">Head Office</p>
							<div class="text-white">Suit E01b, The statement Complex, Plot 1002, First Avenue, CBD, Abuja.</div>
						</div>
						<div class="mb-4">
							<p class="text-theme-color">Branch Office</p>
							<div class="text-white">Geohomes House, 26 Moorehouse Street, Ogui Enugu, Enugu State.</div>
						</div>
						
					</div>
				</div>
			</div>
		</section>
    </div>
	@include('frontend.layouts.bottom')
@include('layouts.footer')