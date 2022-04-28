<div class="d-inline">
    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalFormAccountGuide">
        انشاء دليل حساب
    </button>

    <div wire:ignore.self class="modal fade" id="modalFormAccountGuide" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">القوائم المالية</h5>
                    <button type="button" class="close btn ms-0" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="store" class="modal-body">
                    <div class="form-group">
                        <label for="">العنوان</label>
                        <input wire:model.defer="account_guide.title" type="text" class="form-control">
                        @error('account_guide.title')<span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="mt-4">
                        <button wire:loading.attr="disabled" type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
