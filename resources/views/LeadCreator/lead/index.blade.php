@extends('LeadCreator.main')
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
                        {{-- <h1 class="m-0"><?= !empty($seo['title']) ? $seo['title'] : 'Admin Dashboard' ?> </h1> --}}
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/lead-creater') }}">Home</a></li>
                            <li class="breadcrumb-item active">
                                <?= !empty($seo['title']) ? $seo['title'] : 'Admin Dashboard' ?></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <form method="POST" >
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
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <?= !empty($seo['title']) ? $seo['title'] . ' List' : 'Admin Dashboard' ?></h3>
                            </div>
                            <!-- /.card-header -->


                            @csrf
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th></th>
                                            <th>ID</th>
                                            <th>Category</th>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>Email</th>
                                            <th>Title</th>
                                            <th>Date</th>

                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody> <?php $srno = 0; ?>
                                        @foreach ($leads as $list)
                                            <tr>
                                                <td><?= ++$srno ?></td>
                                                <td>
                                                    <?php

                                                        $checklead = App\Models\LeadMS::select()->where('lead_id',$list['id'])->where('is_delete','0')->count();
                                                        if($checklead == 0){
                                                        ?>
                                                    <div class="icheck-primary d-inline ml-2">
                                                        <input type="checkbox" value="{{$list['id']}}" name="leads[]" id="leads{{$srno}}" >
                                                        <label for="leads{{$srno}}"></label>
                                                    </div>

                                                    <?php }  ?>

                                                </td>
                                                <td><?= 'LML' . str_pad($list['id'], 4, '0', STR_PAD_LEFT) ?></td>
                                                <td><?php if($list['masterid']!="0"){ $cate_master = App\Models\CategoryMaster::select()
                                                    ->where('id', $list['masterid'])
                                                    ->first();
                                                    echo $cate_master['name']; } ?>
                                                </td>
                                                <td>
                                                    <?= $list['name'] ?>
                                                </td>
                                                <td><?= $list['mobile'] ?></td>
                                                <td><?= $list['email'] ?></td>
                                                <td><?= $list['title'] ?></td>
                                                <td><?= date('M d,Y', strtotime($list['created_at'])) ?></td>
                                                <td>

                                                    <div class="btn-group">
                                                        <a href="{{url('/lead-creater/lead-detail/'.Crypt::encrypt($list['id']))}}" type="button" class="btn btn-success"><i class="fa fa-eye"></i></a>
                                                        {{-- <a href="{{url('/admin/expenses/'.Crypt::encrypt($list['id']))}}" type="button" class="btn btn-default"><i class="fa fa-edit"></i></a> --}}
                                                        <?php if($list['is_delete']=="0"){?>
                                                        <a onclick="deletemdl('{{ Crypt::encrypt($list['id']) }}')"
                                                            type="button" class="btn btn-danger"><i
                                                                class="fa fa-trash"></i></a>
                                                        <?php } ?>
                                                    </div>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="card-body row" style="display: none" id="leadbutton">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Select Tele-caller</label>
                                            <select class="form-control" name="telecaller" required>
                                                <option value=""> Select Tele-caller</option>
                                                @foreach ($telecaller as $list)
                                                    <option value="{{$list['id']}}">{{$list['name']}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <button class="btn btn-primary" style="margin-top: 30px" >Transfer Leads</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>



                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </form>
    </div>
    <!-- /.content-wrapper -->


    <div class="modal fade" id="deletemdl" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
            <div class="modal-content">
                <form method="POST" action="{{ asset('/lead-creater/myleads/delete') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title  fw-bold" id="deleteprojectLabel"> Delete Permanently?</h5>
                        <button type="button" class="close" onclick="closemdl()" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body justify-content-center flex-column d-flex">
                        <i class="fa fa-trash text-danger display-2 text-center mt-2"></i>
                        <p class="mt-4 fs-5 text-center">You can only delete this Permanently</p>
                    </div>
                    <input type="hidden" name="id_delete" id="id_delete" />
                    <div class="modal-footer">
                        <button type="button" onclick="closemdl()" class="btn btn-secondary"
                            data-dismiss="modal">Cancel</button>
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
    <!-- Bootstrap Switch -->
    <script src="{{ url('asset_data/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            $("input[data-bootstrap-switch]").each(function() {
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            });

            $('input[name="leads[]"]').on('click',function(){
                if($('input[name="leads[]"]:checked').length > 0){
                    $('#leadbutton').show();
                }else{
                    $('#leadbutton').hide();
                }
            });

        });

        function deletemdl(id) {
            $("#id_delete").val(id);
            $('#deletemdl').modal('show');
        }

        function closemdl() {
            $("#id_delete").val('');
        }
    </script>
@endsection
