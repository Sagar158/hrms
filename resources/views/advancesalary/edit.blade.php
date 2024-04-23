@php
    $route = (!isset($advanceSalary->id) ? route('advancesalary.store') : route('advancesalary.update',$advanceSalary->id));
@endphp
<x-app-layout title="{{ $title }}">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <x-page-heading title="{{ __('Create / Update Advance Salary') }}"></x-page-heading>
        <x-back-button></x-back-button>

        <div class="container-fluid card mt-3">
            <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
                {{ @csrf_field() }}
                <div class="row card-body">
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-select-box id="user_id" name="user_id" value="{{ old('user_id',$advanceSalary->user_id) }}" autocomplete="off" placeholder="Employee" extraClass="ajax-endpoint employees" endpoint="{{ route('employees.getData') }}" optionText="{{ isset($advanceSalary->user_id) ? \App\Models\User::where('id',$advanceSalary->user_id)->first()->full_name : '' }}" required/>
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-select-box id="branch_id" name="branch_id" value="{{ old('branch_id',$advanceSalary->branch_id) }}" autocomplete="off" placeholder="Branch" extraClass="ajax-endpoint branches" endpoint="{{ route('employees.branches.getData') }}" optionText="{{ isset($advanceSalary->branch_id) ? \App\Models\Branches::where('id',$advanceSalary->branch_id)->first()->name : '' }}" required/>
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-text-input id="amount_requested" type="number" name="amount_requested" :value="old('amount_requested', $advanceSalary->amount_requested)" required autofocus autocomplete="off" placeholder="Amount Requested" />
                    </div>
                    @if(isset($advanceSalary->user_id))
                        <div class="col-lg-12 col-sm-12 col-md-12">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-8 col-sm-12 col-md-8">
                                        <div><span class="font-weight-bold m-2 h6">Employee Name : </span> <span>{{ $advanceSalary->employee->full_name}}</span></div>
                                        <div><span class="font-weight-bold m-2 h6">Employee Code / Department / Designation: </span><span>{{ isset($advanceSalary->employee->employee_code) ? $advanceSalary->employee->employee_code : '' }} {{ isset($advanceSalary->employee->department->name) ? '|'. $advanceSalary->employee->department->name : '' }} {{ isset($advanceSalary->employee->designation->name) ? '|'. $advanceSalary->employee->designation->name : '' }}</span></div>
                                        <div><span class="font-weight-bold m-2 h6">Mobile Phone : </span>{{ $advanceSalary->employee->contact_number }}</div>
                                        <div><span class="font-weight-bold m-2 h6">Email : </span>{{ $advanceSalary->employee->email }}</div>
                                    </div>
                                    <div class="col-lg-4 col-sm-12 col-md-4">
                                        @if(!empty($advanceSalary->employee->image))
                                            <img src="{{ asset($advanceSalary->employee->image) }}" class="img-thumbnail text-center" style="width: 250px !important;">
                                        @else
                                            <img src="{{ asset('assets/images/placeholder.jpg') }}" class="img-thumbnail text-center" style="width: 250px !important;">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="col-lg-12 col-sm-12 col-md-12 mt-2">
                        <x-primary-button class="btn btn-primary">
                            {{ __('Save') }}
                        </x-primary-button>
                        <x-back-button></x-back-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
