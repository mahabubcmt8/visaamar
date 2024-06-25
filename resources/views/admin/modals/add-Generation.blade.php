<div class="modal fade transaction-detailModal" tabindex="-1" role="dialog"
aria-labelledby="transaction-detailModalLabel" aria-hidden="true" id="modal">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="transaction-detailModalLabel">{{ $data['title'] }}</h5>
            <button  type="button"  data-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <form>
                <input type="hidden" id="id">
                <div class="mb-3">
                    <label for="formrow-firstname-input" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter Generation Name">
                    <span class="text-danger " id="name_Error"></span>
                </div>
                <div class="mb-3">
                    <label for="formrow-firstname-input" class="form-label">Serial</label>
                    <input type="number" class="form-control" id="serial" placeholder="Enter Serial" readonly>
                    <span class="text-danger " id="serial_Error"></span>
                </div>
                <div class="mb-3">
                    <label for="formrow-firstname-input" class="form-label">Comission %</label>
                    <input type="number" class="form-control" id="comission" placeholder="Enter Comission">
                    <span class="text-danger " id="comission_Error"></span>
                </div>
                <input type="hidden" name="" id="row_id">
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal" id="generationModalClose">Close</button>
            <button type="submit" class="btn btn-primary w-md" id="addGeneration" onclick="addGeneration()">Submit</button>
            <button type="submit" class="btn btn-success w-md " id="updateGeneration" onclick="UpdateGeneration()">Update</button>
        </div>
    </div>
</div>
</div>
@push('js')
    <script>
        $(document)
        $('#addGenerationModalBtn').click(function() {
            resetForm();
            $('#addGeneration').removeClass('d-none');
            $('#updateGeneration').addClass('d-none');
            $('#modal').modal('show');
        });

        // Reset Category Data
            function resetForm(){
            // $('#rank').val('').toggle('change');
            $('#name').val('');
            $('#name_Error').text('');
            $('#name_Error').removeClass('is-invalid');

            $('#serial').val('');
            $('#serial_Error').text('');
            $('#serial_Error').removeClass('is-invalid');


            $('#comission').val('');
            $('#comission_Error').text('');
            $('#comission_Error').removeClass('is-invalid');


        }
        function addGeneration(){
            var name = $('#name').val();
            var serial = $('#serial').val();
            var comission = $('#comission').val();

            var formData = new FormData();
            formData.append('name', name);
            formData.append('serial', serial);
            formData.append('comission', comission);

            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
            $.ajax({
                type: "POST",
                dataType: "json",
                data: formData, // Use FormData for files
                contentType: false,
                processData: false, // Important when using FormData
                url: "{{ route('admin.generation.store') }}",
                success: function(res) {
                    resetForm();
                    success_msg('Generation Added Successfully');
                    $('#generationModalClose').click();
                    $('#datatable').DataTable().ajax.reload();
                },
                error: function(error) {
                    var errors = error.responseJSON.errors;
                    if (errors.name) {
                        $('#name_Error').text(errors.name);
                        $('#name').addClass('border-danger is-invalid');
                        $('#name').focus();
                        error('' + errors.name )
                    }
                    if (errors.serial) {
                        $('#serial_Error').text(errors.serial);
                        $('#serial').addClass('border-danger is-invalid');
                        $('#serial').focus();
                        error('' + errors.serial )
                    }
                    if (errors.comission) {
                        $('#comission_Error').text(errors.comission);
                        $('#comission').addClass('border-danger is-invalid');
                        $('#comission').focus();
                        error('' + errors.comission )
                    }
                }
            });
        }
    // Generation Get Data For Edit
    function edit(id){
        resetForm();
        var url = "{{ route('admin.generation.edit', ':id') }}";
        url = url.replace(':id', id);
        $.ajax({
            type: "GET",
            url: url,
            success: function(data) {
                $('#row_id').val(data.id);
                $('#name').val(data.name);
                $('#serial').val(data.serial);
                $('#comission').val(data.comission);

                $('#addGeneration').addClass('d-none');
                $('#updateGeneration').removeClass('d-none');
                $('#modal').modal('show');
            }
        });
    }
         // Category Delete
    function destroy(id){
        var url = "{{ route('admin.generation.destroy', ':id') }}";
        url = url.replace(':id', id);
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "GET",
                        url: url,
                        success: function(data) {
                            if(data === 'data_have'){
                                warning_msg('There is some data here so it cannot be deleted.');
                            }
                            else{
                                success_msg('Generation Deleted Successfully.');
                                $('#datatable').DataTable().ajax.reload();
                            }
                        },
                        error: function(){
                            warning_msg('Leadership Not Found!');
                        }
                    });
                }
            });
        }
       // Generation Update
        function UpdateGeneration(){
            var data_id = $('#row_id').val();
            var name = $('#name').val();
            var serial = $('#serial').val();
            var comission = $('#comission').val();

            var formData2 = new FormData();
            formData2.append('id', data_id);
            formData2.append('name', name);
            formData2.append('serial', serial);
            formData2.append('comission', comission);
            formData2.append('_token', $('meta[name="csrf-token"]').attr('content'));

            var url = '{{ route('admin.generation.update', ':id') }}';
            url = url.replace(':id', data_id);
            $.ajax({
                type: "POST",
                dataType: "json",
                data: formData2, // Use FormData for files
                contentType: false,
                processData: false, // Important when using FormData
                url: url,
                success: function(res) {
                    resetForm();
                    $('#Leadership_id').val('');
                    success_msg('Generation Update Successfully');
                    $('#generationModalClose').click();
                    $('#datatable').DataTable().ajax.reload();
                },
                error: function(error) {
                    var errors = error.responseJSON.errors;
                    if (errors.name) {
                        $('#nameError').text(errors.name);
                        $('#name').addClass('border-danger is-invalid');
                        $('#name').focus();
                        error('' + errors.name )
                    }
                    if (errors.serial) {
                        $('.serialError').text(errors.serial);
                        $('#serial').addClass('border-danger is-invalid');
                        $('#serial').focus();
                        error('' + errors.serial )
                    }
                    if (errors.comission) {
                        $('#comissionError').text(errors.comission);
                        $('#comission').addClass('border-danger is-invalid');
                        $('#comission').focus();
                        error('' + errors.comission )
                    }
                }
            });
        }

    </script>
@endpush
