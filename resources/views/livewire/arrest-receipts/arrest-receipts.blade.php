<div>
    @php

       $invMouRec = $invoice != null ? $invoice->id : 0
    @endphp
    @if(!$invMouRec)
    <div class="row">
        <div class="col-5">
            {{-- <livewire:arrest-receipts.arrest-receipt-create :invoice_id="($invoice?$invoice->id:0)" :key="'arrest-receipt-create-arrest-receipts-'"></livewire:arrest-receipts.arrest-receipt-create> --}}

            <button wire:click="add_arrest({{request('type')}})" type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalFormArrestReceiptsCreate">
                @if(array_key_exists(request('type'),\App\Models\ArrestReceipt::typeList(false)))
                    @if(\App\Models\ArrestReceipt::typeList(request('type')) == 'صادرة')
                    {{ __('Create a voucher') }}
                    @else
                        {{ __('Create a receipt') }}
                    @endif
                @else
                    انشاء ايصال
                @endif
            </button>

        </div>
        <div class="col-7 text-start">
            <form>
                <div class="col-3 text-start d-inline-block">
                    <select class="form-control" name="invoice_id">
                        <option value="">كل الفواتير</option>
                        @foreach($invoices as $invoice)
                            <option value="{{  $invoice->id }}" {{ (!empty($invoice_id) and  $invoice_id == $invoice->id) ? 'selected' : '' }}>{{ $invoice->invoice_number }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3 text-start d-inline-block">
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
                        @foreach(\App\Models\ArrestReceipt::typeList(false) as $key => $type)
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
         <livewire:arrest-receipts.arrest-receipt-create :invoice_id="($invoice?$invoice->id:0)" :key="'arrest-receipt-create-arrest-receipts-'"></livewire:arrest-receipts.arrest-receipt-create>
    @endif

    @if($arrest_receipts->count())
        <div class="row">
            <div class="table-responsive-sm">
                <table class="table table-striped table-responsive-sm border">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        @if(!$invMouRec)
                            <th scope="col" class="text-center">الفاتورة</th>

                               @if(request('type') == 0)
                        <th scope="col" class="text-center">اسم المورد</th>
                        @else
                        <th scope="col" class="text-center">اسم الزبون</th>
                      @endif
                        @endif
                        <th scope="col" class="text-center">تاريخ الدفعة</th>
                        <th scope="col" class="text-center">كمية الدفعة</th>
                        {{-- <th scope="col" class="text-center">النوع</th> --}}
                        <th scope="col" class="text-center">{{ __('Control') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $total = 0
                    @endphp
                    @foreach($arrest_receipts as $arrest_receipt)

                        @php
                            $total = $total + $arrest_receipt->batch_quantity;
                        @endphp
                        <tr>
                            <td class="text-center align-middle">{{ $loop->iteration }}</td>
                            @if(!$invMouRec)
                                <td class="text-center align-middle">@if($arrest_receipt->invoice)<a href="{{ route('invoices.show', ['invoice_id' => $arrest_receipt->invoice ? $arrest_receipt->invoice->id : '']) }}">{{ $arrest_receipt->invoice ? $arrest_receipt->invoice->invoice_number : '' }}@else - @endif</td>
                                <td class="text-center align-middle">@if($arrest_receipt->user)<a href="{{ route('users.show', ['user_id' => $arrest_receipt->user ? $arrest_receipt->user->id : '']) }}">{{ $arrest_receipt->user ? $arrest_receipt->user->name : '' }}@else - @endif</td>
                            @endif
                            <td class="text-center align-middle">{{ $arrest_receipt->created_at }}</td>
                            <td class="text-center align-middle">{{ $arrest_receipt->batch_quantity }}</td>
                            {{-- <td class="text-center align-middle">{{ \App\Models\ArrestReceipt::typeList($arrest_receipt->type) }}</td> --}}
                            <td class="text-center align-middle">
                                <livewire:arrest-receipts.arrest-receipt-edit :arrest_receipt_id="$arrest_receipt->id" :invoice_id="($invoice?$invoice->id:0)" :key="'arrest-receipt-edit-arrest-receipts-'.$arrest_receipt->id"></livewire:arrest-receipts.arrest-receipt-edit>
                                <livewire:arrest-receipts.arrest-receipt-delete :arrest_receipt_id="$arrest_receipt->id"  :invoice_id="($invoice?$invoice->id:0)" :key="'arrest-receipt-delete-arrest-receipts-'.$arrest_receipt->id"></livewire:arrest-receipts.arrest-receipt-delete>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <th scope="col" class="text-center"></th>
                        <th scope="col" class="text-center">المجموع</th>
                        <th scope="col" class="text-center">{{ $total }}</th>
                    </tr>
                    </tbody>
                </table>
            </div>
            {{ $arrest_receipts->links() }}
        </div>
    @else
        <div class="alert text-center alert-danger m-5">{{ __('Empty arrest receipts') }}</div>
    @endif
</div>

