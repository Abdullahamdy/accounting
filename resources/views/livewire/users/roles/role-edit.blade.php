<div class="d-inline">
    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target=".modalFormEditRole{{$role['id']}}">
        <i class="fa fa-edit"></i>
    </button>

    <div wire:ignore.self class="modal fade modalFormEditRole{{$role['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Roles') }}</h5>
                    <button type="button" class="close btn ms-0" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="update" class="modal-body">
                    <div class="form-group">
                        <label for="">{{ __('Name') }}</label>
                        <input wire:model.defer="role.name" type="text" class="form-control">
                        @error('role.name')<span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Permissions') }}</label>
                        <div class="row">
                            @if($permissions)
                                @foreach($permissions as $permission)
                                    <div class="col-md-6">
                                        <label><input type="checkbox" value="{{$permission->id}}" wire:model.defer="user_permissions.{{$permission->id}}"> {{$permission->name}}</label>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-md-12">
                                    <div class="alert alert-danger">{{ __('Empty permissions') }}</div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="mt-4">
                        <button wire:loading.attr="disabled" type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
