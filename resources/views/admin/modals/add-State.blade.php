<!-- Modal -->
<div class="modal fade" id="addStateModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary py-3">
                <h5 class="modal-title text-white" id="exampleModalLabel1">State</h5>
                <button type="button" class="close state_close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="rank_id">
                <div class="row">
                    <div class="col-12 mb-1">
                        <label for="country_id" class="form-label">Select Country <span class="text-danger">*</span></label>
                        <select name="country_id" id="country_id" class="form-control select2" style="display: block !important;">
                            <option value="" selected>Select</option>
                            @foreach ($countries as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger rank_Error"></span>
                    </div>
                    <div class="col-12 mb-1">
                        <label for="state_name" class="form-label">State Name <span class="text-danger">*</span></label>
                        <input type="text" id="state_name" name="state_name" class="form-control " placeholder="Enter State Name"/>
                        <span class="text-danger state_name_Error"></span>
                    </div>
                    <div class="col-12 mb-1">
                        <label for="postal_code" class="form-label">Postal Code <span class="text-danger">*</span></label>
                        <input type="text" id="postal_code" name="postal_code" class="form-control " placeholder="Enter Postal_code"/>
                        <span class="text-danger postal_code_Error"></span>
                    </div>
                    <div class="col-12 mb-1">
                        <label for="tele_code" class="form-label">Tele code <span class="text-danger">*</span></label>
                        <input type="text" id="tele_code" name="tele_code" class="form-control " placeholder="Enter Tele Code"/>
                        <span class="text-danger tele_code_Error"></span>
                    </div>
                </div>
                <input type="hidden" name="row_id" id="row_id">
            </div>
            <div class="modal-body">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" id="formSubmit" class="btn btn-warning" onclick="resetForm();">Reset</button>
                <button type="button" id="addState" class="btn btn-primary" onclick="addState();">Add</button>
                <button type="button" id="UpdateState" class="btn btn-primary d-none" onclick="UpdateState();">Update</button>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        $(document)
        $('#addStateModalBtn').click(function() {
            resetForm();
            $('#addState').removeClass('d-none');
            $('#UpdateState').addClass('d-none');
            $('#addStateModal').modal('show');
        });

        // Reset Category Data
        function resetForm(){

            $('#state_name').val('');
            $('.state_name_Error').text('');

            $('#postal_code').val('');
            $('.postal_code_Error').text('');

            $('#tele_code').val('');
            $('.tele_code_Error').text('');

            $('#country_id').val('').trigger('change');
            $('.country_id_Error').text('');

        }

        function addState(){
            var state_name = $('#state_name').val();
            var country_id = $('#country_id').val();
            var postal_code = $('#postal_code').val();
            var tele_code = $('#tele_code').val();

            var formData = new FormData();
            formData.append('state_name', state_name);
            formData.append('country_id', country_id);
            formData.append('postal_code', postal_code);
            formData.append('tele_code', tele_code);

            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
            $.ajax({
                type: "POST",
                dataType: "json",
                data: formData, // Use FormData for files
                contentType: false,
                processData: false, // Important when using FormData
                url: "{{ route('admin.settings.state.store') }}",
                success: function(res) {
                    resetForm();
                    success_msg('State Added Successfully');
                    $('.state_close').click();
                    $('#datatable').DataTable().ajax.reload();
                },
                error: function(error) {
                    var errors = error.responseJSON.errors;
                    if (errors.name) {
                        $('.state_name_Error').text(errors.name);
                        $('#state_name').addClass('border-danger is-invalid');
                        $('#state_name').focus();
                        error('' + errors.name )
                    }
                    if (errors.country_id) {
                        $('.country_id_Error').text(errors.country_id);
                        $('#country_id').addClass('border-danger is-invalid');
                        $('#country_id').focus();
                        error('' + errors.country_id )
                    }
                    if (errors.postal_code) {
                        $('.postal_code_Error').text(errors.postal_code);
                        $('#postal_code').addClass('border-danger is-invalid');
                        $('#postal_code').focus();
                        error('' + errors.postal_code )
                    }
                    if (errors.tele_code) {
                        $('.tele_code_Error').text(errors.tele_code);
                        $('#tele_code').addClass('border-danger is-invalid');
                        $('#tele_code').focus();
                        error('' + errors.tele_code )
                    }
                }
            });

        }

    </script>
@endpush
