<div>
    <livewire:invoice-items.invoice-item-create :invoice_id="$invoice->id" :key="'invoice-item-create-invoice-items-'. $invoice->id"></livewire:invoice-items.invoice-item-create>

    @if($invoice_items->count())

        <div class="row">

            <style>
                body{
            margin-top:20px;
            color: #484b51;
            }
            .text-secondary-d1 {
            color: #728299!important;
            }
            .page-header {
            margin: 0 0 1rem;
            padding-bottom: 1rem;
            padding-top: .5rem;
            border-bottom: 1px dotted #e2e2e2;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-pack: justify;
            justify-content: space-between;
            -ms-flex-align: center;
            align-items: center;
            }
            .page-title {
            padding: 0;
            margin: 0;
            font-size: 1.75rem;
            font-weight: 300;
            }
            .brc-default-l1 {
            border-color: #dce9f0!important;
            }

            .ml-n1, .mx-n1 {
            margin-left: -.25rem!important;
            }
            .mr-n1, .mx-n1 {
            margin-right: -.25rem!important;
            }
            .mb-4, .my-4 {
            margin-bottom: 1.5rem!important;
            }

            hr {
            margin-top: 1rem;
            margin-bottom: 1rem;
            border: 0;
            border-top: 1px solid rgba(0,0,0,.1);
            }

            .text-grey-m2 {
            color: #888a8d!important;
            }

            .text-success-m2 {
            color: #86bd68!important;
            }

            .font-bolder, .text-600 {
            font-weight: 600!important;
            }

            .text-110 {
            font-size: 110%!important;
            }
            .text-blue {
            color: #478fcc!important;
            }
            .pb-25, .py-25 {
            padding-bottom: .75rem!important;
            }

            .pt-25, .py-25 {
            padding-top: .75rem!important;
            }
            .bgc-default-tp1 {
            background-color: rgba(121,169,197,.92)!important;
            }
            .bgc-default-l4, .bgc-h-default-l4:hover {
            background-color: #f3f8fa!important;
            }
            .page-header .page-tools {
            -ms-flex-item-align: end;
            align-self: flex-end;
            }

            .btn-light {
            color: #757984;
            background-color: #f5f6f9;
            border-color: #dddfe4;
            }
            .w-2 {
            width: 1rem;
            }

            .text-120 {
            font-size: 120%!important;
            }
            .text-primary-m1 {
            color: #4087d4!important;
            }

            .text-danger-m1 {
            color: #dd4949!important;
            }
            .text-blue-m2 {
            color: #68a3d5!important;
            }
            .text-150 {
            font-size: 150%!important;
            }
            .text-60 {
            font-size: 60%!important;
            }
            .text-grey-m1 {
            color: #7b7d81!important;
            }
            .align-bottom {
            vertical-align: bottom!important;
            }

            </style>



            <div class="page-content container">
            <div class="page-header text-blue-d2">
                <h1 class="page-title text-secondary-d1">
                    Invoice
                    <small class="page-info">
                        <i class="fa fa-angle-double-right text-80"></i>
                        ID: #{{$invoice->invoice_number}}
                    </small>
                </h1>


            </div>

            <div class="container px-0">
                <div class="row mt-4">
                    <div class="col-12 col-lg-12">

                        <!-- .row -->
                        <hr class="row brc-default-l1 mx-n1 mb-4" />

                        <div class="row">
                            <div class="col-sm-6">
                                <div>
                                    <span class="text-sm text-grey-m2 align-middle">اسم التاجر:{{ $invoice->user ? $invoice->user->name : '' }}</span>

                                </div>

                            </div>
                            <!-- /.col -->

                            <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                                <hr class="d-sm-none" />
                                <div class="text-grey-m2">
                                    <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                        الفاتورة
                                    </div>

                                    <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">رقم الفاتوره:</span> {{$invoice->invoice_number}}</div>

                                    <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90"> تاريخ الفاتورة:</span>@if($invoice->invoice_date != null){{ $invoice->invoice_date }}@else - @endif</div>


                                </div>
                            </div>
                            <!-- /.col -->
                        </div>

                        <div class="mt-4">
                            <div class="row text-600 text-white bgc-default-tp1 py-25">

                                <div class="d-none d-sm-block col-1">رقم الصنف</div>
                                <div class="col-4 col-sm-5">اسم الصنف</div>
                                <div class="d-none d-sm-block col-sm-2"> الكمية </div>
                                @if($invoice->type == 1)
                                <div class="d-none d-sm-block col-sm-2">سعر الشراء </div>
                                @else
                                <div class="d-none d-sm-block col-sm-2">سعر البيع </div>
                                @endif

                                {{-- @if($invoice->type == 1)
                                <div class="d-none d-sm-block col-sm-2">وحده الشراء </div>
                                @else
                                <div class="d-none d-sm-block col-sm-2">وحده  البيع </div>
                                @endif --}}


                                @if($invoice->type == 1)
                                <div class="col-2">اجمالي الشراء</div>
                                @else
                                <div class="col-2">اجمالي البيع</div>
                                @endif


                            </div>

                            <div class="text-95 text-secondary-d3">

                                 @php
                                 $alldesc = 0;
                                 foreach($invoice->invoice_discounts as $discou){
                                         $alldesc = $alldesc + ($discou->discount_quantity);}
                                          $arrestval = 0;

                                 foreach($invoice->arrest_receipts as $resept){
                                         $arrestval = $arrestval + ($resept->batch_quantity);}


                                $total = 0;

                            @endphp
                            @foreach($invoice_items as $invoice_item)
                                @php







                                    if ($invoice->type == 1){

                                        $total = $total + ($invoice_item->unit->purchasing_price * $invoice_item->quantity);

                                    }
                                    else {
                                        $total = $total + ($invoice_item->unit->selling_price * $invoice_item->quantity);
                                    }




                                @endphp

                                <div class="row mb-2 mb-sm-0 py-25 bgc-default-l4">
                                    <div class="d-none d-sm-block col-1"><a href="{{ route('items.show', ['item_id' => $invoice_item->item_id]) }}">{{ $invoice_item->item_id }}</a></div>
                                    <div class="col-9 col-sm-5">{{ $invoice_item->item_name }}</div>

                                    <div class="d-none d-sm-block col-2 text-95">{{ $invoice_item->quantity }}</div>

                                    @if($invoice->type == 1)
                                    <div class="d-none d-sm-block col-2">{{ $invoice_item->unit->purchasing_price }}</div>
                                    @else

                                    <div class="d-none d-sm-block col-2">{{ $invoice_item->unit->selling_price }}</div>

                                    @endif

                                    {{-- @if($invoice->type == 1)
                                    <div class="d-none d-sm-block col-2">{{ $invoice_item->unit->name }}</div>

                                    @endif --}}
                                    @if($invoice->type == 1)
                                    <div class="d-none d-sm-block col-2 text-95">{{ $invoice_item->unit->purchasing_price * $invoice_item->quantity }}</div>
                                    @else
                                    <div class="d-none d-sm-block col-2 text-95">{{ $invoice_item->unit->selling_price * $invoice_item->quantity }}</div>

                                    @endif


                                </div>

                                @endforeach
                                <div class="row mb-2 mb-sm-0 py-25 bgc-default-l4">



                                </div>

                            </div>

                            <div class="row border-b-2 brc-default-l2"></div>


                            <div class="row mt-3">
                                <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">

                                </div>

                                <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">
                                    <div class="row my-2">
                                        <div class="col-7 text-right">
                                            السعر الكلي
                                        </div>
                                        <div class="col-5">
                                            <span class="text-120 text-secondary-d1">{{$total}}</span>
                                        </div>
                                    </div>

                                    <div class="row my-2" >
                                        <div class="col-7 text-right  mb-7 text-center">
                                            <span style="margin: 10px auto;  !important">
                                            الخصم
                                            </span>
                                        </div>
                                        <div class="col-5">
                                            <livewire:invoice-discounts.invoice-discount-create :invoice_id="$invoice->id" :key="'invoice-discount-create-invoice-discounts-'. $invoice->id"></livewire:invoice-discounts.invoice-discount-create>
                                        </div>

                                    </div>


                                    <div class="row my-2">
                                        <div class="col-7 text-right">
                                            المد فوعات
                                        </div>
                                        <div class="col-5">
                                            <livewire:arrest-receipts.arrest-receipt-create :invoice_id="$invoice->id" :key="'arrest-receipt-create-arrest-receipts-'"></livewire:arrest-receipts.arrest-receipt-create>
                                        </div>

                                    </div>


                                    <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                        <div class="col-7 text-right">
                                           السعر النهائي
                                        </div>
                                        <div class="col-5">


                                            <span class="text-150 text-success-d3 opacity-2">{{$total - ($alldesc +$arrestval)}}</span>



                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr />


                        </div>
                    </div>
                </div>
            </div>
            </div>
            {{ $invoice_items->links() }}
            </div>



            <button wire:click="updateActivite" type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalFormInvoice">
                حفظ
              </button>






    @else
        <div class="alert text-center alert-danger m-5">{{ __('Empty invoice items') }}</div>
    @endif
</div>

