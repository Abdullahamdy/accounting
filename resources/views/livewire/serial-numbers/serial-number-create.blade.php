<div class="d-inline">
    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalFormSerialNumber">
        انشاء رقم تسلسلي
    </button>

    <div wire:ignore.self class="modal fade" id="modalFormSerialNumber" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">الأرقام التسلسلية</h5>
                    <button type="button" class="close btn ms-0" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="store" class="modal-body">
                    <div class="form-group">
                        <label for="">الاسم</label>
                        <input wire:model.defer="serial_number.title" type="text" class="form-control">
                        @error('serial_number.title')<span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="">الرقم التسلسلي</label>
                        <input type="text" wire:model.defer="serial_number.serial" class="form-control">
                        @error('serial_number.serial')<span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="">الصنف</label>
                        <select wire:model.defer="serial_number.item_id" name="item_id" class="form-control">
                            <option value="">{{ __('Nothing') }}</option>
                            @foreach($items as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('serial_number.item_id') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="">الحالة</label>
                        <select wire:model="serial_number.status" name="status" class="form-control">
                            @foreach(\App\Models\SerialNumber::statusList() as $key => $status)
                                <option value="{{ $key }}">{{ $status }}</option>
                            @endforeach
                        </select>
                        @error('serial_number.status') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="mt-4">
                        <button wire:loading.attr="disabled" type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
