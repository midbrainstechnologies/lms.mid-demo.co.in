
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
            <h1 class="m-0">{{$l_type }} Lead List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
              <li class="breadcrumb-item active">{{$l_type }} Lead List</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->



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



      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="card-body">
        <form method="get">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Select Tele-caller</label>
                        <select class="form-control" name="user" >
                            <option value=""> Select Tele-caller</option>
                            @foreach ($telecaller as $list)
                                <option value="{{Crypt::encrypt($list['id'])}}" <?=!empty($_GET['user'])?((Crypt::decrypt($_GET['user']) == $list['id'])?' selected ':''):''?> >{{$list['name']}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="date_from">Date from</label>
                        <input value="<?= !empty($_GET['date_from']) ? $_GET['date_from'] : '' ?>"  type="date" name="date_from" class="form-control" id="date_from" placeholder="Date From">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="date_to">Date To</label>
                        <input value="<?= !empty($_GET['date_to']) ? $_GET['date_to'] : '' ?>"  type="date" name="date_to" class="form-control" id="date_to" placeholder="Date To">
                    </div>
                </div>
                <div class="col-md-2">
                    <button style="margin-top: 32px" type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>
    </div>
    <!-- Main content -->
    <form method="POST" >
        <div class="content">
        <div class="container-fluid">
            <div class="row">



                @csrf
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
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

                                            <a href="{{url('/admin/lead-detail/'.Crypt::encrypt($list['id'])).'?update=remark'}}" type="button" class="btn btn-success"><i class="fa fa-eye"></i></a>
                                            <a href="{{url('/admin/lead-edit/'.Crypt::encrypt($list['id']))}}" type="button" class="btn btn-default"><i class="fa fa-edit"></i></a>

                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

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
            <form method="POST" action="{{ asset('/tele-caller/captured-list/delete') }}">
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
          })



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
