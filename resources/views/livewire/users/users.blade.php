<div>
    <div class="row">
        <div class="col-5">
            <livewire:users.user-create :key="'user-create-users-'"></livewire:users.user-create>
        </div>
        <div class="col-7 text-start">
            <form>
                <div class="col-5 text-start d-inline-block">
                    <input name="search" placeholder="البحث بالاسم أو البريد أو الهاتف" type="text" class="form-control" value="{{ $search }}">
                </div>
{{--                <div class="col-5 text-start d-inline-block">--}}
{{--                    <select class="form-control" name="role_id">--}}
{{--                        <option value="">كل الصلاحيات</option>--}}
{{--                        @foreach($roles as $role)--}}
{{--                            <option value="{{ $role->id }}" {{ $role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </div>--}}
                <div class="col text-end d-inline-block">
                    <button type="submit" class="btn btn-success">{{ __('Search') }}</button>
                </div>
            </form>
        </div>
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
                        @if(request('role_id') == 4)<th scope="col" class="text-center">الراتب</th>@endif
{{--                        <th scope="col" class="text-center">العنوان</th>--}}
{{--                        <th scope="col" class="text-center">الرصيد</th>--}}
{{--                        <th scope="col" class="text-center">المسمى الوظيفي</th>--}}
{{--                        <th scope="col" class="text-center">القسم</th>--}}
{{--                        <th scope="col" class="text-center">رقم الهوية</th>--}}
{{--                        <th scope="col" class="text-center">اسم البنك</th>--}}
{{--                        <th scope="col" class="text-center">رقم الحساب البنكي</th>--}}
{{--                        <th scope="col" class="text-center">{{ __('Roles') }}</th>--}}
                        @if(auth()->user()->hasRole('Admin'))
                        <th scope="col" class="text-center">{{ __('Control') }}</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>





                    @foreach($users as $user)

                    @php
                        $arrest = 0
                    @endphp
                    @foreach($user->arrest_receipts as $use)
                    @php
                    $arrest = $arrest + $use->batch_quantity;
                    @endphp
                    @endforeach
                    @php
                    $total = 0;
                    $discount = 0 ;
                    foreach($user->invoice_items as $item){



                        $total = $total + ($item->quantity *  $item->unit->selling_price);

                    }
                    foreach($user->invoice_discounts as $get_descount){
                       $discount = $discount + ($get_descount->discount_quantity);


                    }

                    @endphp




                        <tr>
                            <td class="text-center align-middle">{{ $loop->iteration }}</td>
                            <td class="text-center align-middle">@if($user->name)<a href="{{ route('users.show', ['user_id' => $user->id]) }}">{{ $user->name }}</a>@else - @endif</td>
                            <td class="text-center align-middle">@if($user->email){{ $user->email }}@else - @endif</td>
                            <td class="text-center align-middle">@if($user->mobile){{ $user->mobile }}@else - @endif</td>
                            <td class="text-center align-middle">{{ $total-($arrest + $discount) }}</td>

                            @if(request('role_id') == 4)<td class="text-center align-middle">{{ $user->salary }}</td>@endif
{{--                            <td class="text-center align-middle">{{ $user->balance }}</td>--}}
{{--                            <td class="text-center align-middle">{{ $user->address }}</td>--}}
{{--                            <td class="text-center align-middle">{{ $user->job }}</td>--}}
{{--                            <td class="text-center align-middle">{{ $user->section }}</td>--}}
{{--                            <td class="text-center align-middle">{{ $user->id_number }}</td>--}}
{{--                            <td class="text-center align-middle">{{ $user->bank_name }}</td>--}}
{{--                            <td class="text-center align-middle">{{ $user->bank_account_number }}</td>--}}
{{--                            <td class="text-center align-middle">{{ $user->roles->pluck('name')->implode(',') }}</td>--}}
                            @if(auth()->user()->hasRole('Admin'))
                            <td class="text-center align-middle">
                                <livewire:users.user-edit :user_id="$user->id" :key="'user-edit-users-'.$user->id"></livewire:users.user-edit>
                                <livewire:users.user-delete :user_id="$user->id" :key="'user-delete-users-'.$user->id"></livewire:users.user-delete>
                            </td>
                            @endif
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
{{--    @endif--}}
</div>

