<div class="text-center p-3">
    <div class="row">
        <div class="table-responsive-sm">
            <table class="table table-striped table-responsive-sm border">
                <thead>
                <tr>
                    <th scope="col" class="text-center">رقم الحساب</th>
                    <th scope="col" class="text-center">اسم الحساب</th>
                    <th scope="col" class="text-center">تابع لحساب</th>
                    <th scope="col" class="text-center">أساسي</th>
                    <th scope="col" class="text-center">القائمة المالية</th>
                    <th scope="col" class="text-center">رصيد الحساب</th>
                    <th scope="col" class="text-center">{{ __('Control') }}</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-center align-middle">{{ $index_account->account_number }}</td>
                    <td class="text-center align-middle"><a href="{{ route('index-accounts.show', ['index_account_id' => $index_account->id]) }}">{{ $index_account->account_name }}</a></td>
                    <td class="text-center align-middle">@if($index_account->parent)<a href="{{ route('index-accounts.show', ['index_account_id' => $index_account->parent->id]) }}">{{ $index_account->parent->account_name }}</a>@else - @endif</td>
                    <td class="text-center align-middle">{{ \App\Models\IndexAccount::basicList($index_account->basic) }}</td>
                    <td class="text-center align-middle">@if($index_account->account_guide)<a href="{{ route('account-guides.show', ['account_guide_id' => $index_account->account_guide ? $index_account->account_guide->id : '']) }}">{{ $index_account->account_guide ? $index_account->account_guide->title : '' }}</a>@else - @endif</td>
                    <td class="text-center align-middle">{{ $index_account->balance }}</td>
                    <td class="text-center align-middle">
                        <livewire:index-accounts.index-account-edit :index_account_id="$index_account->id" :key="'index-account-edit-index-account-show-'.$index_account->id"></livewire:index-accounts.index-account-edit>
                        <livewire:index-accounts.index-account-delete :index_account_id="$index_account->id" :key="'index-account-delete-index-account-show-'.$index_account->id"></livewire:index-accounts.index-account-delete>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        @if($invoices->count())
                <div class="table-responsive-sm">
                    <table class="table table-striped table-responsive-sm border">
                        <thead>
                        <tr>
                            <th scope="col" class="text-center">#</th>
                            <th scope="col" class="text-center">رقم الفاتورة</th>
                            <th scope="col" class="text-center">الوصف</th>
                            <th scope="col" class="text-center">تاريخ الفاتورة</th>
                            <th scope="col" class="text-center">اسم المستخدم</th>
                            <th scope="col" class="text-center">اسم فهرس الحساب</th>
                            <th scope="col" class="text-center">الحالة</th>
                            <th scope="col" class="text-center">النوع</th>
                            <th scope="col" class="text-center">السعر الاجمالي</th>
                            <th scope="col" class="text-center">{{ __('Control') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($invoices as $invoice)
                            <tr>
                                <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                <td class="text-center align-middle"><a href="{{ route('invoices.show', ['invoice_id' => $invoice->id]) }}">{{ $invoice->invoice_number }}</a></td>
                                <td class="text-center align-middle">@if($invoice->description != null)<a href="{{ route('invoices.show', ['invoice_id' => $invoice->id]) }}">{{ $invoice->description }}</a>@else - @endif</td>
                                <td class="text-center align-middle">@if($invoice->invoice_date != null){{ $invoice->invoice_date }}@else - @endif</td>
                                <td class="text-center align-middle">@if($invoice->user)<a href="{{ route('users.show', ['user_id' => $invoice->user ? $invoice->user->id : '']) }}">{{ $invoice->user ? $invoice->user->name : '' }}</a>@else - @endif</td>
                                <td class="text-center align-middle">@if($invoice->index_account)<a href="{{ route('index-accounts.show', ['index_account_id' => $invoice->index_account ? $invoice->index_account->id : '']) }}">{{ $invoice->index_account ? $invoice->index_account->account_name : '' }}</a>@else - @endif</td>
                                <td class="text-center align-middle">{{ \App\Models\Invoice::statusList($invoice->status) }}</td>
                                <td class="text-center align-middle">{{ \App\Models\Invoice::typeList($invoice->type) }}</td>
                                <td class="text-center align-middle">{{ $invoice->total_price }}</td>
                                <td class="text-center align-middle">
                                    <livewire:invoices.invoice-edit :invoice_id="$invoice->id" :key="'invoice-edit-index-account-show-'.$invoice->id"></livewire:invoices.invoice-edit>
                                    <livewire:invoices.invoice-delete :invoice_id="$invoice->id" :key="'invoice-delete-index-account-show-'.$invoice->id"></livewire:invoices.invoice-delete>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $invoices->links() }}
        @else
            <div class="alert text-center alert-danger mt-4">{{ __('Empty invoices this account') }}</div>
        @endif
    </div>
</div>
