<div class="d-inline">
    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalFormPayroll">
        انشاء كشف راتب
    </button>

    <div wire:ignore.self class="modal fade" id="modalFormPayroll" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">كشوفات الرواتب</h5>
                    <button type="button" class="close btn ms-0" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="store" class="modal-body">
                    <div class="form-group">
                        <label for="">المستخدم</label>
                        <select wire:model.defer="payroll.user_id" name="user_id" class="form-control">
                            <option value="">{{ __('Nothing') }}</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('payroll.user_id') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="">السلفة</label>
                        <input wire:model.defer="payroll.advance" type="number" class="form-control">
                        @error('payroll.advance')<span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="mt-4">
                        <button wire:loading.attr="disabled" type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
