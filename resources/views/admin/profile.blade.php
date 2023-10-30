<div class="row">
    <div class="col-12 col-md-6 col-xl-4">
        <div class="form-group local-forms">
            <label>Name <span class="login-danger">*</span></label>
            <input class="form-control" type="text" id="name" name="name"
                placeholder="" value="{{ $user->name }}">
        </div>
    </div>
    <div class="col-12 col-md-6 col-xl-6">
        <div class="form-group local-forms">
            <label>Email <span class="login-danger">*</span></label>
            <input class="form-control" type="email" id="email" name="email" placeholder="" value="{{ $user->email }}">
        </div>
    </div>
    <div class="col-12">
        <div class="doctor-submit text-center">
            <button type="submit" class="btn btn-primary submit-form me-2">Update</button>
            <button type="submit" class="btn btn-primary cancel-form">Cancel</button>
        </div>
    </div>
</div>
