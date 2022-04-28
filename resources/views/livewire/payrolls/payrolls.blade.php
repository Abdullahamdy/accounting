<div>
    <div class="row">
        <div class="col-5">
            <livewire:payrolls.payroll-create :key="'payroll-create-payrolls-'"></livewire:payrolls.payroll-create>
{{--            <a href="{{ route('payrolls.create') }}" class="btn btn-success mb-3">انشاء كشف راتب</a>--}}
        </div>
{{--        <div class="col-7 text-start">--}}
{{--            <form>--}}
{{--                <div class="col-7 text-start d-inline-block">--}}
{{--                    <input name="search" placeholder="البحث بالاسم أو رمز الصنف أو الرقم التسلسلي أو مكان التواجد" type="text" class="form-control" value="{{ $search }}">--}}
{{--                </div>--}}
{{--                <div class="col text-end d-inline-block">--}}
{{--                    <button type="submit" class="btn btn-success">{{ __('Search') }}</button>--}}
{{--                </div>--}}
{{--            </form>--}}
{{--        </div>--}}
    </div>

    @if($payrolls->count())
        <div class="row">
            <div class="table-responsive-sm">
                <table class="table table-striped table-responsive-sm border">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">المستخدم</th>
                        <th scope="col" class="text-center">الراتب</th>
                        <th scope="col" class="text-center">السلفة</th>
                        <th scope="col" class="text-center">{{ __('Control') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($payrolls as $payroll)
                        <tr>
                            <td class="text-center align-middle">{{ $loop->iteration }}</td>
                            <td class="text-center align-middle">@if($payroll->user)<a href="{{ route('users.show', ['user_id' => $payroll->user ? $payroll->user->id : '']) }}">{{ $payroll->user ? $payroll->user->name : '' }}</a>@else - @endif</td>
                            <td class="text-center align-middle">@if($payroll->user){{ $payroll->user ? $payroll->user->balance : '' }}@else - @endif</td>
                            <td class="text-center align-middle"><a href="{{ route('payrolls.show', ['payroll_id' => $payroll->id]) }}">{{ $payroll->advance }}</a></td>
                            <td class="text-center align-middle">
                                <livewire:payrolls.payroll-edit :payroll_id="$payroll->id" :key="'payroll-edit-payrolls-'.$payroll->id"></livewire:payrolls.payroll-edit>
                                <livewire:payrolls.payroll-delete :payroll_id="$payroll->id" :key="'payroll-delete-payrolls-'.$payroll->id"></livewire:payrolls.payroll-delete>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{ $payrolls->links() }}
        </div>
    @else
        <div class="alert text-center alert-danger m-5">{{ __('Empty payrolls') }}</div>
    @endif
</div>

