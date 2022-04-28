<div class="d-inline">
    @if($invoice)
    <form wire:submit.prevent="store" class="modal-body">
        <div class="row justify-content-center">
            <div class="form-group col-12">

                <input wire:model.defer="invoice_discount.discount_quantity"  wire:keydown.debounce.500ms="store($event.target.value)" type="number" class="form-control text-center ">
                @error('invoice_discount.discount_quantity')<span class="text-danger error">{{ $message }}</span>@enderror
            </div>
            {{-- <div class="mt-4 text-center col-3"> --}}
                {{-- <button wire:loading.attr="disabled" type="submit" class="btn btn-primary">{{ __('Add') }}</button> --}}
            {{-- </div> --}}
        </div>
    </form>
    @else
        <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalFormInvoiceDiscountCreate">
            @if(array_key_exists(request('type'),\App\Models\Invoice::typeList(false)))
                @if(\App\Models\Invoice::typeList(request('type')) == 'شراء')
                    {{ __('Create an earned invoice discount') }}
                @else
                    {{ __('Create an allowed invoice discount') }}
                @endif
            @else
                انشاء خصم فاتورة
            @endif
        </button>

        <div wire:ignore.self class="modal fade" id="modalFormInvoiceDiscountCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">خصومات الفواتير</h5>
                        <button type="button" class="close btn ms-0" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="store" class="modal-body">
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
                        <div class="mt-4 text-center">
                            <button wire:loading.attr="disabled" type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
