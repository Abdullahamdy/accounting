<div class="d-inline">
    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target=".modalFormEditArrestReceipt{{$arrest_receipt['id']}}">
        <i class="fa fa-edit"></i>
    </button>

    <div wire:ignore.self class="modal fade modalFormEditArrestReceipt{{$arrest_receipt['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ايصالات القبض</h5>
                    <button type="button" class="close btn ms-0" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="update" class="modal-body">
                 
                    <div class="form-group">
                        <label for="">المستخدم</label>
                        <select wire:model.defer="arrest_receipt.user_id" name="user_id" class="form-control">
                            <option value="">{{ __('Nothing') }}</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('arrest_receipt.user_id') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="">كمية الدفعة</label>
                        <input wire:model.defer="arrest_receipt.batch_quantity" type="number" class="form-control">
                        @error('arrest_receipt.batch_quantity')<span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="">النوع</label>
                        <select wire:model="arrest_receipt.type" name="type" class="form-control">
                            @foreach(\App\Models\ArrestReceipt::typeList() as $key => $type)
                                <option value="{{ $key }}">{{ $type }}</option>
                            @endforeach
                        </select>
                        @error('arrest_receipt.type') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>

                    <div class="mt-4 text-center">
                        <button wire:loading.attr="disabled" type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
