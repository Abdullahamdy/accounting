<div>
{{--    @if(auth()->user()->can('show users'))--}}
        <h4 class="p-3">{{ __('Profile') }} :</h4>
        <div class="row">
            <table class="table table-striped table-responsive-sm border w-50">
                <thead>
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
                    <tr><th scope="col" class="text-center">{{ __('Name') }}</th><td>{{ $user->name }}</td></tr>
                    <tr><th scope="col" class="text-center">{{ __('Email') }}</th><td>{{ $user->email }}</td></tr>
                    <tr><th scope="col" class="text-center">{{ __('Mobile') }}</th><td>{{ $user->mobile }}</td></tr>
                    <tr><th scope="col" class="text-center">العنوان</th><td>{{ $user->address }}</td></tr>
{{--                    <tr><th scope="col" class="text-center">الرصيد</th><td>{{ $user->balance }}</td></tr>--}}
                    @if(request('role_id') == 4)<tr><th scope="col" class="text-center">الراتب</th><td>{{ $user->salary }}</td></tr>@endif
                    <tr><th scope="col" class="text-center">المسمى الوظيفي</th><td>{{ $user->job }}</td></tr>
                    <tr><th scope="col" class="text-center">القسم</th><td>{{ $user->section }}</td></tr>
                    <tr><th scope="col" class="text-center">رقم الهوية</th><td>{{ $user->id_number }}</td></tr>
                    <tr><th scope="col" class="text-center">اسم البنك</th><td>{{ $user->bank_name }}</td></tr>
                    <tr><th scope="col" class="text-center">رقم الحساب البنكي</th><td>{{ $user->bank_account_number }}</td></tr>
                    <tr><th scope="col" class="text-center">  الحساب الكلي</th><td>{{ $total }}</td></tr>
                    <tr><th scope="col" class="text-center"> الخصم</th><td>{{ $discount }}</td></tr>

                    <tr><th scope="col" class="text-center">المدفوع</th><td>{{ $arrest }}</td></tr>
                    <tr><th scope="col" class="text-center">الرصيد</th><td>{{ $total-($arrest + $discount) }}</td></tr>
{{--                    <tr><th scope="col" class="text-center">{{ __('Roles') }}</th><td>{{ $user->roles->pluck('name')->implode(',') }}</td></tr>--}}
                    <tr>
                        <th scope="col" class="text-center">{{ __('Control') }}</th>
                        <td>
                            <livewire:users.user-edit :user_id="$user->id" :key="'user-edit-user-show-'.$user->id"></livewire:users.user-edit>
                            <livewire:users.user-delete :user_id="$user->id" :key="'user-delete-user-show-'.$user->id"></livewire:users.user-delete>
                        </td>
                    </tr>
                </thead>
            </table>
        </div>
{{--    @endif--}}
</div>
