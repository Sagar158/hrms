@php
    $route = (!isset($holiday->id) ? route('holiday.store') : route('holiday.update',$holiday->id));
@endphp
<x-app-layout title="{{ $title }}">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <x-page-heading title="{{ __('Create / Update Holiday') }}"></x-page-heading>
        <x-back-button></x-back-button>

        <div class="container-fluid card mt-3">
            <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
                {{ @csrf_field() }}
                <div class="row card-body">
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-text-input id="name" type="text" name="name" :value="old('name', $holiday->name)" required autofocus autocomplete="off" placeholder="Name" />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-text-input id="start_date" type="date" name="start_date" :value="old('start_date', $holiday->start_date)" required autofocus autocomplete="off" placeholder="Start Date" />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-text-input id="end_date" type="date" name="end_date" :value="old('end_date', $holiday->end_date)" required autofocus autocomplete="off" placeholder="End Date" />
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
