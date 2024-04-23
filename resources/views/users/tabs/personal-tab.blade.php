<div class="tab-pane fade show active" id="personal-info" role="tabpanel" aria-labelledby="personal-info-tab">
    <form action="{{ route('employees.update',$user->id) }}" method="POST" enctype="multipart/form-data">
        {{ @csrf_field() }}
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-sm-12 col-md-4">
                        <div class="p-3 text-center">
                            @if(!empty($user->image))
                                <img src="{{ asset($user->image) }}" class="img-thumbnail text-center" style="width: 250px !important;">
                            @else
                                <img src="{{ asset('assets/images/placeholder.jpg') }}" class="img-thumbnail text-center" style="width: 250px !important;">
                            @endif
                            <h5 class="mt-2">{{ $user->full_name }}</h5>
                        </div>
                        <div class="p-2">
                            <span class="font-weight-bold">Email :</span>
                            <span>{{ $user->email }}</span>
                        </div>
                        <div class="p-2">
                            <span class="font-weight-bold">Phone :</span>
                            <span>{{ $user->contact_number }}</span>
                        </div>
                </div>
                <div class="col-lg-8 col-sm-12 col-md-8">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-4 col-sm-12 col-md-4">
                                <x-text-input id="first_name" type="text" name="first_name" :value="old('first_name', $user->first_name)" autofocus autocomplete="off" placeholder="{{ trans('general.first_name') }}" />
                            </div>
                            <div class="col-lg-4 col-sm-12 col-md-4">
                                <x-text-input id="last_name" type="text" name="last_name" :value="old('last_name', $user->last_name)" autofocus autocomplete="off" placeholder="{{ trans('general.last_name') }}" />
                            </div>
                            <div class="col-lg-4 col-sm-12 col-md-4">
                                <x-text-input id="employee_code" type="text" name="employee_code" :value="old('employee_code', $user->employee_code)" autofocus autocomplete="off" placeholder="Employee Code" />
                            </div>
                            <div class="col-lg-4 col-sm-12 col-md-4">
                                <x-select-box id="department_id" name="department_id" value="{{ old('department_id',$user->department_id) }}" autocomplete="off" placeholder="Department" extraClass="ajax-endpoint departments" endpoint="{{ route('department.getData') }}" optionText="{{ isset($user->department_id) ? \App\Models\Department::where('id',$user->department_id)->first()->name : '' }}" required/>
                            </div>
                            <div class="col-lg-4 col-sm-12 col-md-4">
                                <x-select-box id="designation_id" name="designation_id" value="{{ old('designation_id',$user->designation_id) }}" autocomplete="off" placeholder="Designation" extraClass="ajax-endpoint designations" endpoint="{{ route('designation.getData') }}" optionText="{{ isset($user->designation_id) ? \App\Models\Designation::where('id',$user->designation_id)->first()->name : '' }}" required/>
                            </div>
                            <div class="col-lg-4 col-sm-12 col-md-4">
                                <x-select-box id="user_type_id" name="user_type_id" :value="old('user_type_id', $user->user_type_id)" :values="\App\Helpers\Helper::fetchUserType()" autocomplete="off" placeholder="{{ trans('general.user_access_level') }}" />
                            </div>
                            <div class="col-lg-4 col-sm-12 col-md-4">
                                <x-select-box id="gender" name="gender" :value="old('gender', $user->gender)" :values="\App\Helpers\Helper::$gender" autocomplete="off" placeholder="Gender" />
                            </div>
                            <div class="col-lg-4 col-sm-12 col-md-4">
                                <x-select-box id="blood_group" name="blood_group" :value="old('blood_group', $user->blood_group)" :values="\App\Helpers\Helper::$bloodGroup" autocomplete="off" placeholder="Blood Group" />
                            </div>
                            <div class="col-lg-4 col-sm-12 col-md-4">
                                <x-text-input id="nid" type="text" name="nid" :value="old('nid', $user->nid)" autofocus autocomplete="off" placeholder="NID" />
                            </div>
                            <div class="col-lg-4 col-sm-12 col-md-4">
                                <x-text-input id="contact_number" type="text" name="contact_number" :value="old('contact_number', $user->contact_number)" autofocus autocomplete="off" placeholder="{{ trans('general.contact_number') }}" />
                            </div>
                            <div class="col-lg-4 col-sm-12 col-md-4">
                                <x-text-input id="date_of_birth" type="date" name="date_of_birth" :value="old('date_of_birth', $user->date_of_birth)" autofocus autocomplete="off" placeholder="{{ trans('general.date_of_birth') }}" />
                            </div>
                            <div class="col-lg-4 col-sm-12 col-md-4">
                                <x-text-input id="date_of_joining" type="date" name="date_of_joining" :value="old('date_of_joining', $user->date_of_joining)" autofocus autocomplete="off" placeholder="Date of Joining" />
                            </div>
                            <div class="col-lg-4 col-sm-12 col-md-4">
                                <x-text-input id="date_of_leaving" type="date" name="date_of_leaving" :value="old('date_of_leaving', $user->date_of_leaving)" autofocus autocomplete="off" placeholder="Date of Leaving" />
                            </div>
                            <div class="col-lg-4 col-sm-12 col-md-4">
                                <x-text-input id="username" type="text" name="username" :value="old('username', $user->username)" autofocus autocomplete="off" placeholder="Username" />
                            </div>
                            <div class="col-lg-4 col-sm-12 col-md-4">
                                <x-text-input id="email" type="email" name="email" :value="old('email', $user->email)" autofocus autocomplete="off" placeholder="{{ trans('general.email') }}" />
                            </div>
                            <div class="col-lg-4 col-sm-12 col-md-4">
                                <label for="">Image</label>
                                <input type="file" class="form-control" name="image">
                            </div>
                            <div class="col-lg-12 col-sm-12 col-md-12 mt-2">
                                <x-primary-button class="btn btn-primary">
                                    {{ trans('general.save') }}
                                </x-primary-button>
                                <x-back-button></x-back-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
