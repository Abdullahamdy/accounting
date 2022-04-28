<div>
    <form wire:submit.prevent="update">
        <div class="input-edit mb-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-unlock-alt"></i></div>
                </div>
                <input type="password" wire:model.defer="password" class="form-control mb-0 @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}">
                @error('password')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>
        <div class="input-edit mb-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-unlock-alt"></i></div>
                </div>
                <input type="password" wire:model.defer="password_confirmation" class="form-control mb-0 @error('password_confirmation') is-invalid @enderror" placeholder="{{ __('Confirm password') }}">
                @error('password_confirmation')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>
        <div class="text-center mt-3">
            <button class="btn btn-primary btn-login pl-4 pr-4" type="submit">{{ __('Update') }}</button>
        </div>
    </form>
</div>
