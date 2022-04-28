<div>
    <div class="row">
        <div class="col-5">
            <livewire:serial-numbers.serial-number-create :key="'serial_number-create-serial-numbers-'"></livewire:serial-numbers.serial-number-create>
        </div>
        {{--        <div class="col-7 text-start">--}}
        {{--            <form>--}}
        {{--                <div class="col-7 text-start d-inline-block">--}}
        {{--                    <input name="search" placeholder="البحث بالاسم أو رمز الصنف أو الرقم التسلسلي أو مكان التواجد" type="text" class="form-control" value="{{ $search }}">--}}
        {{--                </div>--}}
        {{--                <div class="col text-end d-inline-block">--}}
        {{--                    <button type="submit" class="btn btn-success">{{ __('Search') }}</button>--}}
        {{--                </div>--}}
        {{--            </form>--}}
        {{--        </div>--}}
    </div>

    @if($serial_numbers->count())
        <div class="row">
            <div class="table-responsive-sm">
                <table class="table table-striped table-responsive-sm border">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">العنوان</th>
                        <th scope="col" class="text-center">الرقم التسلسلي</th>
                        <th scope="col" class="text-center">الصنف</th>
                        <th scope="col" class="text-center">الحالة</th>
                        <th scope="col" class="text-center">{{ __('Control') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($serial_numbers as $serial_number)
                        <tr>
                            <td class="text-center align-middle">{{ $loop->iteration }}</td>
                            <td class="text-center align-middle"><a href="{{ route('serial-numbers.show', ['serial_number_id' => $serial_number->id]) }}">{{ $serial_number->title }}</a></td>
                            <td class="text-center align-middle">{{ $serial_number->serial }}</td>
                            <td class="text-center align-middle">{{ $serial_number->item ? $serial_number->item->name : '-' }}</td>
                            <td class="text-center align-middle">{{ \App\Models\SerialNumber::statusList($serial_number->status) }}</td>
                            <td class="text-center align-middle">
                                <livewire:serial-numbers.serial-number-edit :serial_number_id="$serial_number->id" :key="'serial-number-edit-serial-numbers-'.$serial_number->id"></livewire:serial-numbers.serial-number-edit>
                                <livewire:serial-numbers.serial-number-delete :serial_number_id="$serial_number->id" :key="'serial-number-delete-serial-numbers-'.$serial_number->id"></livewire:serial-numbers.serial-number-delete>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{ $serial_numbers->links() }}
        </div>
    @else
        <div class="alert text-center alert-danger m-5">{{ __('Empty serial-numbers') }}</div>
    @endif
</div>

