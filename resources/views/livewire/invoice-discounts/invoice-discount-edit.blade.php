<div class="d-inline">
    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target=".modalFormEditInvoiceDiscount{{$invoice_discount['id']}}">
        <i class="fa fa-edit"></i>
    </button>

    <div wire:ignore.self class="modal fade modalFormEditInvoiceDiscount{{$invoice_discount['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">خصومات الفواتير</h5>
                    <button type="button" class="close btn ms-0" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="update" class="modal-body">
                    <div class="form-group">
                        <label for="">الفاتورة</label>
                        <select wire:model.defer="invoice_discount.invoice_id" name="invoice_id" class="form-control">
                            <option value="">{{ __('Nothing') }}</option>
                            @foreach($invoices as $invoice)
                                <option value="{{ $invoice->id }}">{{ $invoice->invoice_number }}</option>
                            @endforeach
                        </select>
                        @error('invoice_discount.invoice_id') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="">المستخدم</label>
                        <select wire:model.defer="invoice_discount.user_id" name="user_id" class="form-control">
                            <option value="">{{ __('Nothing') }}</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('invoice_discount.user_id') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="">كمية الخصم</label>
                        <input wire:model.defer="invoice_discount.discount_quantity" type="number" class="form-control">
                        @error('invoice_discount.discount_quantity')<span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="mt-4 text-center col-6">
                        <button wire:loading.attr="disabled" type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
