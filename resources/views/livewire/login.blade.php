<div>
    <div class="row justify-content-center p-5">
        <form wire:submit.prevent="login" class="w-25">
            <div class="mb-3">
                <input type="email" class="form-control py-2 @error('user.email') is-invalid @enderror" wire:model="user.email" id="Email" placeholder="{{ __('Email') }}">
                @error('user.email')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
            <div class="mb-3">
                <input type="password" wire:model="user.password" class="form-control py-2 @error('user.password') is-invalid @enderror" id="password" placeholder="{{ __('Password') }}">
                @error('user.password')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
            <div class="text-center">
                <button type="submit" class="btn w-100 btn-primary">{{ __('Login') }}</button>
            </div>
            <div class="text-primary text-center py-3 my-2 border-bottom">
                <h5><a href="{{ route('forgot') }}" class="text-primary ">{{ __('did you forget your password ?') }}</a></h5>
            </div>
        </form>
    </div>
</div>
