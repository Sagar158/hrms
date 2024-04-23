<x-app-layout title="{{ $title }}">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <x-page-heading title="Employee Details"></x-page-heading>
        <x-back-button></x-back-button>
        <x-alert></x-alert>

        <div class="container-fluid card mt-3">
            <div class="row card-body">
                <div class="col-lg-12 col-sm-12 col-md-12">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="personal-info-tab" data-bs-toggle="tab" href="#personal-info" role="tab" aria-controls="personal-info" aria-selected="true">Personal Info</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="address-tab" data-bs-toggle="tab" href="#address" role="tab" aria-controls="address" aria-selected="false">Address</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="education-tab" data-bs-toggle="tab" href="#education" role="tab" aria-controls="education" aria-selected="false">Education</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="experience-tab" data-bs-toggle="tab" href="#experience" role="tab" aria-controls="experience" aria-selected="false">Experience</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="bank-account-tab" data-bs-toggle="tab" href="#bank-account" role="tab" aria-controls="bank-account" aria-selected="false">Bank Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="document-tab" data-bs-toggle="tab" href="#document" role="tab" aria-controls="document" aria-selected="false">Document</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="leave-tab" data-bs-toggle="tab" href="#leave" role="tab" aria-controls="leave" aria-selected="false">Leave</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="assets-tab" data-bs-toggle="tab" href="#assets" role="tab" aria-controls="assets" aria-selected="false">Assets</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="password-tab" data-bs-toggle="tab" href="#password" role="tab" aria-controls="password" aria-selected="false">Password</a>
                        </li>
                    </ul>
                    <div class="tab-content border border-top-0 p-3" id="myTabContent">
                        @include('users.tabs.personal-tab')
                        @include('users.tabs.address-tab')
                        @include('users.tabs.education-tab')
                        @include('users.tabs.experience-tab')
                        @include('users.tabs.bank-account-tab')
                        @include('users.tabs.document-tab')
                        @include('users.tabs.leave-tab')
                        @include('users.tabs.asset-tab')
                        @include('users.tabs.password-tab')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                // Handle form submission
                $('#userAddressForm').on('submit', function(e) {
                    e.preventDefault(); // Prevent the form from submitting in the traditional way

                    // Serialize the form data
                    var formData = new FormData($(this)[0]);

                    // Send AJAX request
                    $.ajax({
                        url: $(this).attr('action'), // URL to submit the form to
                        type: $(this).attr('method'), // HTTP method (POST in this case)
                        data: formData, // Form data to be submitted
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            // Handle success response from the server
                            console.log('Form submitted successfully');
                            console.log(response);
                            // You can do further processing here if needed
                        },
                        error: function(xhr, status, error) {
                            // Handle error response from the server
                            console.log('Error occurred while submitting the form');
                            console.log(xhr.responseText);
                        }
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
