<div class="d-inline">
{{--    @if(auth()->user()->can('edit users'))--}}
        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target=".modalFormEditUser{{$user['id']}}">
            <i class="fa fa-edit"></i>
        </button>

        <div wire:ignore.self class="modal fade modalFormEditUser{{$user['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@if(request('role_id')){{ __(\Spatie\Permission\Models\Role::where('id', request('role_id'))->first()->name.'s') }}@endif</h5>
                        <button type="button" class="close btn ms-0" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="update" class="modal-body">
                        <div class="form-group">
                            <label for="">الاسم</label>
                            <input wire:model.defer="user.name" type="text" class="form-control">
                            @error('user.name')<span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="">{{ __('Email') }}</label>
                            <input wire:model.defer="user.email" type="email" class="form-control">
                            @error('user.email')<span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="">{{ __('Mobile') }}</label>
                            <input wire:model.defer="user.mobile" type="number" class="form-control">
                            @error('user.mobile')<span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="">العنوان</label>
                            <input wire:model.defer="user.address" type="text" class="form-control">
                            @error('user.address')<span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
{{--                        <div class="form-group">--}}
{{--                            <label for="">الرصيد</label>--}}
{{--                            <input wire:model.defer="user.balance" type="number" class="form-control">--}}
{{--                            @error('user.balance')<span class="text-danger error">{{ $message }}</span>@enderror--}}
{{--                        </div>--}}
                        @if(request('role_id') == 4)
                            <div class="form-group">
                                <label for="">الراتب</label>
                                <input wire:model.defer="user.salary" type="number" class="form-control">
                                @error('user.salary')<span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="">المسمى الوظيفي</label>
                            <input wire:model.defer="user.job" type="text" class="form-control">
                            @error('user.job')<span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="">القسم</label>
                            <input wire:model.defer="user.section" type="text" class="form-control">
                            @error('user.section')<span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="">رقم الهوية</label>
                            <input wire:model.defer="user.id_number" type="number" class="form-control">
                            @error('user.id_number')<span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="">اسم البنك</label>
                            <input wire:model.defer="user.bank_name" type="text" class="form-control">
                            @error('user.bank_name')<span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="">رقم الحساب البنكي</label>
                            <input wire:model.defer="user.bank_account_number" type="number" class="form-control">
                            @error('user.bank_account_number')<span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        @if(!request('role_id'))
                            <div class="form-group">
                                <label for="">{{ __('Roles') }}</label>
                                <select wire:model.defer="user.role_id" multiple name="role_id" class="form-control">
                                    <option value="">لا يوجد</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('user.role_id') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        @endif
{{--                        <div class="form-group">--}}
{{--                            <label for="">{{ __('Password') }}</label>--}}
{{--                            <input wire:model.defer="user.password" type="password" class="form-control">--}}
{{--                            @error('user.password')<span class="text-danger error">{{ $message }}</span>@enderror--}}
{{--                        </div>--}}
                        <div class="mt-4">
                            <button wire:loading.attr="disabled" type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
{{--    @endif--}}
</div>
