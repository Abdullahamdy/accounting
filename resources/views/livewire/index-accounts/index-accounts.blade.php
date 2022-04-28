<div>
    <div class="row">
        <div class="col-5">
            <livewire:index-accounts.index-account-create :key="'index-account-create-index-accounts-'"></livewire:index-accounts.index-account-create>
        </div>
        <div class="col-7 text-start">
            <form>
                <div class="col-3 text-start d-inline-block">
                    <input name="search" placeholder="البحث بالرقم أو الاسم" type="text" class="form-control" value="{{ $search }}">
                </div>
                <div class="col-2 text-start d-inline-block">
                    <select class="form-control" name="index_account_id">
                        <option value="">كل التوابع</option>
                        @foreach($index_accounts_filter as $index_account)
                            <option value="{{ $index_account->id }}" {{ $index_account_id == $index_account->id ? 'selected' : '' }}>{{ $index_account->account_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-2 text-start d-inline-block">
                    <select class="form-control" name="basic" wire:model.defer="basic">
                        <option value="">كل الأساسي</option>
                        @foreach(\App\Models\IndexAccount::basicList(false) as $key => $basic)
                            <option value="{{ $key }}" {{ request('basic') == $key ? 'selected' : '' }}>{{ $basic }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-2 text-start d-inline-block">
                    <select class="form-control" name="account_guide_id">
                        <option value="">كل الدلائل</option>
                        @foreach($account_guides as $account_guide)
                            <option value="{{ $account_guide->id }}" {{ $account_guide_id == $account_guide->id ? 'selected' : '' }}>{{ $account_guide->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col text-end d-inline-block">
                    <button type="submit" class="btn btn-success">{{ __('Search') }}</button>
                </div>
            </form>
        </div>
    </div>
    {{-- @php
        $price = 0 ;
    @endphp
   @foreach($invoices_all->where('type',0) as $invoice)
   @foreach($invoice->invoice_items as $sellinginvoice)
   @php
   $price = $price + ($sellinginvoice->purchasing_price)
   @endphp

   @endforeach
   @endforeach --}}
 
    @if($index_accounts->count())
        <div class="row">
            <div class="table-responsive-sm">
                <table class="table table-striped table-responsive-sm border">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">رقم الحساب</th>
                        <th scope="col" class="text-center">اسم الحساب</th>
                        <th scope="col" class="text-center">تابع لحساب</th>
                        <th scope="col" class="text-center">أساسي</th>
                        <th scope="col" class="text-center">القائمة المالية</th>
                        <th scope="col" class="text-center">رصيد الحساب</th>
                        <th scope="col" class="text-center">{{ __('Control') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($index_accounts as $index_account)
                    {{-- @foreach($index_account->invoice_items as $index_accountitem) --}}
                    
                    

                        <tr>
                            <td class="text-center align-middle">{{ $loop->iteration }}</td>
                            <td class="text-center align-middle"><a href="{{ route('index-accounts.show', ['index_account_id' => $index_account->id]) }}">{{ $index_account->account_number }}</a></td>
                            <td class="text-center align-middle"><a href="{{ route('index-accounts.show', ['index_account_id' => $index_account->id]) }}">{{ $index_account->account_name }}</a></td>
                            <td class="text-center align-middle">@if($index_account->parent)<a href="{{ route('index-accounts.show', ['index_account_id' => $index_account->parent->id]) }}">{{ $index_account->parent->account_name }}</a>@else - @endif</td>
                            <td class="text-center align-middle">{{ \App\Models\IndexAccount::basicList($index_account->basic) }}</td>
                            <td class="text-center align-middle">@if($index_account->account_guide)<a href="{{ route('account-guides.show', ['account_guide_id' => $index_account->account_guide ? $index_account->account_guide->id : '']) }}">{{ $index_account->account_guide ? $index_account->account_guide->title : '' }}</a>@else - @endif</td>
                            <td class="text-center align-middle">{{ $index_account->total_price }} </td>
                            
                            <td class="text-center align-middle">
                                <livewire:index-accounts.index-account-edit :index_account_id="$index_account->id" :key="'index-account-edit-index-accounts-'.$index_account->id"></livewire:index-accounts.index-account-edit>
                                <livewire:index-accounts.index-account-delete :index_account_id="$index_account->id" :key="'index-account-delete-index-accounts-'.$index_account->id"></livewire:index-accounts.index-account-delete>
                            </td>
                        </tr>
                    @endforeach
                    {{-- @endforeach --}}
                    </tbody>
                </table>
            </div>
            {{ $index_accounts->links() }}
        </div>
    @else
        <div class="alert text-center alert-danger m-5">{{ __('Empty index accounts') }}</div>
    @endif
    {{--    @endif--}}
</div>

