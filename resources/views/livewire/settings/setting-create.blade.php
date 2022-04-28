<div class="d-inline">
    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalFormSetting">
        انشاء اعداد
    </button>

    <div wire:ignore.self class="modal fade" id="modalFormSetting" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">الاعدادات</h5>
                    <button type="button" class="close btn ms-0" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="store" class="modal-body">

                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                          <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">البيانات الأساسيه</button>
                          <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">البيانات الفرعيه</button>
                          <button class="nav-link" id="nav-discount-tab" data-bs-toggle="tab" data-bs-target="#nav-discount" type="button" role="tab" aria-controls="nav-discount" aria-selected="false">باقي البيانات</button>
                        </div>
                      </nav>

                      <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                          <div class="form-group">
                        <label for="">اسم الشركة</label>
                        <input wire:model.defer="setting.company_name" type="text" class="form-control">
                        @error('setting.company_name')<span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="">شعار الشركة</label>
                        <input wire:model.defer="setting.path" type="file" class="form-control"/>
                        @error('setting.path') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="">هاتف الشركة</label>
                        <input wire:model.defer="setting.company_phone" type="number" class="form-control">
                        @error('setting.company_phone')<span class="text-danger error">{{ $message }}</span>@enderror
                    </div>


                    <div class="form-group col-12 mt-3">
                             <label for="">حساب المبيعات</label>
                              <select wire:model.defer="setting.payment_selling_account_index_id" name="index_account_id" class="form-control">
                                                        <option value="">{{ __('Nothing') }}</option>
                               @foreach($index_accounts as $index_account)
                                     <option value="{{ $index_account->id }}">{{ $index_account->account_name }}</option>
                                   @endforeach
                              </select>
                          @error('setting.payment_selling_account_index_id') <span class="text-danger error">{{ $message }}</span>@enderror
                     </div>

                     <div class="form-group col-12 mt-3">
                        <label for="">حساب المشتريات</label>
                         <select wire:model.defer="setting.payment_parchasing_account_index_id" name="index_account_id" class="form-control">
                                                   <option value="">{{ __('Nothing') }}</option>
                          @foreach($index_accounts as $index_account)
                                <option value="{{ $index_account->id }}">{{ $index_account->account_name }}</option>
                              @endforeach
                         </select>
                     @error('setting.payment_parchasing_account_index_id') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>



                    </div>
                    {{-- end tab 1  --}}
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
        
                <div class="form-group col-12 mt-3">
                    <label for="">حساب الصندوق</label>
                     <select wire:model.defer="setting.inbox_account_index_id" name="index_account_id" class="form-control">
                                               <option value="">{{ __('Nothing') }}</option>
                      @foreach($index_accounts as $index_account)
                            <option value="{{ $index_account->id }}">{{ $index_account->account_name }}</option>
                          @endforeach
                     </select>
                 @error('setting.inbox_account_index_id') <span class="text-danger error">{{ $message }}</span>@enderror
            </div>
      
      
            <div class="form-group col-12 mt-3">
                <label for="">حساب الموظفين</label>
                 <select wire:model.defer="setting.salary_account_index_id" name="index_account_id" class="form-control">
                                           <option value="">{{ __('Nothing') }}</option>
                  @foreach($index_accounts as $index_account)
                        <option value="{{ $index_account->id }}">{{ $index_account->account_name }}</option>
                      @endforeach
                 </select>
             @error('setting.salary_account_index_id') <span class="text-danger error">{{ $message }}</span>@enderror
        </div>
        <div class="form-group col-12 mt-3">
            <label for="">حساب الزبائن</label>
             <select wire:model.defer="setting.customers_account_index_id" name="index_account_id" class="form-control">
                                       <option value="">{{ __('Nothing') }}</option>
              @foreach($index_accounts as $index_account)
                    <option value="{{ $index_account->id }}">{{ $index_account->account_name }}</option>
                  @endforeach
             </select>
          @error('setting.customers_account_index_id') <span class="text-danger error">{{ $message }}</span>@enderror
        </div>

        <div class="form-group col-12 mt-3">
            <label for="">الخصم المكتسب </label>
             <select wire:model.defer="setting.discount_earned_account_index_id" name="index_account_id" class="form-control">
                                       <option value="">{{ __('Nothing') }}</option>
              @foreach($index_accounts as $index_account)
                    <option value="{{ $index_account->id }}">{{ $index_account->account_name }}</option>
                  @endforeach
             </select>
         @error('setting.discount_earned_account_index_id') <span class="text-danger error">{{ $message }}</span>@enderror
    </div>

    </div>
    {{-- end tab 2 --}}

    <div class="tab-pane fade" id="nav-discount" role="tabpanel" aria-labelledby="nav-discount-tab">

  
    <div class="form-group col-12 mt-3">
        <label for="">الخصم المسموح بة</label>
         <select wire:model.defer="setting.allowed_discount_account_index_id" name="index_account_id" class="form-control">
                                   <option value="">{{ __('Nothing') }}</option>
          @foreach($index_accounts as $index_account)
                <option value="{{ $index_account->id }}">{{ $index_account->account_name }}</option>
              @endforeach
         </select>
      @error('setting.allowed_discount_account_index_id') <span class="text-danger error">{{ $message }}</span>@enderror
    </div>


                    <div class="form-group">
                        <label for="">بريد الشركة</label>
                        <input wire:model.defer="setting.company_email" type="email" class="form-control">
                        @error('setting.company_email')<span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="">عنوان الشركة</label>
                        <input wire:model.defer="setting.company_address" type="text" class="form-control">
                        @error('setting.company_address')<span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="">مدير الشركة</label>
                        <input wire:model.defer="setting.company_manager" type="text" class="form-control">
                        @error('setting.company_manager')<span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="">وصف الشركة</label>
                        <input wire:model.defer="setting.company_description" type="text" class="form-control">
                        @error('setting.company_description')<span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
          
                    <div class="mt-4">
                        <button wire:loading.attr="disabled" type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
