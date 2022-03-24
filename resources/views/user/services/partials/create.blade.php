<div class="modal fade" id="create-service" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            <form method="post" action="javascript:;" class="create-service-form" data-action="{{ route('user.service.create') }}" autocomplete="off">
                <div class="modal-body p-4">
                    <div class="d-flex justify-content-between pb-3 mb-3 border-bottom">
                        <div class="text-main-dark mb-0">Create Service</div>
                        <div class="cursor-pointer" data-dismiss="modal" aria-label="Close">
                            <i class="icofont-close text-danger"></i>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="text-main-dark">Minimum Price (NGN)</label>
                            <div class="input-group">
                                <div class="input-group-append bg-main-ash">
                                    <div class="input-group-text">NGN</div>
                                </div>
                                <input type="number" class="form-control price" name="price" placeholder="e.g., 1000">
                                <div class="input-group-prepend bg-main-ash">
                                    <div class="input-group-text">.00</div>
                                </div>
                                <small class="invalid-feedback price-error"></small>
                            </div>  
                        </div>
                        <div class="form-group col-md-6">
                            <label class="text-main-dark">Service</label>
                            <select class="form-control custom-select skill" name="service">
                                <option value="">-- Select Service --</option>
                                @set('skills', \App\Models\Skill::all())
                                @foreach ($skills as $skill)
                                    <option value="{{ $skill->id }}">
                                        {{ ucfirst($skill->name) }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="invalid-feedback skill-error"></small>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label class="text-main-dark">Description (Maximum of 400 characters)</label>
                        <textarea class="form-control description" placeholder="Enter description of your service" name="description" rows="8"></textarea>
                        <small class="invalid-feedback description-error"></small>
                    </div>
                    <div class="alert mb-3 create-service-message d-none"></div>
                    <div class="d-flex justify-content-right mb-3 mt-1">
                        <button type="submit" class="btn btn-info icon-raduis btn-lg px-4 create-service-button px-4">
                            <img src="/images/spinner.svg" class="mr-2 d-none create-service-spinner mb-1">
                            Create
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>