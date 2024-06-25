<!-- Modal -->
<div class="modal fade" id="addRankModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary py-3">
                <h5 class="modal-title text-white" id="exampleModalLabel1">Rank</h5>
                <button type="button" class="close rank_close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="rank_id">
                <div class="row">
                    <div class="col-12 mb-1">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Enter Rank Name"/>
                        <span class="text-danger nameError"></span>
                    </div>
                    <div class="col-12 mb-1">
                        <label for="ap" class="form-label">Personal AP <span class="text-danger">*</span></label>
                        <input type="number" id="ap" name="ap" class="form-control @error('ap') is-invalid @enderror" value="{{ old('ap') }}" placeholder="Enter Personal AP"/>
                        <span class="text-danger apError"></span>
                    </div>
                    <div class="col-12 mb-1">
                        <label for="group_sales" class="form-label">Group Sales <span class="text-danger">*</span></label>
                        <input type="number" id="group_sales" name="group_sales" class="form-control @error('group_sales') is-invalid @enderror" value="{{ old('group_sales') }}" placeholder="Enter Group Sales"/>
                        <span class="text-danger group_salesError"></span>
                    </div>
                    <div class="col-12 mb-1">
                        <label for="commission" class="form-label">Commission <span class="text-danger">*</span></label>
                        <input type="number" id="commission" name="commission" class="form-control @error('commission') is-invalid @enderror" value="{{ old('commission') }}" placeholder="Enter Commission"/>
                        <span class="text-danger commissionError"></span>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" id="formSubmit" class="btn btn-warning" onclick="resetForm();">Reset</button>
                <button type="button" id="addRank" class="btn btn-primary" onclick="addRank();">Add</button>
                <button type="button" id="UpdateRank" class="btn btn-primary d-none" onclick="UpdateRank();">Update</button>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        $('#addRankModalBtn').click(function() {
            resetForm();
            $('#addRank').removeClass('d-none');
            $('#UpdateRank').addClass('d-none');
            $('#addRankModal').modal('show');
        });

        // Reset Category Data
        function resetForm(){
            $('#name').val('');
            $('.name_Error').text('');
            
            $('#ap').val('');
            $('.ap_Error').text('');

            $('#group_sales').val('');
            $('.group_sales_Error').text('');
            
            $('#commission').val('');
            $('.commission_Error').text('');
        }

        function addRank(){
            var name = $('#name').val();
            var ap = $('#ap').val();
            var group_sales = $('#group_sales').val();
            var commission = $('#commission').val();

            var formData = new FormData();
            formData.append('name', name);
            formData.append('ap', ap);
            formData.append('group_sales', group_sales);
            formData.append('commission', commission);
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
            $.ajax({
                type: "POST",
                dataType: "json",
                data: formData, // Use FormData for files
                contentType: false,
                processData: false, // Important when using FormData
                url: "{{ route('admin.rank.store') }}",
                success: function(res) {
                    resetForm();
                    success_msg('Rank Added Successfully');
                    $('.rank_close').click();
                    $('.DataTable').DataTable().ajax.reload();
                },
                error: function(error) {
                    var errors = error.responseJSON.errors;                   
                    if (errors.commission) {
                        $('.commissionError').text(errors.commission);
                        $('#commission').addClass('border-danger is-invalid');
                        $('#commission').focus();
                        error('' + errors.commission )
                    }
                    if (errors.group_sales) {
                        $('.group_salesError').text(errors.group_sales);
                        $('#group_sales').addClass('border-danger is-invalid');
                        $('#group_sales').focus();
                        error('' + errors.group_sales )
                    }
                    if (errors.ap) {
                        $('.apError').text(errors.ap);
                        $('#ap').addClass('border-danger is-invalid');
                        $('#ap').focus();
                        error('' + errors.ap )
                    }
                    if (errors.name) {
                        $('.nameError').text(errors.name);
                        $('#name').addClass('border-danger is-invalid');
                        $('#name').focus();
                        error('' + errors.name )
                    }

                }
            });

        }

    </script>
@endpush
