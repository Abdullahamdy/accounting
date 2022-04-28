<div>
    <div class="row">
        <div class="col-lg-6">
            <table class="table table-hover mt-4 mb-4 edit-table-data table-responsive-sm shadow">
                <thead>
                <tr>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td colspan="2">
                        <livewire:edit-profile :key="'edit-profile-profile-'. auth()->id()"></livewire:edit-profile>
                    </td>
                 </tr>
                <tr>
                    <td>{{ __('Email') }}</td>
                    <td class="text-center">{{auth()->user()->email}}</td>
                </tr>
                <tr>
                    <td>{{ __('Roles') }}</td>
                    <td class="text-center"> {{auth()->user()->roles()->pluck("name")->implode(',')}}</td>
                </tr>
                @if(auth()->user()->mobile)
                    <tr>
                        <td>{{ __('Mobile') }}</td>
                        <td class="text-center">{{auth()->user()->mobile}}</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
        <div class="col-lg-6 text-center my-auto">
            <livewire:avatar :key="'avatar-profile-'"></livewire:avatar>
        </div>
    </div>
</div>
