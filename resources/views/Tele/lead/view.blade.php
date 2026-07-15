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
                        <h1 class="m-0">Lead Detail</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/tele-caller') }}">Home</a></li>
                            <li class="breadcrumb-item active">Lead Detail</li>
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

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <?php if(!empty($_GET['update'])){?>

                        {{-- <div class="row"> --}}
                            <div class="col-md-12">
                                <form method="POST" action="{{url('/tele-caller/update-status')}}">
                                    @csrf
                                    <input name="leadid" value="{{$leads['id']}}" type="hidden" required>
                                <div class="card-body" style="padding-left: 0px; padding-right: 0px;">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Mark Lead As</label>
                                                <select name="status" required class="form-control select2" style="width: 100%;">
                                                    <option value="">Select</option>
                                                    <option value="t_approve">Approve</option>
                                                    <option value="t_process">Process</option>
                                                    <option value="t_hot">Hot</option>
                                                    <option value="t_complete">Complete</option>
                                                    <option value="callback">Call Back</option>
                                                    <option value="ringing">Ringing</option>
                                                    <option value="switchoff">Switch Off</option>
                                                    <option value="t_delete">Delete</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Remarks</label>
                                                <input class="form-control" name="remarks" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">

                                                <button class="btn btn-primary" style="margin-top: 30px">Update Lead Status</button>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Schedule Later</label>
                                                <select name="is_schedule" required class="form-control select2" style="width: 100%;">
                                                    <option value="no">No</option>
                                                    <option value="yes">Yes</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Date</label>
                                                <input class="form-control" type="date" name="schedule" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Remarks</label>
                                                <input class="form-control" type="text" name="schedule_remarks" >
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </form>
                            </div>
                        {{-- </div> --}}
                    <hr>

                    <?php }?>
                    <div class="col-md-12 row">
                        <div class="col-md-4">
                            <!-- About Me Box -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Details</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <strong><i class="fa fa-book mr-1"></i> Name</strong>

                                    <p class="text-muted">
                                        {{ $leads['name'] }}
                                    </p>

                                    <hr>

                                    <strong><i class="fa fa-phone mr-1"></i> Mobile</strong>

                                    <p class="text-muted">
                                        {{ $leads['mobile'] }}
                                    </p>

                                    <hr>

                                    <strong><i class="fa fa-envelope mr-1"></i> Email</strong>

                                    <p class="text-muted">
                                        {{ $leads['email'] }}
                                    </p>

                                    <hr>

                                    <strong><i class="fa fa-map mr-1"></i> Company Name</strong>

                                    <p class="text-muted">
                                        {{ $leads['company'] }}
                                    </p>

                                    <hr>
                                    <strong><i class="fa fa-book mr-1"></i> Title / Details</strong>

                                    <p class="text-muted">
                                        {{ $leads['title'] }}
                                    </p>

                                    <hr>
                                    <strong><i class="fa fa-list mr-1"></i> Discription</strong>

                                    <p class="text-muted">
                                        {{ $leads['description'] }}
                                    </p>

                                    <hr>
                                    <strong><i class="fa fa-clock-o mr-1"></i> Created On</strong>

                                    <p class="text-muted">
                                        {{ $leads['created_at'] }}
                                    </p>

                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->

                        <div class="col-md-8" style="max-height: 600px; overflow-y: scroll;">
                            <div class="timeline timeline-inverse">


                                <?php
                            $arraydates = array();

                            foreach ($remarks as $key) {



                            if(!in_array($key['date'],$arraydates)){ $arraydates[] = $key['date'];
                            ?>
                                <!-- timeline time label -->
                                <div class="time-label">
                                    <span class="bg-primary">
                                        {{ date('M d, Y', strtotime($key['date'])) }}
                                    </span>
                                </div>
                                <!-- /.timeline-label -->

                                <?php }?>
                                <!-- timeline item -->
                                <div>
                                    <i class="fa {{ $key['icon'] }} bg-{{ $key['bgcolor'] }}"></i>

                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i>
                                            {{ date('h:i:s A', strtotime($key['created_at'])) }}</span>
                                        <?php $teleuser = App\Models\User::select('name')
                                            ->where('id', $key['user_id'])
                                            ->first(); ?>
                                        <h3 class="timeline-header"><a
                                                class="text-{{ $key['bgcolor'] }}">{{ $teleuser['name'] }}</a> create
                                            remarks</h3>

                                        <div class="timeline-body">
                                            <?= $key['remarks'] ?>
                                        </div>

                                    </div>
                                </div>

                                <?php }?>
                                <!-- END timeline item -->
                            </div>

                        </div>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->

        </div>
        <!-- /.content-wrapper -->
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

        //   $('input[name="leads[]"]').on('click',function(){
        //     if($('input[name="leads[]"]:checked').length > 0){
        //         $('#leadbutton').show();
        //     }else{
        //         $('#leadbutton').hide();
        //     }
        //   })
        $('select[name="is_schedule"]').on('change',function(){
            if($('select[name="is_schedule"]').val() == "yes"){
                $('input[name="schedule"]').prop('required',true);
                $('input[name="schedule_remarks"]').prop('required',true);
            }else{
                $('input[name="schedule"]').prop('required',false);
                $('input[name="schedule_remarks"]').prop('required',false);
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
