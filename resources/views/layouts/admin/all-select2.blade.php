<script>
    function users(){
        $.ajax({
            url: "{{ route('get.users') }}",
            dataType: 'json',
            success: function(data) {
                var html = '';
                $.each(data, function(index, value) {
                    html += '<option value="">Select</option>';
                    html += '<option value="' + value.username + '">' + value.name + '</option>';
                });
                $('#user').html(html);
            }
        });

        $("#user").select2({
            placeholder: "Select User",
        });
    }

    function category(){
        $.ajax({
            url: "{{ route('get.category') }}",
            dataType: 'json',
            success: function(data) {
                var html = '';
                $.each(data, function(index, value) {
                    html += '<option value="">Select</option>';
                    html += '<option value="' + value.id + '">' + value.category_name + '</option>';
                });
                $('#category_id').html(html);
            }
        });

        $("#category_id").select2({
            placeholder: "Select Category",
        });
    }

    function sub_category(cat_id){
        var url = "{{ route('get.subcategory', ':id') }}";
        url = url.replace(':id', cat_id);
        $.ajax({
            url: url,
            dataType: 'json',
            success: function(data) {
                var html = '';
                $.each(data, function(index, value) {
                    html += '<option value="">Select</option>';
                    html += '<option value="' + value.id + '">' + value.subcategory + '</option>';
                });
                $('#subcategory_id').html(html);
            }
        });

        $("#subcategory_id").select2({
            placeholder: "Select Sub Category",
        });
    }




</script>
