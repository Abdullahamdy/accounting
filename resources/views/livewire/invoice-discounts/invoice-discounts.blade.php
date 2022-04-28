<div>
    @php
        $invMouDis = $invoice->id;
    @endphp
    @if(!$invMouDis)
    <div class="row">
        <div class="col-5">
            <livewire:invoice-discounts.invoice-discount-create :invoice_id="$invoice->id" :key="'invoice-discount-create-invoice-discounts-'. $invoice->id"></livewire:invoice-discounts.invoice-discount-create>
        </div>
        <div class="col-7 text-start">
            <form>
                <div class="col-4 text-start d-inline-block">
                    <select class="form-control" name="invoice_id">
                        <option value="">كل الفواتير</option>
                        @foreach($invoices as $invoice)
                            <option value="{{ $invoice->id }}" {{ $invoice_id == $invoice->id ? 'selected' : '' }}>{{ $invoice->invoice_number }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4 text-start d-inline-block">
                    <select class="form-control" name="user_id">
                        <option value="">كل المستخدمين</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3 text-start d-inline-block">
                    <select name="type" wire:model.defer="type" class="form-control">
                        <option value="">كل الأنواع</option>
                        @foreach(\App\Models\Invoice::typeList(false) as $key => $type)
                            <option value="{{ $key }}" {{ request('type') == $key ? 'selected' : '' }}>{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col text-end d-inline-block">
                    <button type="submit" class="btn btn-success">{{ __('Search') }}</button>
                </div>
            </form>
        </div>
    </div>
    @else
        <livewire:invoice-discounts.invoice-discount-create :invoice_id="$invoice->id" :key="'invoice-discount-create-invoice-discounts-'. $invoice->id"></livewire:invoice-discounts.invoice-discount-create>
    @endif

    @if($invoice_discounts->count())
        <div class="row">
            <div class="table-responsive-sm">
                <table class="table table-striped table-responsive-sm border">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        @if(!$invMouDis)
                            <th scope="col" class="text-center">الفاتورة</th>
                            <th scope="col" class="text-center">المستخدم</th>
                        @endif
                        <th scope="col" class="text-center">كمية الخصم</th>
                        <th scope="col" class="text-center">{{ __('Control') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $total = 0
                    @endphp
                    @foreach($invoice_discounts as $invoice_discount)
                        @php
                            $total = $total + $invoice_discount->discount_quantity;
                        @endphp
                        <tr>
                            <td class="text-center align-middle">{{ $loop->iteration }}</td>
                            @if(!$invMouDis)
                                <td class="text-center align-middle">@if($invoice_discount->invoice)<a href="{{ route('invoices.show', ['invoice_id' => $invoice_discount->invoice ? $invoice_discount->invoice->id : '']) }}">{{ $invoice_discount->invoice ? $invoice_discount->invoice->invoice_number : '' }}@else - @endif</td>
                                <td class="text-center align-middle">@if($invoice_discount->user)<a href="{{ route('users.show', ['user_id' => $invoice_discount->user ? $invoice_discount->user->id : '']) }}">{{ $invoice_discount->user ? $invoice_discount->user->name : '' }}@else - @endif</td>
                            @endif
                            <td class="text-center align-middle"><a href="{{ route('invoice-discounts.show', ['invoice_discount_id' => $invoice_discount->id]) }}">{{ $invoice_discount->discount_quantity }}</a></td>
                            <td class="text-center align-middle">
                                <livewire:invoice-discounts.invoice-discount-edit :invoice_discount_id="$invoice_discount->id" :invoice_id="$invoice->id"  :key="'invoice-discount-edit-invoice-discounts-'.$invoice_discount->id"></livewire:invoice-discounts.invoice-discount-edit>
                                <livewire:invoice-discounts.invoice-discount-delete :invoice_discount_id="$invoice_discount->id" :invoice_id="$invoice->id"  :key="'invoice-discount-delete-invoice-discounts-'.$invoice_discount->id"></livewire:invoice-discounts.invoice-discount-delete>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <th scope="col" class="text-center">المجموع</th>
                        <th scope="col" class="text-center">{{ $total }}</th>
                    </tr>
                    </tbody>
                </table>
            </div>
            {{ $invoice_discounts->links() }}
        </div>
    @else
        <div class="alert text-center alert-danger m-5">{{ __('Empty invoice discounts') }}</div>
    @endif
</div>

