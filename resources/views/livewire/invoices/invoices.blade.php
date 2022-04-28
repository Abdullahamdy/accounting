<div>
    {{-- <livewire:invoices.invoice-create wire:click="addinvoice"  :key="'invoice-create-invoices-'"></livewire:invoices.invoice-create> --}}
    <button wire:click="addinvoice({{request('type')}})" type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalFormInvoice">
    @if(array_key_exists(request('type'),\App\Models\Invoice::typeList(false)))
    {{ __('Create invoice').' '. \App\Models\Invoice::typeList(request('type')) }}
@else
    انشاء فاتورة
@endif
</button>
    <form class="row mb-4 justify-content-center form-export">
        <div class="col-2 text-start">
            <input name="search" placeholder="البحث بالرقم أو الوصف" type="text" class="form-control" value="{{ $search }}">
        </div>
        <div class="col text-start">
            <input name="from" type="date" class="form-control" value="{{ $from }}">
        </div>

        <div class="col text-start">
            <input name="to" type="date" class="form-control" value="{{ $to }}">
        </div>
        <div class="col text-start">
            <select class="form-control" name="user_id">
                <option value="">كل المستخدمين</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col text-start">
            <select class="form-control" name="index_account_id">
                <option value="">كل الفهارس</option>
                @foreach($index_accounts as $index_account)
                    <option value="{{ $index_account->id }}" {{ $index_account_id == $index_account->id ? 'selected' : '' }}>{{ $index_account->account_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col text-start">
            <select class="form-control" name="status" wire:model.defer="status">
                <option value="">كل الحالات</option>
                @foreach(\App\Models\Invoice::statusList(false) as $key => $status)
                    <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>{{ $status }}</option>
                @endforeach
            </select>
        </div>
        <div class="col text-start">
            <select class="form-control" name="type" wire:model.defer="type">
                <option value="">كل الأنواع</option>
                @foreach(\App\Models\Invoice::typeList(false) as $key => $type)
                    <option value="{{ $key }}" {{ request('type') == $key ? 'selected' : '' }}>{{ $type }}</option>
                @endforeach
            </select>
        </div>
        <div class="col text-start">
            <button type="submit" class="btn btn-success">{{ __('Search') }}</button>
        </div>
    </form>

    @if($invoices->count())
        <div class="row">
            <div class="table-responsive-sm">
                <table class="table table-striped table-responsive-sm border">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">رقم الفاتورة</th>
                        <th scope="col" class="text-center">الوصف</th>
                        <th scope="col" class="text-center">تاريخ الفاتورة</th>
                        @if(request('type') == 1)
                        <th scope="col" class="text-center">اسم المورد</th>
                        @else
                        <th scope="col" class="text-center">اسم الزبون</th>
                      @endif
                        {{-- <th scope="col" class="text-center">اسم فهرس الحساب</th> --}}
                        <th scope="col" class="text-center">الحالة</th>
                        <th scope="col" class="text-center">النوع</th>
                        {{-- <th scope="col" class="text-center">السعر الاجمالي</th> --}}
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
                            {{-- <td class="text-center align-middle">@if($invoice->index_account)<a href="{{ route('index-accounts.show', ['index_account_id' => $invoice->index_account ? $invoice->index_account->id : '']) }}">{{ $invoice->index_account ? $invoice->index_account->account_name : '' }}</a>@else - @endif</td> --}}
                            <td class="text-center align-middle">{{ \App\Models\Invoice::statusList($invoice->status) }}</td>
                            <td class="text-center align-middle">{{ \App\Models\Invoice::typeList($invoice->type) }}</td>
                            {{-- <td class="text-center align-middle">{{ $invoice->total_price }}</td> --}}
                            <td class="text-center align-middle">
                                <livewire:invoices.invoice-edit :invoice_id="$invoice->id" :key="'invoice-edit-invoices-'.$invoice->id"></livewire:invoices.invoice-edit>
                                <livewire:invoices.invoice-delete :invoice_id="$invoice->id" :key="'invoice-delete-invoices-'.$invoice->id"></livewire:invoices.invoice-delete>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{ $invoices->links() }}
        </div>
    @else
        <div class="alert text-center alert-danger m-5">{{ __('Empty invoices') }}</div>
    @endif
</div>

