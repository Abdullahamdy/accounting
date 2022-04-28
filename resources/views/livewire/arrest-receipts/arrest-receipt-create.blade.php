<div class="d-inline">
    @if($invoice)
    <form wire:submit.prevent="store" class="modal-body">


        <div class="row justify-content-center">
            <div class="form-group col-12">
                {{-- <label for="">كمية الدفعة</label> --}}
                <input wire:model.defer="arrest_receipt.batch_quantity"  wire:keydown.debounce.500ms="store($event.target.value)" type="number" class="form-control text-center">
                @error('arrest_receipt.batch_quantity')<span class="text-danger error">{{ $message }}</span>@enderror
            </div>
            {{-- <div class="form-group col-3">
                <label for="">النوع</label>
                <select wire:model="arrest_receipt.type" name="type" class="form-control">
                    @foreach(\App\Models\ArrestReceipt::typeList() as $key => $type)
                        <option value="{{ $key }}">{{ $type }}</option>
                    @endforeach
                </select>
                @error('arrest_receipt.type') <span class="text-danger error">{{ $message }}</span>@enderror
            </div> --}}
            {{-- <div class="mt-4 text-center col-3">
                <button wire:loading.attr="disabled" type="submit" class="btn btn-primary">{{ __('Add') }}</button>
            </div> --}}
        </div>
    </form>
    @else
        <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalFormArrestReceiptsCreate">
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

        <div wire:ignore.self class="modal fade" id="modalFormArrestReceiptsCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        @if(request('type'))
                        <h5 class="modal-title" id="exampleModalLabel">ايصالات القبض</h5>
                        @else
                        <h5 class="modal-title" id="exampleModalLabel">ايصالات الصرف</h5>
                        @endif
                        <button type="button" class="close btn ms-0" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="store" class="modal-body">
                   
                        <div class="form-group">
                            @if(request('type'))
                            <label for="">الزبون</label>
                            @else
                            <label for="">المورد</label>
                            @endif
                            <select wire:model.defer="arrest_receipt.user_id" name="user_id" class="form-control">
                                <option value="">{{ __('Nothing') }}</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('arrest_receipt.user_id') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>

                        {{-- <div class="form-group">
                            <label for="">الفاتورة</label>
                            <select wire:model.defer="arrest_receipt.invoice_id" name="invoice_id" class="form-control">
                                <option value="">{{ __('Nothing') }}</option>
                                @foreach($invoices as $invoice)
                                    <option value="{{ $invoice->id }}">{{ $invoice->invoice_number }}</option>
                                @endforeach
                            </select>
                            @error('arrest_receipt.invoice_id') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div> --}}
                        <div class="form-group">
                            <label for="">كمية الدفعة</label>
                            <input wire:model.defer="arrest_receipt.batch_quantity" type="number" class="form-control">
                            @error('arrest_receipt.batch_quantity')<span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        @if(!array_key_exists(request('type'),\App\Models\ArrestReceipt::typeList(false)))
                        {{-- <div class="form-group">
                            <label for="">النوع</label>
                            <select wire:model="arrest_receipt.type" name="type" class="form-control">
                                @foreach(\App\Models\ArrestReceipt::typeList() as $key => $type)
                                    <option value="{{ $key }}">{{ $type }}</option>
                                @endforeach
                            </select>
                            @error('arrest_receipt.type') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div> --}}
                        @endif
                        <div class="mt-4 text-center">
                            <button wire:loading.attr="disabled" type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
