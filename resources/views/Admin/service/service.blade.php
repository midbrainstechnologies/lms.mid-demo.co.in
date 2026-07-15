@extends('Admin.main')
@section('headerfile')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ url('asset_data/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('asset_data/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('asset_data/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection
@section('body')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                      <h1 class="m-0"> Services List</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
                        <li class="breadcrumb-item active">Services List</li>
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


                    <div class="col-12">
                        <div class="">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <?= !empty($seo['title']) ? $seo['title'] . ' List' : 'Admin Dashboard' ?></h3>
                            </div>
                            <!-- /.card-header -->



                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Id</th>
                                            <th>Service Name</th>
                                            <th>Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>   <?php $sr = 0;?>
                                        @foreach ($service as $list)
                                        <tr>
                                            <td>{{++$sr}}</td>
                                            <td>{{"LMS-".str_pad($list['id'], 3, '0', STR_PAD_LEFT)}}</td>

                                            <td>{{$list->name}}</td>
                                            <td>{{"Rs. ".$list->seq}}</td>

                                            <td>
                                                <div class="btn-group mt-2" role="group" aria-label="Basic outlined example">
                                                    <a data-bs-toggle="tooltip" title="Edit" href="{{url('/admin/service/'.Crypt::encrypt($list->id))}}" class="btn btn-outline-warning" ><i class="fa fa-edit text-success"></i></a>
                                                    <button type="button" onclick="deletemdl('{{Crypt::encrypt($list->id)}}')" class="btn btn-outline-warning"  title="Delete" ><i class="fa fa-trash text-danger"></i></button>

                                                    @if($list['status'] == 0)
                                                    <a href="{{asset('admin/service-active/'.Crypt::encrypt($list['id']))}}" class="btn btn-outline-warning" data-bs-toggle="tooltip" title="Active"><i class="fa fa-check text-success"></i></a>
                                                    @else
                                                    <a href="{{asset('admin/service-deactive/'.Crypt::encrypt($list['id']))}}" class="btn btn-outline-warning" data-bs-toggle="tooltip" title="Deactive"><i class="fa fa-close text-danger"></i></a>
                                                    @endif
                                                </div>
                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="row">
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title"><?= !empty($seo['title']) ? ((!empty($data))?' Update ':' Add '). $seo['title'] : 'Admin Dashboard' ?></h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="" method="POST">
                                @csrf
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" onchange="ToSeoUrl(this.value)" onkeypress="ToSeoUrl(this.value)" class="form-control" name="name" value="<?php if(isset($data->name)){echo $data->name;}?>" id="name" required="">
                                        @error('name')
                                            <span class="text-danger">{{ $message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="seq" class="form-label">Amount</label>
                                        <input type="number" class="form-control" name="seq" value="<?php if(isset($data->seq)){echo $data->seq;}?>" id="seq" required="">
                                        @error('seq')
                                            <span class="text-danger">{{ $message}}</span>
                                        @enderror
                                    </div>


                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">{{((!empty($data))?' Update Service ':' Add Service ')}}</button>
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

    <div class="modal fade" id="deletemdl" tabindex="-1"  aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
            <div class="modal-content">
                <form method="POST" action="{{asset('/admin/service/delete')}}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title  fw-bold" id="deleteprojectLabel"> Delete Permanently?</h5>
                        <button type="button" class="close"  onclick="closemdl()" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                    </div>
                    <div class="modal-body justify-content-center flex-column d-flex">
                        <i class="fa fa-trash text-danger display-2 text-center mt-2"></i>
                        <p class="mt-4 fs-5 text-center">You can only delete this Permanently</p>
                    </div>
                    <input type="hidden" name="id_delete" id="id_delete"/>
                    <div class="modal-footer">
                        <button type="button" onclick="closemdl()" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger color-fff">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('footerfile')
    <!-- DataTables  & Plugins -->
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

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        });
        function deletemdl(id){
            $("#id_delete").val(id);
            $('#deletemdl').modal('show');
        }
        function closemdl(){
            $("#id_delete").val('');
        }
    </script>
@endsection
