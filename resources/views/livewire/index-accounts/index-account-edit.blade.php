<div class="d-inline">
    {{--    @if(auth()->user()->can('edit users'))--}}
    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target=".modalFormEditIndexAccount{{$index_account['id']}}">
        <i class="fa fa-edit"></i>
    </button>

    <div wire:ignore.self class="modal fade modalFormEditIndexAccount{{$index_account['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">فهرس الحسابات</h5>
                    <button type="button" class="close btn ms-0" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="update" class="modal-body">
                    <div class="form-group">
                        <label for="">رقم الحساب</label>
                        <input wire:model.defer="index_account.account_number" type="text" class="form-control">
                        @error('index_account.account_number')<span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="">اسم الحساب</label>
                        <input wire:model.defer="index_account.account_name" type="text" class="form-control">
                        @error('index_account.account_name')<span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="">تابع لحساب</label>
                        <select wire:model.defer="index_account.index_account_id" name="index_account_id" class="form-control">
                            <option value="">لا يوجد</option>
                            @foreach($index_accounts as $index_account)
                                <option value="{{ $index_account->id }}">{{ $index_account->account_name }}</option>
                            @endforeach
                        </select>
                        @error('index_account.index_account_id') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="">أساسي</label>
                        <select wire:model.defer="index_account.basic" name="basic" class="form-control">
                            @foreach(\App\Models\IndexAccount::basicList() as $key => $basic)
                                <option value="{{ $key }}">{{ $basic }}</option>
                            @endforeach
                        </select>
                        @error('index_account.basic') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="">القائمة المالية</label>
                        <select wire:model.defer="index_account.account_guide_id" name="account_guide_id" class="form-control">
                            <option value="">لا يوجد</option>
                            @foreach($account_guides as $account_guide)
                                <option value="{{ $account_guide->id }}">{{ $account_guide->title }}</option>
                            @endforeach
                        </select>
                        @error('index_account.account_guide_id') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="">الرصيد</label>
                        <input wire:model.defer="index_account.balance" type="number" class="form-control">
                        @error('index_account.balance')<span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="mt-4">
                        <button wire:loading.attr="disabled" type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--    @endif--}}
</div>
