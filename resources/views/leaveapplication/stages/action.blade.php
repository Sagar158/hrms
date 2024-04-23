<div class="container-fluid mt-3">
    @if((in_array($data->status,[\App\Models\LeaveApplication::APPROVAL_PENDING_BY_HR, \App\Models\LeaveApplication::REJECTED_BY_HOD])) && (auth()->user()->user_type_id == \App\Models\User::ADMIN))
        <div class="card">
            <div class="card-header">
                <h5>Take Action</h5>
            </div>
            <div class="row card-body">
                <div class="col-lg-12 col-sm-12 col-md-12">
                    <h5 class="mt-2 mb-2">Do you want to approve the leave application?</h5>
                    <form id="initiate-request" action="{{ route('leaveapplication.decide', $data->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="action" value="">
                        <x-text-area id="details" name="details" :value="old('details')"  placeholder="Reason of Rejection" required divStyle="display: none;"/>
                        <button class="btn btn-success" type="button">Confirm</button>
                        <button class="btn btn-danger reject" type="button">Reject</button>
                    </form>
                </div>
            </div>
        </div>
    @elseif((in_array($data->status,[\App\Models\LeaveApplication::APPROVED_BY_HR])) && (auth()->user()->user_type_id == \App\Models\User::HOD))
        <div class="card">
            <div class="card-header">
                <h5>Take Action</h5>
            </div>
            <div class="row card-body">
                <div class="col-lg-12 col-sm-12 col-md-12">
                    <h5 class="mt-2 mb-2">Do you want to approve the leave application?</h5>
                    <form id="initiate-request" action="{{ route('leaveapplication.decide', $data->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="action" value="">
                        <x-text-area id="details" name="details" :value="old('details')"  placeholder="Reason of Rejection" required divStyle="display: none;"/>
                        <button class="btn btn-success" type="button">Confirm</button>
                        <button class="btn btn-danger reject" type="button">Reject</button>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>

@push('scripts')
<script>
    $(document).ready(function(){
        $(document).on('click','.reject', function(){
            $('input[name="action"]').val(0);
            $('.text-area-div').show('slow');
            $('textarea[name="details"]').attr('required', true);
            $('.btn-success').removeAttr("type").attr("type", "submit");
        });
        $(document).on('click','.btn-success', function(){
            // $('.text-area-div').hide('slow');
            if($('.btn-success').attr("type") == 'submit')
            {
                $('input[name="action"]').val(0);
                if ($('textarea[name="details"]').val().trim() !== '')
                {
                    $('#initiate-request').submit();
                }
            }
            else
            {
                $('input[name="action"]').val(1);
                $('#initiate-request').submit();
            }


        });
    });
</script>
@endpush
