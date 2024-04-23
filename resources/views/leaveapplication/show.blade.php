<x-app-layout title="{{ $title }}">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <x-page-heading title="{{ __('Leave Application Details') }} - {{ \App\Models\LeaveApplication::STAGE_LABELS[$leaveApplication->status]['label'] }}"></x-page-heading>
        <x-back-button></x-back-button>
        <x-alert></x-alert>
        @include('leaveapplication.stages.action',['data' => $leaveApplication])

        <div class="container-fluid card mt-3">
            <div class="card-header">
                <h5>Employee Details</h5>
            </div>
            <div class="row card-body">
                <div class="col-lg-8 col-sm-12 col-md-8">
                    <div><span class="font-weight-bold m-2 h6">Employee Name : </span> <span>{{ $leaveApplication->applicationBy->full_name}}</span></div>
                    <div><span class="font-weight-bold m-2 h6">Employee Code / Department / Designation: </span><span>{{ isset($leaveApplication->applicationBy->employee_code) ? $leaveApplication->applicationBy->employee_code : '' }} {{ isset($leaveApplication->applicationBy->department->name) ? '|'. $leaveApplication->createdBy->department->name : '' }} {{ isset($leaveApplication->applicationBy->designation->name) ? '|'. $leaveApplication->createdBy->designation->name : '' }}</span></div>
                    <div><span class="font-weight-bold m-2 h6">Mobile Phone : </span>{{ $leaveApplication->applicationBy->contact_number }}</div>
                    <div><span class="font-weight-bold m-2 h6">Email : </span>{{ $leaveApplication->applicationBy->email }}</div>
                </div>
                <div class="col-lg-4 col-sm-12 col-md-4">
                    @if(!empty($leaveApplication->applicationBy->image))
                        <img src="{{ asset($leaveApplication->applicationBy->image) }}" class="img-thumbnail text-center" style="width: 250px !important;">
                    @else
                        <img src="{{ asset('assets/images/placeholder.jpg') }}" class="img-thumbnail text-center" style="width: 250px !important;">
                    @endif
                </div>
            </div>
        </div>
        <div class="container-fluid card mt-3">
            <div class="card-header">
                <h5>Leave Application Details</h5>
            </div>
            <div class="row card-body">
                <div class="col-lg-12 col-sm-12 col-md-12">
                    <div><span class="font-weight-bold m-3 h6">Leave Type : </span> <span>{{ $leaveApplication->leaveType->name}}</span></div>
                    <div><span class="font-weight-bold m-3 h6">Leave From: </span><span>{{ date('F j, Y', strtotime($leaveApplication->from)) }}</span></div>
                    <div><span class="font-weight-bold m-3 h6">Leave To : </span>{{ date('F j, Y', strtotime($leaveApplication->to)) }}</div>
                    <div><span class="font-weight-bold m-3 h6">Duration : </span>{{ $leaveApplication->duration.' Days' }}</div>
                    <div><span class="font-weight-bold m-3 h6">Reason : </span>{{ $leaveApplication->reason }}</div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
