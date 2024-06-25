@extends('layouts.admin.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $pageTitle }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-secondary">
                        <div class="card-header">

                            <div class="row">
                                <div class="col-6" style="vertical-align: middle; margin: auto;">
                                    <h3 class="card-title text-light">{{ $pageTitle }}</h3>
                                </div>
                                <div class="col-6 text-right">
                                    <button type="button" id="addGenerationModalBtn"  class="btn btn-success text-right d-none"><i class="fas fa-plus-circle"></i> Add New</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table width='100%' class="table table-sm text-center" id="datatable">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>G. Name</th>
                                        <th>G. Serial</th>
                                        <th>G. Commision %</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>

                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    @include('admin.modals.add-Generation')
@endsection

@push('js')
    <script>
    var datatable;
        $(document).ready(function(){
            datatable= $('#datatable').DataTable({
                processing:true,
                serverSide:true,
                responsive:true,
                ajax:{
                url:"{{route('admin.generation.index')}}"
                },
                columns:[
                {
                    data:'DT_RowIndex',
                    name:'DT_RowIndex',
                    orderable:false,
                    searchable:false
                },
                {
                    data:'name',
                    name:'name',
                },
                {
                    data:'serial',
                    name:'serial',
                },
                {
                    data:'comission',
                    name:'comission',
                },
                {
                    data:'action',
                    name:'action',
                    className: 'text-center'
                }
                ]
            });
        })
        window.formRequest= function(){
            $('input,select').removeClass('is-invalid');
            let name=$('#name').val();
            let serial=$('#serial').val();
            let comission=$('#comission').val();
            let id=$('#id').val();
            let formData= new FormData();
            formData.append('name',name);
            formData.append('serial',serial);
            formData.append('comission',comission);
            $('#exampleModalLabel').text("Add New {{$data['title']}}");
            if(id!=''){
            formData.append('_method','PUT');
            }
            //axios post request
            if (id==''){
                axios.post("{{route('admin.generation.store')}}",formData)
                .then(function (response){
                    if(response.data.message){
                        toastr.success(response.data.message)
                        datatable.ajax.reload();
                        clear();
                        ModalHide();
                    }else if(response.data.error){
                    var keys=Object.keys(response.data.error);
                    keys.forEach(function(d){
                        $('#'+d).addClass('is-invalid');
                        $('#'+d+'_msg').text(response.data.error[d][0]);
                    })
                    }
                })
            }else{
            axios.post("{{URL::to('admin/generation/')}}/"+id,formData)
                .then(function (response){
                if(response.data.message){
                    toastr.success(response.data.message);
                    datatable.ajax.reload();
                    clear();
                }else if(response.data.error){
                    var keys=Object.keys(response.data.error);
                    keys.forEach(function(d){
                        $('#'+d).addClass('is-invalid')
                        $('#'+d+'_msg').text(response.data.error[d][0]);
                    })
                    }
                })
            }
        }
        $(document).delegate("#modalBtn", "click", function(event){
            clear();
            $('#exampleModalLabel').text("Add New {{$data['title']}}");

        });
        $(document).delegate(".editRow", "click", function(){
            $('#exampleModalLabel').text("Update {{$data['title']}}");
            let route=$(this).data('url');
            axios.get(route)
            .then((data)=>{
            var editKeys=Object.keys(data.data);
            editKeys.forEach(function(key){
                if(key=='name'){
                $('#'+'name').val(data.data[key]);
                }
                $('#'+key).val(data.data[key]);
                $('#modal').modal('show');
                $('#id').val(data.data.id);
            })
            })
        });
        $(document).delegate(".deleteRow", "click", function(){
            let route=$(this).data('url');
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.value==true) {
                axios.delete(route)
                .then((data)=>{
                    console.log(data);
                if(data.data.message){
                    toastr.success(data.data.message);
                    datatable.ajax.reload();
                }else if(data.data.warning){
                    toastr.error(data.data.warning);
                }
                })
            }
            })
        });
        $('#parent_category').select2({
            theme:'bootstrap4',
            placeholder:'select',
            allowClear:true,
            ajax:{
            url:"{{URL::to('/news/get-category')}}",
            type:'post',
            dataType:'json',
            delay:20,
            data:function(params){
                return {
                searchTerm:params.term,
                _token:"{{csrf_token()}}",
                }
            },
            processResults:function(response){
                return {
                results:response,
                }
            },
            cache:true,
            }
        })

        function ModalHide()
        {
            const button = document.querySelector('#modalClose');
            button.click();
        }
        function clear(){
        $("input").removeClass('is-invalid').val('');
        $(".invalid-feedback").text('');
        }

    </script>
@endpush

