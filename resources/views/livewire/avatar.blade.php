<div class="text-center data-profile">
    <label for="avatar" class="position-relative img-single">
        <i class="fas fa-pencil-alt position-absolute bottom-0 start-50 rounded-circle btn btn-primary p-2"></i>
        <input class="visually-hidden" type="file" id="avatar" wire:model="photo"/>
        @if($imageTemp)
            <img width="200px" height="200px" class="border rounded-circle" src="{{ $imageTemp->temporaryUrl() }}">
        @else
            <img width="200px" height="200px" class="border rounded-circle" src="{{ asset('storage/'.auth()->user()->avatar) }}">
        @endif
    </label>

</div>


