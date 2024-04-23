@php
    $route = (!isset($leaveApplication->id) ? route('leaveapplication.store') : route('leaveapplication.update',$leaveApplication->id));
@endphp
<x-app-layout title="{{ $title }}">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <x-page-heading title="{{ __('Create / Update Leave Application') }}"></x-page-heading>
        <x-back-button></x-back-button>
        <x-alert></x-alert>
        <div class="container-fluid card mt-3">
            <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
                {{ @csrf_field() }}
                <div class="row card-body">
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-select-box id="user_id" name="user_id" value="{{ old('user_id',$leaveApplication->user_id) }}" autocomplete="off" placeholder="Employee" extraClass="ajax-endpoint employees" endpoint="{{ route('employees.getData') }}" optionText="{{ isset($leaveApplication->user_id) ? \App\Models\User::where('id',$leaveApplication->user_id)->first()->full_name : '' }}" required/>
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-select-box id="leave_type_id" name="leave_type_id" value="{{ old('leave_type_id',$leaveApplication->leave_type_id) }}" autocomplete="off" placeholder="Leave Type" extraClass="ajax-endpoint leaveTypes" endpoint="{{ route('leavetype.getData') }}" optionText="{{ isset($leaveApplication->leave_type_id) ? \App\Models\LeaveType::where('id',$leaveApplication->leave_type_id)->first()->name : '' }}" required/>
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-text-input id="from" type="date" name="from" :value="old('from', $leaveApplication->from)" required autofocus autocomplete="off" placeholder="Leave Start From" />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4">
                        <x-text-input id="to" type="date" name="to" :value="old('to', $leaveApplication->to)" required autofocus autocomplete="off" placeholder="Leave End At" />
                    </div>
                    <div class="col-lg-4 col-sm-12 col-md-4 pt-2">
                        <h5 class="font-weight-bold mt-4">Remaining Leaves : <span class="remainingLeaves text-danger"></span></h5>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12">
                        <x-text-area id="reason" type="date" name="reason" :value="old('reason', $leaveApplication->reason)" required autofocus autocomplete="off" placeholder="Reason" />
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

    @push('scripts')
    <script>
            $(document).ready(function() {
                @if(isset($leaveApplication->id))
                    fetchRemainingLeaves();
                @endif

                $(document).on('change', 'select[name="user_id"], select[name="leave_type_id"]', function(){
                    fetchRemainingLeaves();
                });

            });

            function fetchRemainingLeaves()
            {
                var userId = $('select[name="user_id"]').val();
                var leaveTypeId = $('select[name="leave_type_id"]').val();

                if(userId != '' && leaveTypeId != '')
                {
                    $.ajax({
                                url: '{{ route("leaveapplication.fetchRemainingLeaves") }}',
                                method: 'GET',
                                headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data :{
                                    user_id : userId,
                                    leave_type_id : leaveTypeId
                                },
                                success: function(response)
                                {
                                    var fetchRemainingLeaves = response.remainingLeaves;
                                    console.log(fetchRemainingLeaves);
                                    $('.remainingLeaves').html(fetchRemainingLeaves);
                                }
                        });
                }
            }

        </script>
    @endpush
</x-app-layout>
