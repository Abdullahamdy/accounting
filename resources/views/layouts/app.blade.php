<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="theme-color" content="#000000"/>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
          integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>    <!--load all styles for font aswesome -->
    <title>{{ config('app.name') }}</title>
    <!-- My own style -->
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet"/>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
            integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css"
          integrity="sha512-H9jrZiiopUdsLpg94A333EfumgUBpO9MdbxStdeITo+KEIMaNfHNvwyjjDJb+ERPaRS6DpyRlKbvPUasNItRyw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    @livewireStyles
</head>

<body>
<div class="container-fluid p-0 d-flex">
    <div class="bg-light d-lg-block d-none sidebar margin-top-76 padding-bottom-76 border border-top-0 border-left">
        <ul class="p-3 list-unstyled when-hover-side">
                       @if(auth()->user()->can('accounting show users'))
                           <li class="rounded-pill bg-white mb-3 px-3 py-2 border-white border">
                               <a href="{{ route('users') }}" class="h5 text-decoration-none d-block mb-0">
                                   <i class="fas fa-user ml-1 h6"></i> {{ __('Users') }}
                                </a>
                           </li>
                       @endif
                        {{-- @if(auth()->user()->can('accounting show users')) --}}
            @foreach(\Spatie\Permission\Models\Role::whereIn('id', ['2', '3', '4'])->get() as $role)
                <li class="rounded-pill bg-white mb-3 px-3 py-2 border-white border">
                    <a href="{{ route('users') }}?role_id={{ $role->id }}" class="h5 text-decoration-none d-block mb-0">
                        <i class="fas fa-user ml-1 h6"></i> @if($role->name == 'Admin')????????????@elseif($role->name == 'Supplier') ????????????????@elseif($role->name == 'Customer')??????????????@elseif($role->name == 'Employee')????????????????@else ??????????????????????@endif
                    </a>
                </li>
            @endforeach
                        {{-- @endif --}}
            {{--            @if(auth()->user()->can('accounting show roles'))--}}
            {{--                <li class="rounded-pill bg-white mb-3 px-3 py-2 border-white border">--}}
            {{--                    <a href="{{ route('users.roles') }}" class="h5 text-decoration-none d-block mb-0">--}}
            {{--                        <i class="fas fa-user-shield ml-1 h6"></i> {{ __('Roles') }}--}}
            {{--                    </a>--}}
            {{--                </li>--}}
            {{--            @endif--}}
                       @if(auth()->user()->can('accounting show index accounts'))
                            <li class="rounded-pill bg-white mb-3 px-3 py-2 border-white border">
                              <a href="{{ route('index-accounts') }}" class="h5 text-decoration-none d-block mb-0">
                                   <i class="fas fa-list ml-1 h6"></i> ???????? ????????????????
                               </a>
                          </li>
                       @endif
            {{--            @if(auth()->user()->can('accounting show account guides'))--}}
                         {{-- <li class="rounded-pill bg-white mb-3 px-3 py-2 border-white border">
                                <a href="{{ route('account-guides') }}" class="h5 text-decoration-none d-block mb-0">
                                <i class="fas fa-book ml-1 h6"></i> ?????????????? ??????????????
                         </li> --}}
                      {{-- @endif --}}
                     @if(auth()->user()->can('accounting show items'))
            <li class="rounded-pill bg-white mb-3 px-3 py-2 border-white border">
                <a href="{{ route('items') }}" class="h5 text-decoration-none d-block mb-0">
                    <i class="fas fa-th-list ml-1 h6"></i> ??????????????
                </a>
            </li>
                       @endif

                       @if(auth()->user()->can('accounting show invoices'))
                         <li class="rounded-pill bg-white mb-3 px-3 py-2 border-white border">
                               <a href="{{ route('invoices') }}?type=1" class="h5 text-decoration-none d-block mb-0">
                                <i class="fas fa-clipboard-list ml-1 h6"></i>???????????? ????????????
                               </a>
                          </li>
                       @endif


                       @if(auth()->user()->can('accounting show invoices'))
                          <li class="rounded-pill bg-white mb-3 px-3 py-2 border-white border">
                             <a href="{{ route('invoices') }}?type=0" class="h5 text-decoration-none d-block mb-0">
                                   <i class="fas fa-clipboard-list ml-1 h6"></i> ???????????? ??????????
                               </a>
                           </li>
                       @endif
            {{--            @if(auth()->user()->can('accounting show invoice items'))--}}
            {{--                <li class="rounded-pill bg-white mb-3 px-3 py-2 border-white border">--}}
            {{--                    <a href="{{ route('invoice-items') }}" class="h5 text-decoration-none d-block mb-0">--}}
            {{--                        <i class="fas fa-stream ml-1 h6"></i> ?????????? ????????????????--}}
            {{--                    </a>--}}
            {{--                </li>--}}
            {{--            @endif--}}


                      @if(auth()->user()->can('accounting show arrest receipts'))

                      <li class="rounded-pill bg-white mb-3 px-3 py-2 border-white border">

                                           <a href="{{ route('arrest-receipts') }}?type=0" class="h5 text-decoration-none d-block mb-0">

                                                                 <i class="fas fa-money-check-alt ml-1 h6"></i> ?????????? ??????????


                                                                               </li>

                                                                                           @endif
                       @if(auth()->user()->can('accounting show arrest receipts'))
                            <li class="rounded-pill bg-white mb-3 px-3 py-2 border-white border">
                               <a href="{{ route('arrest-receipts') }}?type=1" class="h5 text-decoration-none d-block mb-0">
                                   <i class="fas fa-money-check-alt ml-1 h6"></i> ?????????????? ??????????
                              </a>
                </li>


                    @endif
            {{--            @if(auth()->user()->can('accounting show invoice discounts'))--}}
            {{--                <li class="rounded-pill bg-white mb-3 px-3 py-2 border-white border">--}}
            {{--                    <a href="{{ route('invoice-discounts') }}?type=1" class="h5 text-decoration-none d-block mb-0">--}}
            {{--                        <i class="fas fa-percent ml-1 h6"></i> ???????????? ???????????????? ????????????????--}}
            {{--                    </a>--}}
            {{--                </li>--}}
            {{--            @endif--}}
            {{--            @if(auth()->user()->can('accounting show invoice discounts'))--}}
            {{--                <li class="rounded-pill bg-white mb-3 px-3 py-2 border-white border">--}}
            {{--                    <a href="{{ route('invoice-discounts') }}?type=0" class="h5 text-decoration-none d-block mb-0">--}}
            {{--                        <i class="fas fa-percent ml-1 h6"></i> ???????????? ???????????????? ?????????????? ??????--}}
            {{--                    </a>--}}
            {{--                </li>
            {{--            @endif--}}
                      {{-- @if(auth()->user()->can('accounting show settings')) --}}
                            <li class="rounded-pill bg-white mb-3 px-3 py-2 border-white border">
                                <a href="{{ route('settings') }}" class="h5 text-decoration-none d-block mb-0">
                                    <i class="fas fa-cog ml-1 h6"></i> ??????????????????
                               </a>
                            </li>
                       {{-- @endif --}}
                        {{-- @if(auth()->user()->can('accounting show payrolls')) --}}
                            {{-- <li class="rounded-pill bg-white mb-3 px-3 py-2 border-white border">
                               <a href="{{ route('payrolls') }}" class="h5 text-decoration-none d-block mb-0">
                                   <i class="fas fa-file-invoice-dollar ml-1 h6"></i> ???????????? ??????????????
                                </a>
                           </li> --}}
                       {{-- @endif --}}
                            {{-- <li class="rounded-pill bg-white mb-3 px-3 py-2 border-white border">
                                <a href="{{ route('categories') }}" class="h5 text-decoration-none d-block mb-0">
                                    <i class="fas fa-list ml-1 h6"></i> ??????????????
                                </a>
                            </li> --}}
                            {{-- <li class="rounded-pill bg-white mb-3 px-3 py-2 border-white border">
                                <a href="{{ route('units') }}" class="h5 text-decoration-none d-block mb-0">
                                    <i class="fas fa-box ml-1 h6"></i> ??????????????
                                </a>
                            </li> --}}
                            {{-- <li class="rounded-pill bg-white mb-3 px-3 py-2 border-white border">
                                <a href="{{ route('serial-numbers') }}" class="h5 text-decoration-none d-block mb-0">
                                    <i class="fas fa-lock ml-1 h6"></i> ?????????????? ??????????????????
                                </a>
                            </li> --}}

        </ul>
    </div>
    <nav class="navbar fixed-top navbar-light bg-white border-bottom">
        <div class="row w-100">
            <div class="col-md-8 d-sm-block d-inline-block text-center text-md-end">
                <a class="navbar-brand align-middle m-0" href="{{ route('home') }}">
                    <img src="{{asset('assets/images/logo.jpg')}}" width="50px" alt="">
                    <span class="h5 d-lg-inline d-none">{{config("app.name")}}</span>
                </a>
            </div>
            <div class="col-md-4 text-start w-lg-100">
                <div class="row mt-md-0 mt-md-2">
                    <div class="col-md-8 d-lg-block d-none">
                        @if(auth()->check())
                            <a href="#">
                                <img src="{{ auth()->user()->avatar ? asset('storage/'.auth()->user()->avatar) : asset('assets/images/logo.jpg') }}" width="40px" height="40px"
                                     class="d-inline-block border rounded-circle bg-light" alt="">
                                <span class="h6 text-dark">{{auth()->user()->name}} <span
                                        class="badge bg-success">{{auth()->user()->roles()->pluck('name')->implode(',')}}</span></span>
                            </a>
                        @else
                            <a href="#">
                                <img src="{{asset('assets/images/logo.jpg')}}" width="40px" height="40px"
                                     class="d-inline-block border rounded-circle bg-light" alt="">
                                <span class="h6 text-dark">{{__("Guest")}}</span>
                            </a>
                        @endif
                    </div>
                    <div class="col-md-4 mt-auto mb-auto text-start">
                        <ul class="m-0 p-0 d-inline-block align-middle logout-sm">
                            @if(auth()->check())
                                <li class="rounded-circle bg-light d-inline-block p-2 position-relative">
                                    <a href="{{route('logout')}}" class="h5 text-success"><i
                                            class="fas fa-sign-out-alt"></i></a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="position-absolute active-sidebar d-sm-none">
            <i class="btn fas fa-bars border p-2 rounded-3 bg-light"></i>
        </div>
    </nav>
    <div class="container-fluid position-relative">
        <div class="overlay"></div>
        <div class="main margin-top-76 padding-bottom-76 pt-3 mb-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card bg-white border-0 p-2">
                        {{$slot}}
                    </div>
                </div>
            </div>
        </div>

        <footer class="p-2 border-top position-absolute bottom-0 w-95">
            <h6>{{ __('All rights reserved to') }}  <a href="" class="text-primary">Accounting</a></h6>
        </footer>
    </div>
</div>

<!-- Optional JavaScript; choose one of the two! -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"
        integrity="sha512-t2JWqzirxOmR9MZKu+BMz0TNHe55G5BZ/tfTmXMlxpUY8tsTo3QMD27QGoYKZKFAraIPDhFv56HLdN11ctmiTQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{asset('assets/js/script.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"
        integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@livewireScripts

<script>
    window.addEventListener('close-modal', event => {
        $(".modal").modal('hide');
    })

    window.livewire.on('alertSuccess', (message) => {
        $(".modal").modal('hide');
        Swal.fire(
            '?????????????? ???? !',
            '?????? ???? ?????????? ???????????? ???? ???????????? ???????????? , ?????????? ?????? ???????? !',
            'success',
        )
    })

    window.livewire.on('alertFailed', (message) => {
        $(".modal").modal('hide');
        Swal.fire(
            '???? ?????????? ???? !',
            message,
            'error',
        )
    })
</script>

</body>
</html>
