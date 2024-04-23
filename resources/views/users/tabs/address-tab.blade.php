<div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
    <form action="{{ route('employees.updateAddress',$user->id) }}" method="POST" enctype="multipart/form-data">
        {{ @csrf_field() }}
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-md-12 mt-3">
                    <h5>Permanent Contact Information</h5>
                </div>
                <div class="col-lg-12 col-sm-12 col-md-12">
                    <x-text-input id="user_id" type="hidden" name="user_id" :value="old('user_id', $user->id)" autofocus autocomplete="off" />
                    <x-text-area id="permanent_address" type="text" name="permanent_address" :value="old('permanent_address', (isset($user->address->permanent_address) ? $user->address->permanent_address : '') )" autofocus autocomplete="off" placeholder="Address" />
                </div>
                <div class="col-lg-4 col-sm-4 col-md-4">
                    <x-text-input id="permanent_city" type="text" name="permanent_city" :value="old('permanent_city', (isset($user->address->permanent_city) ? $user->address->permanent_city : ''))" autofocus autocomplete="off" placeholder="City" />
                </div>
                <div class="col-lg-4 col-sm-4 col-md-4">
                    <x-text-input id="permanent_country" type="text" name="permanent_country" :value="old('permanent_country', (isset($user->address->permanent_country) ? $user->address->permanent_country : ''))" autofocus autocomplete="off" placeholder="Country" />
                </div>
                <div class="col-lg-12 col-sm-12 col-md-12 mt-3">
                    <h5>Present Contact Information</h5>
                </div>
                <div class="col-lg-12 col-sm-12 col-md-12">
                    <x-text-area id="present_address" type="text" name="present_address" :value="old('present_address', (isset($user->address->present_address) ? $user->address->present_address : ''))" autofocus autocomplete="off" placeholder="Address" />
                </div>
                <div class="col-lg-4 col-sm-4 col-md-4">
                    <x-text-input id="present_city" type="text" name="present_city" :value="old('present_city', (isset($user->address->present_city) ? $user->address->present_city : ''))" autofocus autocomplete="off" placeholder="City" />
                </div>
                <div class="col-lg-4 col-sm-4 col-md-4">
                    <x-text-input id="present_country" type="text" name="present_country" :value="old('present_country', (isset($user->address->present_country) ? $user->address->present_country : ''))" autofocus autocomplete="off" placeholder="Country" />
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
