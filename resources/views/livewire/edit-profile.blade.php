<div class="d-inline">

    <button type="button" class="btn btn-sm btn-primary ml-auto mr-auto mb-2" data-bs-toggle="modal"
            data-bs-target="#ModalProfileEdit-{{auth()->id()}}-">
        <i class="fa fa-edit"></i> {{ __('Edit profile') }}
    </button>

    <!-- Modal -->
    <div class="modal fade" id="ModalProfileEdit-{{auth()->id()}}-" tabindex="-1" aria-labelledby="ModalProfileEdit-{{auth()->id()}}-Label"
         aria-hidden="true"
         wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header edit-data">
                    <h5 class="modal-title ms-auto" id="ModalProfileEdit-{{auth()->id()}}-Label">{{ __('Edit profile') }}</h5>
                    <button type="button" class="btn-close btn-sm p-0 m-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body edit-data-body">
                    <form wire:submit.prevent="update">
                        <div class="mb-3">
                            <label>{{ __('Email') }}</label>
                            <input class="form-control @error('user.email') is-invalid @enderror"
                                   wire:model.defer="user.email" placeholder="{{ __('Email') }}">
                            @error('user.email')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>{{ __('Mobile') }}</label>
                            <input class="form-control @error('user.mobile') is-invalid @enderror"
                                   wire:model.defer="user.mobile" placeholder="{{ __('Mobile') }}">
                            @error('user.mobile')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>{{ __('Password') }}</label>
                            <input type="password" class="form-control @error('user.password') is-invalid @enderror"
                                   wire:model.defer="user.password" placeholder="{{ __('Password') }}">
                            @error('user.password')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>{{ __('Confirm password') }}</label>
                            <input type="password" class="form-control @error('user.password_confirmation') is-invalid @enderror"
                                   wire:model.defer="user.password_confirmation"
                                   placeholder="{{ __('Confirm password') }}">
                            @error('user.password_confirmation')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

