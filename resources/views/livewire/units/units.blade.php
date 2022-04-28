<div>
    <div class="row">
        <div class="col-5">
            <livewire:units.unit-create :key="'unit-create-units-'"></livewire:units.unit-create>
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

    @if($units->count())
        <div class="row">
            <div class="table-responsive-sm">
                <table class="table table-striped table-responsive-sm border">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">الاسم</th>
                        <th scope="col" class="text-center">عدد القطع</th>
                        <th scope="col" class="text-center">وحدة القياس</th>
                        <th scope="col" class="text-center">سعر البيع</th>
                        <th scope="col" class="text-center">سعر الشراء</th>
                        <th scope="col" class="text-center">تابع </th>
                        <th scope="col" class="text-center">{{ __('Control') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($units as $unit)
                        <tr>
                            <td class="text-center align-middle">{{ $loop->iteration }}</td>
                            <td class="text-center align-middle"><a href="{{ route('units.show', ['unit_id' => $unit->id]) }}">{{ $unit->name }}</a></td>
                            <td class="text-center align-middle">{{ $unit->pieces }}</td>
                            <td class="text-center align-middle">{{ $unit->measruing_unit }}</td>
                            <td class="text-center align-middle">{{ $unit->selling_price }}</td>
                            <td class="text-center align-middle">{{ $unit->purchasing_price }}</td>
                            <td class="text-center align-middle">{{ $unit->item ? $unit->item->name : "غير محدد" }}</td>
                            <td class="text-center align-middle">
                                <livewire:units.unit-edit :unit_id="$unit->id" :key="'unit-edit-units-'.$unit->id"></livewire:units.unit-edit>
                                <livewire:units.unit-delete :unit_id="$unit->id" :key="'unit-delete-units-'.$unit->id"></livewire:units.unit-delete>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{ $units->links() }}
        </div>
    @else
        <div class="alert text-center alert-danger m-5">{{ __('Empty units') }}</div>
    @endif
</div>

