<div class="tab-pane fade" id="education" role="tabpanel" aria-labelledby="education-tab">

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-sm-12 col-md-6">
                <div class="table-responsive">
                    <table id="educationDataTable" class="table">
                        <thead>
                        <tr>
                            <th>Certificate</th>
                            <th>Institute</th>
                            <th>Result</th>
                            <th>Year</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-md-6">
                <form action="{{ route('employees.education',$user->id) }}" method="POST" enctype="multipart/form-data">
                    {{ @csrf_field() }}
                    <div class="container-fluid">
                        <div class="row">
                            <x-text-input id="user_id" type="hidden" name="user_id" :value="old('user_id', $user->id)" autofocus autocomplete="off" />
                            <x-text-input id="education_id" type="hidden" name="education_id" :value="0" autofocus autocomplete="off" />

                            <div class="col-lg-12 col-sm-12 col-md-12">
                                <h5>Education</h5>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-md-6">
                                <x-text-input id="degree_title" type="text" name="degree_title" :value="old('degree_title')" autofocus autocomplete="off" placeholder="Degree Title" />
                            </div>
                            <div class="col-lg-6 col-sm-12 col-md-6">
                                <x-text-input id="institute_name" type="text" name="institute_name" :value="old('institute_name')" autofocus autocomplete="off" placeholder="Institute Name" />
                            </div>
                            <div class="col-lg-6 col-sm-12 col-md-6">
                                <x-text-input id="result" type="text" name="result" :value="old('result')" autofocus autocomplete="off" placeholder="Result" />
                            </div>
                            <div class="col-lg-6 col-sm-12 col-md-6">
                                <x-text-input id="passing_year" type="text" name="passing_year" :value="old('passing_year')" autofocus autocomplete="off" placeholder="Passing Year" />
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
            $('#educationDataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("employees.fetchEducation", $user->id) }}',
                columns: [
                    { data: 'degree_title', name: 'degree_title' },
                    { data: 'institute_name', name: 'institute_name' },
                    { data: 'result', name: 'result' },
                    { data: 'passing_year', name: 'passing_year' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            $(document).on('click','.education-edit', function(){
                var data = $(this);
                $('input[name="degree_title"]').val(data.attr('data-degree_title'));
                $('input[name="institute_name"]').val(data.attr('data-institute_name'));
                $('input[name="result"]').val(data.attr('data-result'));
                $('input[name="passing_year"]').val(data.attr('data-passing_year'));
                $('input[name="education_id"]').val(data.attr('data-id'));

            });

        });
    </script>
@endpush
