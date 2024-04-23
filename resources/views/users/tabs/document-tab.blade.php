<div class="tab-pane fade" id="document" role="tabpanel" aria-labelledby="document-tab">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-sm-12 col-md-6">
                <div class="table-responsive">
                    <table id="documentDataTable" class="table">
                        <thead>
                        <tr>
                            <th>File Title</th>
                            <th>File</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-md-6">
                <form action="{{ route('employees.bankAccount',$user->id) }}" method="POST" enctype="multipart/form-data">
                    {{ @csrf_field() }}
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-md-12">
                                <h5>Bank Account Information</h5>
                                <x-text-input id="user_id" type="hidden" name="user_id" :value="old('user_id', $user->id)" autofocus autocomplete="off" />
                            </div>
                            <div class="col-lg-6 col-sm-6 col-md-6">
                                <x-text-input id="file_title" type="text" name="file_title" :value="old('file_title')" autofocus autocomplete="off" placeholder="File Title" />
                            </div>
                            <div class="col-lg-6 col-sm-6 col-md-6">
                                <x-text-input id="file" type="file" name="file" :value="old('file')" autofocus autocomplete="off" placeholder="File" />
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
            $('#documentDataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("employees.fetchDocuments", $user->id) }}',
                columns: [
                    { data: 'file_title', name: 'file_title' },
                    { data: 'file', name: 'file' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
        });
    </script>
@endpush
