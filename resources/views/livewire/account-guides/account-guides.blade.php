<div>
    {{--    @if(auth()->user()->hasRole('Admin'))--}}
    <livewire:account-guides.account-guide-create :key="'account-guide-create-account-guides-'"></livewire:account-guides.account-guide-create>

    @if($account_guides->count())
        <div class="row">
            <div class="table-responsive-sm">
                <table class="table table-striped table-responsive-sm border">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">العنوان</th>
                        <th scope="col" class="text-center">{{ __('Control') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($account_guides as $account_guide)
                        <tr>
                            <td class="text-center align-middle">{{ $loop->iteration }}</td>
                            <td class="text-center align-middle"><a href="{{ route('account-guides.show', ['account_guide_id' => $account_guide->id]) }}">{{ $account_guide->title }}</a></td>
                            <td class="text-center align-middle">
                                <livewire:account-guides.account-guide-edit :account_guide_id="$account_guide->id" :key="'account-guide-edit-account-guides-'.$account_guide->id"></livewire:account-guides.account-guide-edit>
                                <livewire:account-guides.account-guide-delete :account_guide_id="$account_guide->id" :key="'account-guide-delete-account-guides-'.$account_guide->id"></livewire:account-guides.account-guide-delete>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{ $account_guides->links() }}
        </div>
    @else
        <div class="alert text-center alert-danger m-5">{{ __('Empty account guides') }}</div>
    @endif
    {{--    @endif--}}
</div>

