<div>
    <div class="row px-4 py-2 mt-4">
        <div class="col-md-7 text-end mb-5">
            <div class="pe-5 pb-5 title-login">
                <h3>{{ __('Hey, you ..') }}</h3>
                <h1 class="text-success">
                    Accounting</h1>
            </div>
        </div>
        <div class="col-md-5 text-end">
            <div class="border-white mb-3 rounded-pill shadow">
                <div class="card-body ">
                    <div class="text-center">
                        <img src="{{ asset('assets/images/logo.jpg') }}" width="80px" height="80px" class="bg-white border rounded-circle p-2 logo-login mb-2" alt="">
                    </div>
                    <div class="text-center my-2">
                        <a href="{{ route('home') }}" class="btn btn-success rounded-pill px-3 mb-3"><i class="fas fa-home ps-1"></i>{{ __('Back to home') }}</a>
                    </div>
                    <div class="text-center my-2">
                        <a href="" class="btn btn-primary rounded-pill px-3 mb-3" wire:click.prevent="logout"><i class="fas fa-sign-out-alt ps-1"></i>{{ __('Logout') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
