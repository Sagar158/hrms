@php
    $route = (!isset($leaveType->id) ? route('leavetype.store') : route('leavetype.update',$leaveType->id));
@endphp
<x-app-layout title="{{ $title }}">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <x-page-heading title="{{ __('Create / Update Leave Type') }}"></x-page-heading>
        <x-back-button></x-back-button>

        <div class="container-fluid card mt-3">
            <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
                {{ @csrf_field() }}
                <div class="row card-body">
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-text-input id="name" type="text" name="name" :value="old('name', $leaveType->name)" required autofocus autocomplete="off" placeholder="Name" />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-text-input id="days" type="text" name="days" :value="old('days', $leaveType->days)" required autofocus autocomplete="off" placeholder="Days" />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-select-box id="status" name="status" :value="old('status', $leaveType->status)" :values="\App\Helpers\Helper::$status" autocomplete="off" placeholder="Status" />
                    </div>
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
