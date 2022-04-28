<div>
    @if($settings->count() == 0)
        <livewire:settings.setting-create :key="'setting-create-settings-'"></livewire:settings.setting-create>
    @endif

    @if($settings->count())
        <div class="row">
            <div class="table-responsive-sm">
                <table class="table table-striped table-responsive-sm border">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">اسم الشركة</th>
                        <th scope="col" class="text-center">شعار الشركة</th>
                        <th scope="col" class="text-center">هاتف الشركة</th>
                        <th scope="col" class="text-center">بريد الشركة</th>
                        <th scope="col" class="text-center">عنوان الشركة</th>
                        <th scope="col" class="text-center">حساب  المبيعات</th>
                        <th scope="col" class="text-center">حساب  المشتريات</th>
                        <th scope="col" class="text-center">حساب الصندوق </th>
                        <th scope="col" class="text-center">حساب الزبائن </th>
                        <th scope="col" class="text-center">حساب الموظفين </th>
                          <th scope="col" class="text-center">مدير الشركة</th>
                        <th scope="col" class="text-center">وصف الشركة</th>
                        <th scope="col" class="text-center">{{ __('Control') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($settings as $setting)
                        <tr>
                            <td class="text-center align-middle">{{ $loop->iteration }}</td>
                            <td class="text-center align-middle"><a href="{{ route('settings.show', ['setting_id' => $setting->id]) }}">{{ $setting->company_name }}</a></td>
                            <td class="text-center align-middle">
                                @if($image = $setting->attachments()->orderBy('id',"DESC")->first())
                                    <a href="{{ route('settings.show', ['setting_id' => $setting->id]) }}">
                                        <img class="rounded border" width="70px" height="60px" alt="{{ $setting->company_name }}"
                                             src="{{ url('storage/'.$image->path) }}" title="{{ $setting->company_name }}">
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="text-center align-middle">@if($setting->company_phone){{ $setting->company_phone }}@else - @endif</td>
                            <td class="text-center align-middle">@if($setting->company_email){{ $setting->company_email }}@else - @endif</td>
                            <td class="text-center align-middle">@if($setting->company_address){{ $setting->company_address }}@else - @endif</td>

                            <td class="text-center align-middle">@if($setting->inbox_account_index){{ $setting->payment_selling_account_index->account_name }}@else - @endif</td>
                            <td class="text-center align-middle">@if($setting->inbox_account_index){{ $setting->payment_parchasing_account_index->account_name }}@else - @endif</td>
                            <td class="text-center align-middle">@if($setting->inbox_account_index){{ $setting->inbox_account_index->account_name }}@else - @endif</td>
                            <td class="text-center align-middle">@if($setting->inbox_account_index){{ $setting->customers_account_index->account_name }}@else - @endif</td>
                            <td class="text-center align-middle">@if($setting->inbox_account_index){{ $setting->salary_account_index->account_name }}@else - @endif</td>
                            <td class="text-center align-middle">@if($setting->company_manager){{ $setting->company_manager }}@else - @endif</td>
                            <td class="text-center align-middle">@if($setting->company_description)<a href="{{ route('settings.show', ['setting_id' => $setting->id]) }}">{{ $setting->company_description }}</a>@else - @endif</td>
                            <td class="text-center align-middle">
                                <livewire:settings.setting-edit :setting_id="$setting->id" :key="'setting-edit-settings-'.$setting->id"></livewire:settings.setting-edit>
                                <livewire:settings.setting-delete :setting_id="$setting->id" :key="'setting-delete-settings-'.$setting->id"></livewire:settings.setting-delete>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="alert text-center alert-danger m-5">{{ __('Empty settings') }}</div>
    @endif
</div>

