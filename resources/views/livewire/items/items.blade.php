<div>
    <div class="row">
        <div class="col-5">
            <livewire:items.item-create :key="'item-create-items-'"></livewire:items.item-create>

            <a href="{{ route('categories') }}" class="btn btn-info  mb-3">
                <i class="fas fa-list ml-1 h6"></i> الأقسام
            </a>
        </div>


        <div class="col-7 text-start">
            <form>
                <div class="col-7 text-start d-inline-block">
                    <input name="search" placeholder="البحث بالاسم أو رمز الصنف أو الرقم التسلسلي أو مكان التواجد" type="text" class="form-control" value="{{ $search }}">
                </div>
                <div class="col text-end d-inline-block">
                    <button type="submit" class="btn btn-success">{{ __('Search') }}</button>
                </div>
            </form>
        </div>
    </div>

    @if($items->count())
        <div class="row">
            <div class="table-responsive-sm">
                <table class="table table-striped table-responsive-sm border">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">الاسم</th>
                        <th scope="col" class="text-center">الصورة</th>
                        <th scope="col" class="text-center">القسم</th>
                        <th scope="col" class="text-center">الوحدة</th>

                        <th scope="col" class="text-center">رمز الصنف</th>
                        <th scope="col" class="text-center">رقم تسلسلي</th>
                        <th scope="col" class="text-center">مكان التواجد</th>
                        <th scope="col" class="text-center">متعدد السيريال</th>
                        <th scope="col" class="text-center">{{ __('Control') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td class="text-center align-middle">{{ $loop->iteration }}</td>
                            <td class="text-center align-middle"><a href="{{ route('items.show', ['item_id' => $item->id]) }}">{{ $item->name }}</a></td>
                            <td class="text-center align-middle">
                                @if($image = $item->attachments()->orderBy('id',"DESC")->first())
                                    <a href="{{ route('items.show', ['item_id' => $item->id]) }}">
                                        <img class="rounded border" width="70px" height="60px" alt="{{ $item->name }}"
                                                 src="{{ url('storage/'.$image->path) }}" title="{{ $item->name }}">
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="text-center align-middle">{{ $item->category ? $item->category->name : '-' }}</td>
                            <td class="text-center align-middle"> @foreach($item->unit_item as $ite)
                                {{$ite->unit->name }}


                                @endforeach

                             </td>
                            {{-- <td class="text-center align-middle">{{ \App\Models\Item::unitList($item->unit) }}</td> --}}
                            <td class="text-center align-middle">@if($item->item_number){{ $item->item_number }}@else - @endif</td>
                            <td class="text-center align-middle">
                                @if($item->serial_numbers->count())
                                    @foreach($item->serial_numbers as $serial_number)
                                        <li class="text-end me-5">{{ $serial_number->serial }}</li>
                                    @endforeach
                                @else
                                    -
                                @endif
                            </td>
                            <td class="text-center align-middle">@if($item->place){{ $item->place }}@else - @endif</td>
                            <td class="text-center align-middle">@if($item->serial_multi == 0) لا @else نعم @endif</td>
                            <td class="text-center align-middle">
                                <livewire:units.unit-create :item_id="$item->id" :key="'unitsss-unitss-create-'.$item->id"></livewire:units.unit-create>
                                <livewire:items.item-edit :item_id="$item->id" :key="'item-edit-items-'.$item->id"></livewire:items.item-edit>
                                <livewire:items.item-delete :item_id="$item->id" :key="'item-delete-items-'.$item->id"></livewire:items.item-delete>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{ $items->links() }}
        </div>
    @else
        <div class="alert text-center alert-danger m-5">{{ __('Empty items') }}</div>
    @endif
</div>

