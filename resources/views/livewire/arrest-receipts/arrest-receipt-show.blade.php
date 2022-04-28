<div class="text-center p-3">
    <div class="row">
        <div class="table-responsive-sm">
            <table class="table table-striped table-responsive-sm border">
                <thead>
                <tr>

                    <th scope="col" class="text-center">الدفع </th>
                    @if($arrest_receipt->type == 1)
                    <th scope="col" class="text-center">اسم الزبون</th>
                    @elseif($arrest_receipt->type == 0)
                    <th scope="col" class="text-center">اسم المورد</th>
                  @endif
                    {{-- <th scope="col" class="text-center">{{ __('Control') }}</th> --}}
                </tr>
                </thead>
                <tbody>



                    <tr>


                        <td width="50px" class="text-center align-middle">
                            <div class="form-group col-2">
                                <input style="width: 280px"wire:model="batch_quantity" type="text" class="form-control text-center offset-3" placeholder="الكمية" aria-label="Username" aria-describedby="addon-wrapping" >
      
                            </div>
                        </td>

                          

                        <td width="200" class="text-center align-middle"> 
                            <div class="form-group">
                                <div class="input-group flex-nowrap">
                                    
                                    <input style="width: 120px" @if($user) value="{{$user->name}}" @endif type="text" class="form-control " placeholder="Username" aria-label="Username" aria-describedby="addon-wrapping" >
                                    <span class="input-group-text"  data-bs-toggle="modal" href="#exampleModalToggle"  id="addon-wrapping"><i class ="fas fa-users "></i></span>
                                  </div>

                       
                            </div>
                            
                            <div>

                           

<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
          @if ($arrest_receipt->type == 1)
          <h5 class="modal-title" id="exampleModalToggleLabel">التجار</h5>
          @else
          <h5 class="modal-title" id="exampleModalToggleLabel">الزبائن</h5>
          @endif
        
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table">
            <thead>
              <tr>
               
                <th scope="col">المستخدم</th>
                <th scope="col"></th>
                
               
              </tr>
            </thead>
            <tbody>
              <tr>
                @foreach ($users as $user)
                <td>{{$user->name}}</td>
                <td><button type="button" wire:click="selectUser({{$user->id}})">اختيار</button></td>
               
                
             
              </tr>
              @endforeach
             
            </tbody>
          </table>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">Open second modal</button>
      </div>
    </div>
  </div>
</div>




                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
  
    </div>
</div>
