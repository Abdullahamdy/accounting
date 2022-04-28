<div class="d-inline">
    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target=".modalFormEditInvoiceItem{{$invoice_item['id']}}">
        <i class="fa fa-edit"></i>
    </button>

    <div wire:ignore.self class="modal fade modalFormEditInvoiceItem{{$invoice_item['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">أصناف الفواتير</h5>
                    <button type="button" class="close btn ms-0" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="update" class="modal-body">
                    <div class="row">
                        <div class="form-group col-3">
                            <label for="">الصنف</label>
                            <select wire:model.defer="invoice_item.item_id" name="item_id" class="form-control">
                                <option value="">{{ __('Nothing') }}</option>
                                @foreach($items as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('invoice_item.item_id') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group col-2">
                            <label for="">الكمية</label>
                            <input wire:model.defer="invoice_item.quantity" type="number" class="form-control">
                            @error('invoice_item.quantity')<span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        @if($invoice->type == 1)
                            <div class="form-group col-2">
                                <label for="">سعر الشراء</label>
                                <input wire:model.defer="invoice_item.purchasing_price" type="number" class="form-control">
                                @error('invoice_item.purchasing_price')<span
                                    class="text-danger error">{{ $message }}</span>@enderror
                            </div>

                            <div class="form-group col-3">
                                <label for="">وحدة الشراء</label>
                                <select wire:model.defer="invoice_item.unit_id" name="unit_id" class="form-control">
                                    <option value="">{{ __('Nothing') }}</option>
                                    @foreach($units as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('invoice_item.unit_id') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        @else
                            <div class="form-group col-2">
                                <label for="">سعر البيع</label>
                                <input wire:model.defer="invoice_item.selling_price" type="number" class="form-control">
                                @error('invoice_item.selling_price')<span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        @endif
                        <div class="form-group col-3">
                            <label for="">الوصف</label>
                            <textarea wire:model.defer="invoice_item.description" rows="1" class="form-control"></textarea>
                            @error('invoice_item.description')<span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="mt-4 col-2 text-center">
                            <button wire:loading.attr="disabled" type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
