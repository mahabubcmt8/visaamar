<!-- Modal -->
<div class="modal fade" id="addLeadershipModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary py-3">
                <h5 class="modal-title text-white" id="exampleModalLabel1">Rank</h5>
                <button type="button" class="close leadership_close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="rank_id">
                <div class="row">
                    <div class="col-12 mb-1">
                        <label for="rank" class="form-label">Select Rank <span class="text-danger">*</span></label>
                        <select name="rank" id="rank" class="form-control" style="display: block !important;">
                            <option value="" selected>Select</option>
                            @foreach ($rank as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger rank_Error"></span>
                    </div>
                    <div class="col-12 mb-1">
                        <label for="lavel_1" class="form-label">Lavel 1 <span class="text-danger">*</span></label>
                        <input type="number" id="lavel_1" name="lavel_1" class="form-control " placeholder="Enter Level One"/>
                        <span class="text-danger lavel_1Error"></span>
                    </div>
                    <div class="col-12 mb-1">
                        <label for="lavel_2" class="form-label">Lavel 2 <span class="text-danger">*</span></label>
                        <input type="number" id="lavel_2" name="lavel_2" class="form-control " placeholder="Enter Level Two"/>
                        <span class="text-danger lavel_2Error"></span>
                    </div>
                    <div class="col-12 mb-1">
                        <label for="lavel_3" class="form-label">Lavel 3 <span class="text-danger">*</span></label>
                        <input type="number" id="lavel_3" name="lavel_3" class="form-control " placeholder="Enter Level Three"/>
                        <span class="text-danger lavel_3Error"></span>
                    </div>
                    <div class="col-12 mb-1">
                        <label for="lavel_4" class="form-label">Lavel 4 <span class="text-danger">*</span></label>
                        <input type="number" id="lavel_4" name="lavel_4" class="form-control " placeholder="Enter Level Four"/>
                        <span class="text-danger lavel_4Error"></span>
                    </div>
                    <div class="col-12 mb-1">
                        <label for="lavel_5" class="form-label">Lavel 5 <span class="text-danger">*</span></label>
                        <input type="number" id="lavel_5" name="lavel_5" class="form-control " placeholder="Enter Level Five"/>
                        <span class="text-danger lavel_5Error"></span>
                    </div>
                    <div class="col-12 mb-1">
                        <label for="lavel_6" class="form-label">Lavel 6 <span class="text-danger">*</span></label>
                        <input type="number" id="lavel_6" name="lavel_6" class="form-control " placeholder="Enter Level Six"/>
                        <span class="text-danger lavel_6Error"></span>
                    </div>
                    <div class="col-12 mb-1">
                        <label for="lavel_7" class="form-label">Lavel 7 <span class="text-danger">*</span></label>
                        <input type="number" id="lavel_7" name="lavel_7" class="form-control " placeholder="Enter Level Seven"/>
                        <span class="text-danger lavel_7Error"></span>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" id="formSubmit" class="btn btn-warning" onclick="resetForm();">Reset</button>
                <button type="button" id="addLeadership" class="btn btn-primary" onclick="addLeadership();">Add</button>
                <button type="button" id="UpdateLeadership" class="btn btn-primary d-none" onclick="UpdateLeadership();">Update</button>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        $(document)
        $('#addLeadershipModalBtn').click(function() {
            resetForm();
            $('#addLeadership').removeClass('d-none');
            $('#UpdateLeadership').addClass('d-none');
            $('#addLeadershipModal').modal('show');
        });

        // Reset Category Data
        function resetForm(){
            // $('#rank').val('').toggle('change');
            $('.rank_Error').text('');

            $('#lavel_1').val('');
            $('.lavel_1Error').text('');

            $('#lavel_2').val('');
            $('.lavel_2Error').text('');

            $('#lavel_3').val('');
            $('.lavel_3Error').text('');

            $('#lavel_4').val('');
            $('.lavel_4Error').text('');

            $('#lavel_5').val('');
            $('.lavel_5Error').text('');

            $('#lavel_6').val('');
            $('.lavel_6Error').text('');

            $('#lavel_7').val('');
            $('.lavel_7Error').text('');

        }

        function addLeadership(){
            var rank = $('#rank').val();
            var lavel_1 = $('#lavel_1').val();
            var lavel_2 = $('#lavel_2').val();
            var lavel_3 = $('#lavel_3').val();
            var lavel_4 = $('#lavel_4').val();
            var lavel_5 = $('#lavel_5').val();
            var lavel_6 = $('#lavel_6').val();
            var lavel_7 = $('#lavel_7').val();

            var formData = new FormData();
            formData.append('rank', rank);
            formData.append('lavel_1', lavel_1);
            formData.append('lavel_2', lavel_2);
            formData.append('lavel_3', lavel_3);
            formData.append('lavel_4', lavel_4);
            formData.append('lavel_5', lavel_5);
            formData.append('lavel_6', lavel_6);
            formData.append('lavel_7', lavel_7);
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
            $.ajax({
                type: "POST",
                dataType: "json",
                data: formData, // Use FormData for files
                contentType: false,
                processData: false, // Important when using FormData
                url: "{{ route('admin.leadership.store') }}",
                success: function(res) {
                    resetForm();
                    success_msg('Leadership Added Successfully');
                    $('.leadership_close').click();
                    $('.DataTable').DataTable().ajax.reload();
                },
                error: function(error) {
                    var errors = error.responseJSON.errors;
                    if (errors.lavel_1) {
                        $('.lavel_1Error').text(errors.lavel_1);
                        $('#lavel_1').addClass('border-danger is-invalid');
                        $('#lavel_1').focus();
                        error('' + errors.lavel_1 )
                    }
                    if (errors.lavel_2) {
                        $('.lavel_2Error').text(errors.lavel_2);
                        $('#lavel_2').addClass('border-danger is-invalid');
                        $('#lavel_2').focus();
                        error('' + errors.lavel_2 )
                    }
                    if (errors.lavel_3) {
                        $('.lavel_3Error').text(errors.lavel_3);
                        $('#lavel_3').addClass('border-danger is-invalid');
                        $('#lavel_3').focus();
                        error('' + errors.lavel_3 )
                    }
                    if (errors.lavel_4) {
                        $('.lavel_4Error').text(errors.lavel_4);
                        $('#lavel_4').addClass('border-danger is-invalid');
                        $('#lavel_4').focus();
                        error('' + errors.lavel_4 )
                    }
                    if (errors.lavel_5) {
                        $('.lavel_5Error').text(errors.lavel_5);
                        $('#lavel_5').addClass('border-danger is-invalid');
                        $('#lavel_5').focus();
                        error('' + errors.lavel_5 )
                    }
                    if (errors.lavel_6) {
                        $('.lavel_6Error').text(errors.lavel_6);
                        $('#lavel_6').addClass('border-danger is-invalid');
                        $('#lavel_6').focus();
                        error('' + errors.lavel_6 )
                    }
                    if (errors.lavel_7) {
                        $('.lavel_7Error').text(errors.lavel_7);
                        $('#lavel_7').addClass('border-danger is-invalid');
                        $('#lavel_7').focus();
                        error('' + errors.lavel_7 )
                    }

                    if (errors.rank) {
                        $('.rankError').text(errors.rank);
                        $('#rank').addClass('border-danger is-invalid');
                        $('#rank').focus();
                        error('' + errors.rank )
                    }

                }
            });

        }

    </script>
@endpush
