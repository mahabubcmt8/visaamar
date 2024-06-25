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
                <div class="col-12 mt-2">
                    <label for="">Rank</label>
                    <table class="table table-borderd" id="club-rank-data">
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="col-12 mt-2">
                    <button type="button" class="btn btn-sm btn-primary" onclick="addInfo();">Add New</button>
                </div>
                <input type="hidden" name="" id="row_id">
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal" id="clubModalClose">Close</button>
            <button type="submit" class="btn btn-primary w-md" id="addGeneration" onclick="addClubBonusDetails()">Submit</button>
            <button type="submit" class="btn btn-success w-md " id="updateGeneration" onclick="UpdateClub()">Update</button>
        </div>
    </div>
</div>
</div>
@push('js')
    <script>
        $('#clubModalClose').click(function(){
            resetForm();
            $("#club-rank-data tbody").html('');
        });
        $(document).on('click', '.delete-row', function() {
            $(this).closest('tr').remove();
        });
        $(document).ready(function() {
            rank();
        });
        function addInfo() {
            var rowCount = $("#club-rank-data tbody tr").length + 1; // initial row index number
            var newRow = $(
                '<tr>' +
                '<td class="text-center" style="width: 50%;"><select name="rank_id[]" class="form-control select2 rank_id_' + rowCount + '"></select></td>' +
                '<td class="text-center" style="width: 50%;"><input required type="text" class="form-control bonus" placeholder="Bonus" name="bonus[]"></td>' +
                '<td class="text-center" style="width: 40px;"><input type="hidden" name="row_id[]" value="'+ rowCount +'"><button type="button" class="btn btn-sm btn-danger p-1 px-2 delete-row">X</button></td>' +
                '</tr>'
            );
            $("#club-rank-data tbody").append(newRow);
            rank(rowCount); // Pass rowCount to rank function
        }

        function rank(rowCount) {
            $.ajax({
                url: "{{ route('get.rank') }}",
                dataType: 'json',
                success: function(data) {
                    var html = '<option value="">Select</option>';
                    $.each(data, function(index, value) {
                        html += '<option value="' + value.id + '">' + value.name + '</option>';
                    });

                    // Remove existing options and add new ones
                    $('.rank_id_' + rowCount).html(html);

                    // Initialize or update Select2 for the specific dropdown
                    $('.rank_id_' + rowCount).select2({
                        placeholder: "Select Rank",
                    });
                }
            });
        }

        // Call rank function for initial rows
        $(document).ready(function() {
            rank(1); // You might need to adjust this based on your initial row count
        });
        $(document)
        $('#addClubBonusModalBtn').click(function() {
            // resetForm();
            $('#addGeneration').removeClass('d-none');
            $('#updateGeneration').addClass('d-none');
            $('#modal').modal('show');
            resetForm();
        });

        // Reset Category Data
            function resetForm(){
                // $('#rank').val('').toggle('change');
                $('#name').val('');
                $('#name_Error').text('');
                $('#name_Error').removeClass('is-invalid');

            $("#club-rank-data tbody").html('');
        }
        function addClubBonusDetails(){
            var name = $('#name').val();
            var formData = new FormData();

            formData.append('name', name);

            var tableData = [];
            $('#club-rank-data tbody tr').each(function() {
                var row = $(this);
                var rowData = {
                    row_id: row.find('[name="row_id"]').val(),
                    rank_id: row.find('[name="rank_id[]"]').val(),
                    bonus: row.find('[name="bonus[]"]').val(),
                };
                tableData.push(rowData);
            });

            // Convert the tableData array to a JSON string and append it to formData
            formData.append('tableData', JSON.stringify(tableData));

            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
            $.ajax({
                type: "POST",
                dataType: "json",
                data: formData, // Use FormData for files
                contentType: false,
                processData: false, // Important when using FormData
                url: "{{ route('admin.club_bonus_details.store') }}",
                success: function(res) {
                    resetForm();
                    success_msg('Club Bonus Added Successfully');
                    $('#clubModalClose').click();
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
                }
            });
        }
    // Generation Get Data For Edit
    function edit(id){
        resetForm();

        var url = "{{ route('admin.club_bonus_details.edit', ':id') }}";
        url = url.replace(':id', id);
        $.ajax({
            type: "GET",
            url: url,
            success: function(data) {
                $('#row_id').val(data.id);
                $('#name').val(data.name);
               var assets = data.asset_items;

               $.each(assets, function(index, value) {
                    var rowCount = $("#club-rank-data tbody tr").length + 1; // initial row index number
                    var newRow = $(
                        '<tr>' +
                        '<td class="text-center" style="width: 50%;"><select name="rank_id[]" class="form-control select2 rank_id_'+ rowCount+'" id="rank_id_'+ rowCount+'""></select></td>' +
                        '<td class="text-center" style="width: 50%;"><input required type="text" class="form-control bonus" placeholder="Bonus" name="bonus[]" value="'+value.bonus+'"><input type="hidden" value="'+value.id+'" id="asset_id" name="asset_id[]"></td>' +
                        '<td class="text-center" style="width: 40px;"><input type="hidden" name="row_id[]" value="'+ rowCount +'"><button type="button" class="btn btn-sm btn-danger p-1 px-2 delete-row">X</button></td>' +
                        '</tr>'
                    );
                    $("#club-rank-data tbody").append(newRow);
                    rank(rowCount);
                    console.log('#rank_id_' + rowCount);
                    setTimeout(() => {
                        $('#rank_id_' + rowCount).val(value.rank_id).trigger('change');
                    }, 1000);
                });
                $('#addGeneration').addClass('d-none');
                $('#updateGeneration').removeClass('d-none');
                $('#modal').modal('show');
            }
        });
    }
         // Category Delete
    function destroy(id){
        var url = "{{ route('admin.club_bonus_details.destroy', ':id') }}";
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
                                success_msg('Club Bonus Details Deleted Successfully.');
                                $('#datatable').DataTable().ajax.reload();
                            }
                        },
                        error: function(){
                            warning_msg('Club Bonus Details Not Found!');
                        }
                    });
                }
            });
        }
       // Generation Update
        function UpdateClub(){
            var data_id = $('#row_id').val();
            var name = $('#name').val();
            var formData2 = new FormData();

            formData2.append('name', name);

            var tableData = [];
            $('#club-rank-data tbody tr').each(function() {
                var row = $(this);
                var rowData = {
                    row_id: row.find('[name="row_id"]').val(),
                    rank_id: row.find('[name="rank_id[]"]').val(),
                    bonus: row.find('[name="bonus[]"]').val(),
                    asset_id: row.find('[name="asset_id[]"]').val(),
                };
                tableData.push(rowData);
            });

            // Convert the tableData array to a JSON string and append it to formData
            formData2.append('tableData', JSON.stringify(tableData));
            formData2.append('_token', $('meta[name="csrf-token"]').attr('content'));

            var url = '{{ route('admin.club_bonus_details.update', ':id') }}';
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
                    success_msg('Club Details Update Successfully');
                    $('#clubModalClose').click();
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

                }
            });
        }

    </script>
@endpush
