<div>
    <form wire:submit.prevent="send_reset">
        <div class="mb-3">
            <input type="email" class="form-control py-2 @error('email') is-invalid @enderror"  wire:model="email" id="Email" placeholder="{{ __('Email') }}">
            @error('email')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="text-center mt-3">
            <button class="btn btn-primary btn-login ps-4 pe-4" type="submit">{{ __('Restore password') }}</button>
        </div>
        <div class="text-center mt-3 border-top pt-2">
            <a href="{{route('login')}}" class="btn btn-success">{{ __('Login') }}</a>
        </div>
    </form>
</div>
