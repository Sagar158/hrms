<div class="tab-pane fade" id="experience" role="tabpanel" aria-labelledby="experience-tab">

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-sm-12 col-md-6">
                <div class="table-responsive">
                    <table id="experienceDataTable" class="table">
                        <thead>
                        <tr>
                            <th>Company Name</th>
                            <th>Position</th>
                            <th>Address</th>
                            <th>Work Duration</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-md-6">
                <form action="{{ route('employees.experience',$user->id) }}" method="POST" enctype="multipart/form-data">
                    {{ @csrf_field() }}
                    <div class="container-fluid">
                        <div class="row">
                            <x-text-input id="user_id" type="hidden" name="user_id" :value="old('user_id', $user->id)" autofocus autocomplete="off" />
                            <x-text-input id="experience_id" type="hidden" name="experience_id" :value="0" autofocus autocomplete="off" />

                            <div class="col-lg-12 col-sm-12 col-md-12">
                                <h5>Education</h5>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-md-6">
                                <x-text-input id="company_name" type="text" name="company_name" :value="old('company_name')" autofocus autocomplete="off" placeholder="Company Name" />
                            </div>
                            <div class="col-lg-6 col-sm-12 col-md-6">
                                <x-text-input id="position" type="text" name="position" :value="old('position')" autofocus autocomplete="off" placeholder="Position" />
                            </div>
                            <div class="col-lg-6 col-sm-12 col-md-6">
                                <x-text-input id="address" type="text" name="address" :value="old('address')" autofocus autocomplete="off" placeholder="Address" />
                            </div>
                            <div class="col-lg-6 col-sm-12 col-md-6">
                                <x-text-input id="working_duration" type="text" name="working_duration" :value="old('working_duration')" autofocus autocomplete="off" placeholder="Working Duration" />
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
        </div>
    </div>

</div>
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#experienceDataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("employees.fetchExperience", $user->id) }}',
                columns: [
                    { data: 'company_name', name: 'company_name' },
                    { data: 'position', name: 'position' },
                    { data: 'address', name: 'address' },
                    { data: 'working_duration', name: 'working_duration' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            $(document).on('click','.experience-edit', function(){
                var data = $(this);
                $('input[name="company_name"]').val(data.attr('data-company_name'));
                $('input[name="position"]').val(data.attr('data-position'));
                $('input[name="address"]').val(data.attr('data-address'));
                $('input[name="working_duration"]').val(data.attr('data-working_duration'));
                $('input[name="experience_id"]').val(data.attr('data-id'));

            });

        });
    </script>
@endpush
