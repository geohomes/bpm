<div class="modal fade" id="membership-subscription" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            <form method="post" action="javascript:;" class="membership-subscription-form" data-action="{{ route('user.subscription.payment.initialize') }}" autocomplete="off">
                <div class="modal-body p-4">
                    <div class="d-flex justify-content-between pb-3 mb-3 border-bottom">
                        <div class="text-main-dark mb-0">Membership subscription</div>
                        <div class="cursor-pointer" data-dismiss="modal" aria-label="Close">
                            <i class="icofont-close text-danger"></i>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12">
                            <label class="text-main-dark">Choose plan</label>
                            <select class="form-control custom-select rounded-0 plan" name="plan">
                                <option value="">-- Select plan --</option>
                                <?php $plans = \App\Models\Membership::all(); ?>
                                @foreach ($plans as $plan)
                                    <option value="{{ $plan->id }}">
                                        {{ ucfirst($plan->name).' ('.ucfirst($plan->duration).'day(s)) '.($plan->currency ? $plan->currency->symbol : 'NGN' ).number_format($plan->price) }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="invalid-feedback plan-error"></small>
                        </div>
                    </div>
                    <div class="alert mb-3 membership-subscription-message d-none"></div>
                    <div class="d-flex justify-content-right mb-3 mt-1">
                        <button type="submit" class="btn btn-info icon-raduis btn-lg btn-block membership-subscription-button">
                            <img src="/images/spinner.svg" class="mr-2 d-none membership-subscription-spinner mb-1">
                            Pay
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>