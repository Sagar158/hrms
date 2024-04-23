<x-app-layout title="{{ $title }}">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <x-page-heading title="{{ __('Advance Salary') }}"></x-page-heading>
        <x-right-side-button link="{{ route('advancesalary.create') }}" title="Create"></x-right-side-button>
        <x-alert></x-alert>
        <div class="container-fluid card mt-3">
            <div class="row card-body">
                <div class="col-lg-12 col-sm-12 col-md-12">
                    <div class="table-responsive">
                        <table id="dataTable" class="table">
                          <thead>
                            <tr>
                              <th>Employee Name</th>
                              <th>Department</th>
                              <th>Designation</th>
                              <th>Branch</th>
                              <th>Mobile Number</th>
                              <th>Amount Requested</th>
                              <th>Requested At</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                      </div>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#dataTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route("advancesalary.getAdvanceSalaryData") }}',
                    columns: [
                        { data: 'employee_name', name: 'employee_name' },
                        { data: 'department', name: 'department' },
                        { data: 'designation', name: 'designation' },
                        { data: 'branch', name: 'branch' },
                        { data: 'mobile_number', name: 'mobile_number' },
                        { data: 'amount_requested', name: 'amount_requested' },
                        { data: 'created_at', name: 'created_at' },
                        { data: 'action', name: 'action', orderable: false, searchable: false }
                    ]
                });
            });
        </script>
    @endpush
</x-app-layout>
