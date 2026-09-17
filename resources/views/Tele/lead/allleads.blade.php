
@extends('Admin.main')
@section('headerfile')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ url('asset_data/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('asset_data/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('asset_data/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <style>
        tr.lead-hot > td { background-color: #f8d7da !important; }
        tr.lead-warm > td { background-color: #fff3cd !important; }
        tr.lead-cold > td { background-color: #d1ecf1 !important; }
        tr.lead-dead > td { background-color: #e2e3e5 !important; }
        tr.lead-closed > td { background-color: #d4edda !important; }
    </style>
@endsection
@section('body')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">All Leads</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/tele-caller')}}">Home</a></li>
              <li class="breadcrumb-item active">All Leads</li>
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

                <span class="badge" style="background-color:#f8d7da;color:#721c24">&nbsp;&nbsp;</span> Hot
                &nbsp;
                <span class="badge" style="background-color:#fff3cd;color:#856404">&nbsp;&nbsp;</span> Warm
                &nbsp;
                <span class="badge" style="background-color:#d1ecf1;color:#0c5460">&nbsp;&nbsp;</span> Cold
                &nbsp;
                <span class="badge" style="background-color:#e2e3e5;color:#383d41">&nbsp;&nbsp;</span> Dead
                &nbsp;
                <span class="badge" style="background-color:#d4edda;color:#155724">&nbsp;&nbsp;</span> Closed

            </div>
        </div>



      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="card-body">
        <form method="get">
            <div class="row">

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="date_from">Date from</label>
                        <input value="<?= !empty($_GET['date_from']) ? $_GET['date_from'] : '' ?>" type="date" name="date_from" class="form-control" id="date_from" placeholder="Date From">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="date_to">Date To</label>
                        <input value="<?= !empty($_GET['date_to']) ? $_GET['date_to'] : '' ?>" type="date" name="date_to" class="form-control" id="date_to" placeholder="Date To">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="callback">Callback</label>
                        <select name="callback" id="callback" class="form-control" onchange="this.form.submit()">
                            <option value="">All Leads</option>
                            <option value="yes" <?= (!empty($_GET['callback']) && $_GET['callback'] == 'yes') ? 'selected' : '' ?>>Callback Only</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <button style="margin-top: 32px" type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>
    </div>
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>ID</th>
                                <th>Company Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Date</th>
                                <th>Follow-up 1</th>
                                <th>Follow-up 2</th>
                                <th>Follow-up 3</th>
                                <th>Lead Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody> <?php $srno = 0; ?>
                            @foreach ($leads as $list)
                                <?php $temperature = $temperatures[$list['id']] ?? 'new'; ?>
                                <tr class="@if($temperature != 'new') lead-{{ $temperature }} @endif">
                                    <td><?= ++$srno ?></td>


                                    <td><?= 'LML' . str_pad($list['id'], 4, '0', STR_PAD_LEFT) ?></td>
                                    <td>
                                        <?= $list['company'] ?>
                                    </td>
                                    <td><?= $list['mobile'] ?></td>
                                    <td><?= $list['email'] ?></td>
                                    <td><?= date('M d,Y', strtotime($list['created_at'])) ?></td>
                                    <?php $leadfollowups = $followups[$list['id']] ?? []; ?>
                                    <td>{{ $leadfollowups[0]['followup_note'] ?? '-' }}</td>
                                    <td>{{ $leadfollowups[1]['followup_note'] ?? '-' }}</td>
                                    <td>{{ $leadfollowups[2]['followup_note'] ?? '-' }}</td>
                                    <td>
                                        <form method="POST" action="{{ url('/tele-caller/all-leads/mark-temperature') }}">
                                            @csrf
                                            <input type="hidden" name="lead_id" value="{{ $list['id'] }}">
                                            <select name="temperature" class="form-control form-control-sm" onchange="this.form.submit()" style="min-width: 110px">
                                                <option value="" disabled {{ $temperature == 'new' ? 'selected' : '' }}>Not Set</option>
                                                <option value="hot" {{ $temperature == 'hot' ? 'selected' : '' }}>Hot</option>
                                                <option value="warm" {{ $temperature == 'warm' ? 'selected' : '' }}>Warm</option>
                                                <option value="cold" {{ $temperature == 'cold' ? 'selected' : '' }}>Cold</option>
                                                <option value="dead" {{ $temperature == 'dead' ? 'selected' : '' }}>Dead</option>
                                                <option value="closed" {{ $temperature == 'closed' ? 'selected' : '' }}>Closed</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td>

                                        <div class="btn-group">

                                            <a href="{{url('/tele-caller/lead-detail/'.Crypt::encrypt($list['id'])).'?update=remark'}}" type="button" class="btn btn-success"><i class="fa fa-eye"></i></a>
                                            <a href="{{url('/tele-caller/lead-edit/'.Crypt::encrypt($list['id']))}}" type="button" class="btn btn-default"><i class="fa fa-edit"></i></a>
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
  </div>
  <!-- /.content-wrapper -->

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
  </script>
@endsection
