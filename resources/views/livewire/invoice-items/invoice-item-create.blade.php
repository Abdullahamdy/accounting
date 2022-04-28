<div class="d-inline">
    <form wire:submit.prevent="store" class="modal-body">
        <div class="row">
            <div class="form-group col-2">
                <label for="">الصنف</label>
                <select wire:model="invoice_item.item_id" name="item_id" class="form-control">
                    <option value="">{{ __('Nothing') }}</option>
                    @foreach($items as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                @error('invoice_item.item_id') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>

            @if($invoice->type == 1)

              <div class="form-group col-2">
                    <label for="">وحدة الشراء</label>
                    <select wire:model="invoice_item.unit_id" name="unit_id" class="form-control">
                        <option value="">{{ __('Nothing') }}</option>
                        @foreach($units as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('invoice_item.unit_id') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group col-2">
                    <label for="">سعر الشراء</label>
                    <input wire:model.defer="invoice_item.purchasing_price" type="" class="form-control">
                    @error('invoice_item.purchasing_price')<span
                        class="text-danger error">{{ $message }}</span>@enderror
                </div>


            @else
            <div class="form-group col-2">
                <label for="">وحدة البيع</label>
                <select wire:model="invoice_item.unit_id" name="unit_id" class="form-control">
                    <option value="">{{ __('Nothing') }}</option>
                    @foreach($units as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                @error('invoice_item.unit_id') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>



                <div class="form-group col-2">
                    <label for="">سعر البيع</label>
                    <input wire:model.defer="invoice_item.selling_price" type="number" class="form-control">
                    @error('invoice_item.selling_price')<span class="text-danger error">{{ $message }}</span>@enderror
                </div>




              @endif
              <div class="form-group col-2">
                <label for="">الكمية</label>
                <input wire:model.defer="invoice_item.quantity" type="number" class="form-control">
                @error('invoice_item.quantity')<span class="text-danger error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group col-2">
                <label for="">الوصف</label>
                <textarea wire:model.defer="invoice_item.description" rows="1" class="form-control"></textarea>
                @error('invoice_item.description')<span class="text-danger error">{{ $message }}</span>@enderror
            </div>
            <div class="mt-4 col-2 text-center">
                <button wire:loading.attr="disabled" type="submit" style="background-color: #478fcc;color:white" class="btn">{{ __('Add') }}</button>
            </div>
        </div>
    </form>

  
</div>
