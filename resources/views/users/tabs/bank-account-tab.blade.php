<div class="tab-pane fade" id="bank-account" role="tabpanel" aria-labelledby="bank-account-tab">
    <form action="{{ route('employees.bankAccount',$user->id) }}" method="POST" enctype="multipart/form-data">
        {{ @csrf_field() }}
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-md-12 mt-3">
                    <h5>Bank Account Information</h5>
                    <x-text-input id="user_id" type="hidden" name="user_id" :value="old('user_id', $user->id)" autofocus autocomplete="off" />
                </div>
                <div class="col-lg-4 col-sm-4 col-md-4">
                    <x-text-input id="bank_holder_name" type="text" name="bank_holder_name" :value="old('bank_holder_name', (isset($user->bank->bank_holder_name) ? $user->bank->bank_holder_name : ''))" autofocus autocomplete="off" placeholder="Bank Holder Name" />
                </div>
                <div class="col-lg-4 col-sm-4 col-md-4">
                    <x-text-input id="bank_name" type="text" name="bank_name" :value="old('bank_name', (isset($user->bank->bank_name) ? $user->bank->bank_name : ''))" autofocus autocomplete="off" placeholder="Bank Name" />
                </div>
                <div class="col-lg-4 col-sm-4 col-md-4">
                    <x-text-input id="branch_name" type="text" name="branch_name" :value="old('branch_name', (isset($user->bank->branch_name) ? $user->bank->branch_name : ''))" autofocus autocomplete="off" placeholder="Branch Name" />
                </div>
                <div class="col-lg-4 col-sm-4 col-md-4">
                    <x-text-input id="bank_account_number" type="text" name="bank_account_number" :value="old('bank_account_number', (isset($user->bank->bank_account_number) ? $user->bank->bank_account_type : ''))" autofocus autocomplete="off" placeholder="Bank Account Number" />
                </div>
                <div class="col-lg-4 col-sm-4 col-md-4">
                    <x-text-input id="bank_account_type" type="text" name="bank_account_type" :value="old('bank_account_type', (isset($user->bank->bank_account_type) ? $user->bank->bank_account_type : ''))" autofocus autocomplete="off" placeholder="Bank Account Type" />
                </div>
                <div class="col-lg-12 col-sm-12 col-md-12 mt-2">
                    <x-primary-button class="btn btn-primary">
                        {{ trans('general.save') }}
                    </x-primary-button>
                    <x-back-button></x-back-button>
                </div>
            </div>
        </div>
    </form>
</div>
