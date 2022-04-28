<div>
    <div wire:loading class="text-dark">{{ __('loading...') }}</div>
    <div class="row justify-content-center">
        <form wire:submit.prevent="store" class="w-25">
            <div class="input-edit mt-3">
                <div class="input-group ">
                    <div class="input-group-prepend">
                        <div class="input-group-text" style="padding: 9px 12px"><i class="fas fa-envelope-open"></i></div>
                    </div>
                    <input type="email" class="form-control @error('user.email') is-invalid @enderror"
                           wire:model.defer="user.email" placeholder="{{ __('Email') }}">
                    @error('user.email')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>
            <div class="input-edit mt-3">
                <div class="input-group ">
                    <div class="input-group-prepend">
                        <div class="input-group-text" style="padding: 9px 12px"><i class="fas fa-mobile-alt"></i></div>
                    </div>
                    <input type="number" class="form-control @error('user.mobile') is-invalid @enderror"
                           wire:model.defer="user.mobile" placeholder="{{ __('Mobile') }}">
                    @error('user.mobile')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>
            <div class="input-edit mt-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text" style="padding: 9px 12px"><i class="fas fa-unlock-alt"></i></div>
                    </div>
                    <input type="password" class="form-control @error('user.password') is-invalid @enderror"
                           wire:model.defer="user.password" placeholder="{{ __('Password') }}">
                    @error('user.password')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>
            <div class="input-edit mt-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text" style="padding: 9px 12px"><i class="fas fa-unlock-alt"></i></div>
                    </div>
                    <input type="password"
                           class="form-control mb-0 @error('user.password_confirmation') is-invalid @enderror"
                           wire:model.defer="user.password_confirmation" placeholder="{{ __('Confirm password') }}">
                    @error('user.password_confirmation')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror

                </div>
            </div>
            <div class="form-check text-dark mr-3 mt-3">
                <input class="form-check-input  @error('user.approved') is-invalid @enderror" type="checkbox" value="1"
                       wire:model.defer="user.approved">
                <label class="form-check-label font-16" for="defaultCheck1">
                    {{ __('Agree to the privacy policy.') }}
                </label>
                @error('user.approved')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
            <div class="text-center mt-3">
                <button class="btn btn-primary btn-login pl-4 pr-4" type="submit">{{ __('Sign Up') }}</button>
            </div>
            <div class="row">
                <div class="col-md-12 add-new text-center mt-3">
                    <a href="{{ route('login') }}">{{ __('Login') }}</a>
                </div>
            </div>
        </form>
    </div>
</div>
