<div class="d-inline me-2">
    <button type="button" class="btn btn-sm btn-outline-success px-2 py-1" data-bs-toggle="modal" data-bs-target="#modalFormEditUsersModel">
        <i class="fa fa-user"></i>
    </button>

    <div wire:ignore.self class="modal fade" id="modalFormEditUsersModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">المستخدمين</h5>
                    <button type="button" class="close btn ms-0" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @if($users->count())
                    <div class="row">
                        <div class="table-responsive-sm">
                            <table class="table table-striped table-responsive-sm border">
                                <thead>
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col" class="text-center">{{ __('Name') }}</th>
                                    <th scope="col" class="text-center">{{ __('Email') }}</th>
                                    <th scope="col" class="text-center">{{ __('Mobile') }}</th>
                                    <th scope="col" class="text-center">الرصيد</th>
                                    <th scope="col" class="text-center">{{ __('Roles') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                        <td class="text-center align-middle">
                                            @if($user->name)<a href="{{ route('users.show', ['user_id' => $user->id]) }}">{{ $user->name }}</a>@else - @endif</td>
                                        <td class="text-center align-middle">@if($user->email){{ $user->email }}@else - @endif</td>
                                        <td class="text-center align-middle">@if($user->mobile){{ $user->mobile }}@else - @endif</td>
                                        <td class="text-center align-middle">{{ $user->balance }}</td>
                                        <td class="text-center align-middle">{{ $user->roles->pluck('name')->implode(',') }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $users->links() }}
                    </div>
                @else
                    <div class="alert text-center alert-danger m-5">{{ __('Empty users') }}</div>
                @endif
            </div>
        </div>
    </div>
</div>
