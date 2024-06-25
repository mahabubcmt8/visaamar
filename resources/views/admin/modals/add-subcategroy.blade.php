<!-- Modal -->
<div class="modal fade" id="addSubCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary py-3">
                <h5 class="modal-title text-white" id="exampleModalLabel1">Sub Category</h5>
                <button type="button" class="close sub_category_close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="sub_category_id">
                <div class="row">
                    <div class="col mb-3">
                        <label for="category_id" class="form-label">Select Category <span class="text-danger">*</span></label>
                        <select name="category_id" id="category_id" class="form-control select2">
                        </select>
                        <span class="text-danger category_id_Error"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="sub_category_name" class="form-label">Sub Category Name <span class="text-danger">*</span></label>
                        <input type="text" id="sub_category_name" name="sub_category_name" class="form-control" placeholder="Enter Sub Category Name"/>

                        <span class="text-danger sub_category_name_Error"></span> <br>
                        <span class="text-danger sub_slug_Error"></span>
                    </div>
                </div>
                <div class="row d-none">
                    <div class="col mb-3">
                        <label for="sub_slug" class="form-label">Sub Category Slug <span class="text-danger">*</span></label>
                        <input type="text" id="sub_slug" name="sub_slug" class="form-control" value="{{ old('slug') }}" placeholder="Enter Sub Category Slug" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" id="formSubSubmit" class="btn btn-warning" onclick="SubResetForm();">Reset</button>
                <button type="button" id="addSubCategory" class="btn btn-primary" onclick="addSubCategory();">Add</button>
                <button type="button" id="UpdateSubCategory" class="btn btn-primary d-none" onclick="UpdateSubCategory();">Update</button>
            </div>
        </div>
    </div>
</div>
@push('js')
    @include('layouts.admin.all-select2')
    <script>
        $(document).ready(function (){
            category();
        });

        $('#addSubCategoryModalBtn').click(function() {
            SubResetForm();
            $('#addSubCategory').removeClass('d-none');
            $('#UpdateSubCategory').addClass('d-none');
            $('#addSubCategoryModal').modal('show');
        });

        // Category Slug Making
        $('#sub_category_name').keyup(function() {
            $('#sub_slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g,"-"));
        });

        // Reset Category Data
        function SubResetForm(){
            $('#category_id').val('').trigger('change');
            $('#sub_category_name').val('');
            $('#sub_slug').val('');

            $('.category_id_Error').text('');
            $('#category_id').removeClass('border-danger is-invalid');

            $('.sub_category_name_Error').text('');
            $('#sub_category_name').removeClass('border-danger is-invalid');

            $('.sub_slug_Error').text('');
            $('#sub_slug').removeClass('border-danger is-invalid');
        }

        // Category Added
        function addSubCategory(){
            var name = $('#sub_category_name').val();
            var slug = $('#sub_slug').val();
            var category_id = $('#category_id').val();

            var formData = new FormData();
            formData.append('category_id', category_id);
            formData.append('subcategory', name);
            formData.append('slug', slug);
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
            $.ajax({
                type: "POST",
                dataType: "json",
                data: formData, // Use FormData for files
                contentType: false,
                processData: false, // Important when using FormData
                url: "{{ route('admin.subcategory.store') }}",
                success: function(res) {
                    SubResetForm();
                    success_msg('Sub Category Added Successfully');
                    $('.sub_category_close').click();
                    $('.DataTable').DataTable().ajax.reload();
                },
                error: function(error) {
                    var errors = error.responseJSON.errors;
                    if (errors.slug) {
                        $('.sub_slug_Error').text(errors.slug);
                        $('#sub_slug').addClass('border-danger is-invalid');
                        $('#sub_slug').focus();
                        error_msg(''+errors.slug);
                    }
                    if (errors.subcategory) {
                        $('.sub_category_name_Error').text(errors.subcategory);
                        $('#sub_category_name').addClass('border-danger is-invalid');
                        $('#sub_category_name').focus();
                        error_msg(''+errors.subcategory);
                    }
                    if (errors.category_id) {
                        $('.category_id_Error').text(errors.category_id);
                        $('#category_id').addClass('border-danger is-invalid');
                        $('#category_id').focus();
                        error_msg(''+errors.category_id);
                    }
                }
            });


        }
    </script>
@endpush
