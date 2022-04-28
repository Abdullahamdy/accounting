<div class="d-inline">
    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target=".modalFormEditUnit{{$unit['id']}}">
        <i class="fa fa-edit"></i>
    </button>

    <div wire:ignore.self class="modal fade modalFormEditUnit{{$unit['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">الوحدات</h5>
                    <button type="button" class="close btn ms-0" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="update" class="modal-body">
                    <div class="form-group">
                        <label for="">الاسم</label>
                        <input wire:model.defer="unit.name" type="text" class="form-control">
                        @error('unit.name')<span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="">عدد القطع</label>
                        <input wire:model.defer="unit.pieces" type="number" class="form-control">
                        @error('unit.pieces')<span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="">وحدة القياس</label>
                        <input wire:model.defer="unit.measruing_unit" type="text" class="form-control">
                        @error('unit.measruing_unit')<span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="">سعر الشراء</label>
                        <input wire:model.defer="unit.purchasing_price" type="text" class="form-control">
                        @error('unit.purchasing_price')<span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <select wire:model.defer="unit.item_id" name="category_id" class="form-control">
                        <option value="">{{ __('Nothing') }}</option>
                        @foreach($items as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    <div class="form-group">
                        <label for="">سعر البيع</label>
                        <input wire:model.defer="unit.selling_price" type="text" class="form-control">
                        @error('unit.selling_price')<span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="mt-4">
                        <button wire:loading.attr="disabled" type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
