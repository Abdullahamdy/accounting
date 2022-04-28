<div>
    @if(!auth()->user()->hasRole('Admin'))
        <h4 class="text-center mt-3 text-success pb-2"><a href="{{ route('users.show', ['user_id' => auth()->id()]) }}">{{ __('Please fill in the rest of the information !') }}</a></h4>
    @endif
    @if(auth()->user()->hasRole('Admin'))
        <h3 class="text-center mt-3 text-success">{{ __('Control Panel home page!') }}</h3>
        <div class="row mt-5 mb-4">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <h5 class="card-body mb-0"> <i class="fas fa-user h6 ms-1"></i> {{ __('Users number') }} </h5>
                    <h2 class="text-center fw-bolder text-primary">{{ \App\Models\User::count() }}</h2>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <h5 class="card-body mb-0"> <i class="fas fa-user h6 ms-1"></i> عدد الآدمن </h5>
                    <h2 class="text-center fw-bolder text-primary">{{ $admins->count() }}</h2>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <h5 class="card-body mb-0"> <i class="fas fa-user h6 ms-1"></i> عدد الموردين </h5>
                    <h2 class="text-center fw-bolder text-primary">{{ $suppliers->count() }}</h2>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <h5 class="card-body mb-0"> <i class="fas fa-user h6 ms-1"></i> عدد الزبائن </h5>
                    <h2 class="text-center fw-bolder text-primary">{{ $customers->count() }}</h2>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <h5 class="card-body mb-0"> <i class="fas fa-user h6 ms-1"></i> عدد الموظفين </h5>
                    <h2 class="text-center fw-bolder text-primary">{{ $employees->count() }}</h2>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <h5 class="card-body mb-0"> <i class="fas fa-user h6 ms-1"></i> عدد المستخدَمين </h5>
                    <h2 class="text-center fw-bolder text-primary">{{ $servants->count() }}</h2>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <h5 class="card-body mb-0"> <i class="fas fa-user-shield h6 ms-1"></i> {{ __('Roles number') }} </h5>
                    <h2 class="text-center fw-bolder text-primary">{{ \Spatie\Permission\Models\Role::count() }}</h2>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <h5 class="card-body mb-0"> <i class="fas fa-list h6 ms-1"></i> عدد فهارس الحسابات </h5>
                    <h2 class="text-center fw-bolder text-primary">{{ \App\Models\IndexAccount::count() }}</h2>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <h5 class="card-body mb-0"> <i class="fas fa-th-list h6 ms-1"></i> عدد الأصناف </h5>
                    <h2 class="text-center fw-bolder text-primary">{{ \App\Models\Item::count() }}</h2>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <h5 class="card-body mb-0"> <i class="fas fa-clipboard-list h6 ms-1"></i> عدد فواتير البيع </h5>
                    <h2 class="text-center fw-bolder text-primary">{{ \App\Models\Invoice::where('type', 0)->count() }}</h2>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <h5 class="card-body mb-0"> <i class="fas fa-clipboard-list h6 ms-1"></i> اجمالي فواتير البيع </h5>
                    <h2 class="text-center fw-bolder text-primary">{{ \App\Models\Invoice::where('type', 0)->sum('total_price') }}</h2>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <h5 class="card-body mb-0"> <i class="fas fa-clipboard-list h6 ms-1"></i> عدد فواتير الشراء </h5>
                    <h2 class="text-center fw-bolder text-primary">{{ \App\Models\Invoice::where('type', 1)->count() }}</h2>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <h5 class="card-body mb-0"> <i class="fas fa-clipboard-list h6 ms-1"></i> اجمالي فواتير الشراء </h5>
                    <h2 class="text-center fw-bolder text-primary">{{ \App\Models\Invoice::where('type', 1)->sum('total_price') }}</h2>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <h5 class="card-body mb-0"> <i class="fas fa-percent h6 ms-1"></i> عدد خصومات الفواتير </h5>
                    <h2 class="text-center fw-bolder text-primary">{{ \App\Models\InvoiceDiscount::count() }}</h2>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <h5 class="card-body mb-0"> <i class="fas fa-money-check-alt h6 ms-1"></i> عدد ايصالات القبض الصادرة </h5>
                    <h2 class="text-center fw-bolder text-primary">{{ \App\Models\ArrestReceipt::where('type', 0)->count() }}</h2>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <h5 class="card-body mb-0"> <i class="fas fa-money-check-alt h6 ms-1"></i> عدد ايصالات القبض الواردة </h5>
                    <h2 class="text-center fw-bolder text-primary">{{ \App\Models\ArrestReceipt::where('type', 1)->count() }}</h2>
                </div>
            </div>
        </div>
    @endif
</div>
