<!-- Simple Approval Confirmation Modal -->
<div class="modal fade" id="approvePeopleModal" tabindex="-1" role="dialog" aria-labelledby="approvePeopleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="approvePeopleForm" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="approvePeopleModalLabel">
                        <i class="fas fa-check-circle mr-2"></i> Confirm Approval
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center py-4">
                    <div class="mb-3">
                        <i class="fas fa-user-check text-success fa-3x"></i>
                    </div>
                    <h4>Are you sure?</h4>
                    <p class="text-muted">You are about to approve <strong><span id="modalPeopleName"></span></strong>.</p>
                    <div class="alert alert-info py-2 small">
                        <i class="fas fa-info-circle mr-1"></i>
                        The system will automatically generate login credentials and send them to the applicant via SMS.
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4" id="btnSubmitApproval">
                        Yes, Approve Now
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('script')
<script>
$(document).ready(function() {
    let currentPeopleId = null;

    // Handle modal trigger from table
    $(document).on('click', '.btn-approve-people', function(e) {
        e.preventDefault();
        currentPeopleId = $(this).data('id');
        $('#modalPeopleName').text($(this).data('name'));
        $('#approvePeopleModal').modal('show');
    });

    // Submit Form
    $('#approvePeopleForm').submit(function(e) {
        e.preventDefault();
        const btn = $('#btnSubmitApproval');
        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Approving...');

        let url = "{{ route('people.approve', ':id') }}";
        url = url.replace(':id', currentPeopleId);

        $.ajax({
            url: url,
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                $('#approvePeopleModal').modal('hide');
                toastr.success(response.message);
                
                setTimeout(() => {
                    if (response.redirect_url) {
                        window.location.href = response.redirect_url;
                    } else {
                        window.location.reload();
                    }
                }, 1500);
            },
            error: function(xhr) {
                btn.prop('disabled', false).html('Yes, Approve Now');
                toastr.error(xhr.responseJSON.message || "An error occurred during approval.");
            }
        });
    });
});
</script>
@endpush
