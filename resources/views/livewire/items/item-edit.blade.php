<div class="d-inline">
    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target=".modalFormEditItem{{$item['id']}}">
        <i class="fa fa-edit"></i>
    </button>

    <div wire:ignore.self class="modal fade modalFormEditItem{{$item['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">الأصناف</h5>
                    <button type="button" class="close btn ms-0" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="update" class="modal-body">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                          <button class="nav-link active" id="nav-homeEdit{{$item['id']}}-tab" data-bs-toggle="tab" data-bs-target="#nav-homeEdit{{$item['id']}}" type="button" role="tab" aria-controls="nav-home" aria-selected="true">البيانات الأساسيه</button>
                          <button class="nav-link" id="nav-profileEdit{{$item['id']}}-tab" data-bs-toggle="tab" data-bs-target="#nav-profileEdit{{$item['id']}}" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">البيانات الفرعيه</button>
                          {{-- <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</button> --}}
                        </div>
                      </nav>
                      <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-homeEdit{{$item['id']}}" role="tabpanel" aria-labelledby="nav-homeEdit{{$item['id']}}-tab">
                    <div class="form-group">
                        <label for="">الاسم</label>
                        <input wire:model.defer="item.name" type="text" class="form-control">
                        @error('item.name')<span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="">الصورة</label>
                        <input wire:model.defer="item.path" type="file" class="form-control"/>
                        @error('item.path') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="">وحدة القياس</label>
                        <select wire:model.defer="item.unit" name="unit" class="form-control">
                            @foreach(\App\Models\Item::unitList() as $key => $unit)
                                <option value="{{ $key }}">{{ $unit }}</option>
                            @endforeach
                        </select>
                        @error('item.unit') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="">رمز الصنف</label>
                        <input wire:model.defer="item.item_number" type="text" class="form-control">
                        @error('item.item_number')<span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
{{--                    <div class="form-group">--}}
{{--                        <label for="">رقم تسلسلي</label>--}}
{{--                        <input wire:model.defer="item.serial_number" type="text" class="form-control">--}}
{{--                        @error('item.serial_number')<span class="text-danger error">{{ $message }}</span>@enderror--}}
{{--                    </div>--}}


                    <div class="form-group">
                        <label for="">مكان التواجد</label>
                        <input wire:model.defer="item.place" type="text" class="form-control">
                        @error('item.place')<span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
                    <div class="tab-pane fade" id="nav-profileEdit{{$item['id']}}" role="tabpanel" aria-labelledby="nav-profileEdit{{$item['id']}}-tab">
                    <div class="form-group">
                        <label for="">القسم</label>
                        <select wire:model.defer="item.category_id" name="category_id" class="form-control">
                            <option value="">{{ __('Nothing') }}</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('item.category_id') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    {{-- <div class="form-group">
                        <label for="">الوحدة</label>
                        <select wire:model.defer="unitsele" name="unit_id" class="form-control" multiple>
                            <option value="">{{ __('Nothing') }}</option>
                            @foreach($unititems as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                            @endforeach
                        </select>
                        @error('item.unit_id') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div> --}}
                    <div class="form-check">
                        <input wire:model.defer="item.serial_multi" class="form-check-input" type="checkbox"id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            متعدد السيريال
                        </label>
                        @error('item.serial_multi') <span class="text-danger error">{{ $message }}</span>@enderror
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
