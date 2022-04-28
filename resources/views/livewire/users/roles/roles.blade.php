<div>
{{--    @if(auth()->user()->hasRole('Admin'))--}}
        <livewire:users.roles.role-create :key="'role-create-roles-'"></livewire:users.roles.role-create>

        @if($roles->count())
            <div class="row">
                <table class="table table-striped table-responsive-sm border">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">{{ __('Name') }}</th>
                        <th scope="col" class="text-center">{{ __('Users number') }}</th>
                        <th scope="col" class="text-center">{{ __('Control') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td class="text-center align-middle">{{ $loop->iteration }}</td>
                            <td class="text-center align-middle">{{ $role->name }}</td>
                            <td class="text-center align-middle">{{ $role->users ? $role->users()->count() : '0' }}</td>
                            <td class="text-center align-middle">
                                <livewire:users.roles.role-edit :role_id="$role->id" :key="'role-edit-roles-'.$role->id"></livewire:users.roles.role-edit>
                                <livewire:users.roles.role-delete :role_id="$role->id" :key="'role-delete-roles-'.$role->id"></livewire:users.roles.role-delete>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $roles->links() }}
            </div>
        @else
            <div class="alert alert-danger m-5">{{ __('Empty permissions') }}</div>
        @endif
{{--    @endif--}}
</div>

