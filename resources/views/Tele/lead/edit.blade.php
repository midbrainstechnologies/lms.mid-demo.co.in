@extends('LeadCreator.main')
@section('headerfile')
    <!-- DataTables -->
    {{-- <link rel="stylesheet" href="{{ url('asset_data/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('asset_data/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('asset_data/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}"> --}}
@endsection
@section('body')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><?= !empty($seo['title']) ? $seo['title'] : 'Admin Dashboard' ?> </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/tele-caller') }}">Home</a></li>
                            <li class="breadcrumb-item active">
                                <?= !empty($seo['title']) ? $seo['title'] : 'Admin Dashboard' ?></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row clearfix g-3">
                    <div class="col-sm-12">
                        @if (Session()->has('error'))
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert"
                                    aria-hidden="true">&times;</button>
                                <h5><i class="fa fa-times"></i> Uff!</h5>
                                {{ Session()->get('error') }}
                            </div>
                        @endif
                        @if (Session()->has('success'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert"
                                    aria-hidden="true">&times;</button>
                                <h5><i class="fa fa-check"></i> Success!</h5>
                                {{ Session()->get('success') }}
                            </div>
                        @endif


                    </div>
                </div>





                <div class="row">
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title"><?= !empty($seo['title']) ? ((!empty($leads))?' Update ':' Add '). $seo['title'] : 'Admin Dashboard' ?></h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="" method="POST">
                                @csrf
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="master_type">Select Master's</label>
                                         <select id="master_type"  required name="master_type" class="form-control select2" style="width: 100%;">
                                            <option value="">Select Master's</option>
                                            @foreach ($categorymaster as $list)
                                                <option <?=!empty($leads['masterid'])?(($leads['masterid'] == $list['id'])?'selected':''):''?> value="{{$list['id']}}">{{$list['name']}}</option>
                                            @endforeach
                                            <option value="other">Other</option>

                                        </select>
                                        <input  type="hidden" name="master_type_name" class="form-control" id="master_type_name" placeholder="Enter Master Name" >
                                        @error('master_type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input required type="text" name="name" class="form-control"
                                            id="name" value="{{$leads['name']}}" placeholder="Enter Name" >
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile">Mobile No.</label>
                                        <input required type="text" name="mobile" class="form-control"
                                            id="mobile" value="{{$leads['mobile']}}" placeholder="Enter Mobile No." >
                                        @error('mobile')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input  type="email" name="email" class="form-control"
                                            id="email" value="{{$leads['email']}}" placeholder="Enter Email" >

                                    </div>
                                    <div class="form-group">
                                        <label for="company">Company Name</label>
                                        <input  type="text" name="company" class="form-control"
                                            id="company" value="{{$leads['company']}}" placeholder="Enter Company Name"  >

                                    </div>
                                    <div class="form-group">
                                        <label for="source">Lead Source</label>
                                        <input  type="text" name="source" class="form-control"
                                            id="source" value="{{$leads['source']}}"  placeholder="Enter Source" >

                                    </div>
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input  type="text" name="title" class="form-control"
                                            id="title" value="{{$leads['title']}}" placeholder="Enter Title" >

                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" class="form-control"
                                            id="description"   placeholder="Enter description" >{{$leads['description']}}</textarea>

                                    </div>


                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">{{((!empty($leads))?' Update '.(!empty($seo['title']) ? $seo['title']:'Lead'):' Add '.(!empty($seo['title']) ? $seo['title']:'Lead'))}}</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->



@endsection
@section('footerfile')
    {{-- <!-- DataTables  & Plugins -->
    <script src="{{ url('asset_data/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('asset_data/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ url('asset_data/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('asset_data/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ url('asset_data/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ url('asset_data/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ url('asset_data/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ url('asset_data/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ url('asset_data/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ url('asset_data/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ url('asset_data/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ url('asset_data/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- Bootstrap Switch -->
    <script src="{{ url('asset_data/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script> --}}
    <script>
        $(function() {
            // $("#example1").DataTable({
            //     "responsive": true,
            //     "lengthChange": false,
            //     "autoWidth": false,
            //     "buttons": ["excel", "pdf", "print"]
            // }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            // $("input[data-bootstrap-switch]").each(function(){
            //     $(this).bootstrapSwitch('state', $(this).prop('checked'));
            // })
            $('#master_type').on('change',function(){

                if($(this).val() == "other"){
                    $("#master_type_name").prop('required',true);
                    $("#master_type_name").attr('type','tsxt');

                }else{
                    $("#master_type_name").prop('required',false);
                    $("#master_type_name").attr('type','hidden');

                }
            })
        });
        // function deletemdl(id){
        //     $("#id_delete").val(id);
        //     $('#deletemdl').modal('show');
        // }
        // function closemdl(){
        //     $("#id_delete").val('');
        // }
    </script>
@endsection
