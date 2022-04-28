<div class="d-inline">
{{--    @if(auth()->user()->can('delete users'))--}}
        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target=".modalFormDeleteUser{{$user->id}}">
            <i class="fa fa-trash"></i>
        </button>
        <div wire:ignore.self class="modal fade modalFormDeleteUser{{$user->id}}" id="" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ __('Users') }}</h5>
                        <button type="button" class="close btn ms-0" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>{{ __('Do you want to continue deleting this user ?') }}</p>
                        <div class="mt-4">
                            <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn btn-primary">{{ __('Cancel') }}</button>
                            <button type="button" wire:click.prevent="delete" class="btn btn-danger">{{ __('Yes') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
{{--    @endif--}}
</div>

