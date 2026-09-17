
@extends('Admin.main')
@section('headerfile')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ url('asset_data/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('asset_data/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('asset_data/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <style>
        :root {
            --status-hot-bg: #fef2f2;    --status-hot-text: #b91c1c;    --status-hot-accent: #ef4444;
            --status-warm-bg: #fffbeb;   --status-warm-text: #92400e;   --status-warm-accent: #f59e0b;
            --status-cold-bg: #eff6ff;   --status-cold-text: #1d4ed8;   --status-cold-accent: #3b82f6;
            --status-dead-bg: #f3f4f6;   --status-dead-text: #4b5563;   --status-dead-accent: #9ca3af;
            --status-closed-bg: #ecfdf5; --status-closed-text: #047857; --status-closed-accent: #10b981;
        }

        .leads-legend { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 4px; }
        .leads-legend .chip {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 4px 12px; border-radius: 999px; font-size: 12px; font-weight: 600;
        }
        .leads-legend .chip .dot { width: 8px; height: 8px; border-radius: 50%; display: inline-block; }
        .chip-hot { background: var(--status-hot-bg); color: var(--status-hot-text); }
        .chip-hot .dot { background: var(--status-hot-accent); }
        .chip-warm { background: var(--status-warm-bg); color: var(--status-warm-text); }
        .chip-warm .dot { background: var(--status-warm-accent); }
        .chip-cold { background: var(--status-cold-bg); color: var(--status-cold-text); }
        .chip-cold .dot { background: var(--status-cold-accent); }
        .chip-dead { background: var(--status-dead-bg); color: var(--status-dead-text); }
        .chip-dead .dot { background: var(--status-dead-accent); }
        .chip-closed { background: var(--status-closed-bg); color: var(--status-closed-text); }
        .chip-closed .dot { background: var(--status-closed-accent); }

        .leads-filter-card {
            background: #fff; border-radius: 12px; padding: 16px 20px;
            box-shadow: 0 1px 2px rgba(0,0,0,.06); margin-bottom: 16px;
        }
        .leads-filter-card label {
            font-size: 11px; font-weight: 700; text-transform: uppercase;
            letter-spacing: .04em; color: #6b7280; margin-bottom: 4px;
        }
        .leads-filter-card .form-control { border-radius: 8px; border-color: #e5e7eb; }
        .leads-filter-card .btn-primary { border-radius: 8px; }

        .leads-table-card {
            background: #fff; border-radius: 12px; overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,.08);
        }

        #example1.table { margin-bottom: 0; font-size: 13.5px; }
        #example1.table thead th {
            background: #f9fafb; color: #6b7280; font-size: 11px; font-weight: 700;
            text-transform: uppercase; letter-spacing: .04em;
            border-top: none; border-bottom: 1px solid #e5e7eb;
            white-space: nowrap; vertical-align: middle; padding: 12px 14px;
        }
        #example1.table tbody td {
            vertical-align: middle; padding: 10px 14px;
            border-top: 1px solid #f1f2f4; border-bottom: none;
        }
        #example1.table tbody tr { border-left: 4px solid transparent; transition: background-color .15s ease; }
        #example1.table tbody tr:hover { background-color: #f9fafb; }

        #example1.table tbody tr.lead-hot    { border-left-color: var(--status-hot-accent); }
        #example1.table tbody tr.lead-warm   { border-left-color: var(--status-warm-accent); }
        #example1.table tbody tr.lead-cold   { border-left-color: var(--status-cold-accent); }
        #example1.table tbody tr.lead-dead   { border-left-color: var(--status-dead-accent); }
        #example1.table tbody tr.lead-closed { border-left-color: var(--status-closed-accent); }

        .lead-id-pill {
            font-family: monospace; font-size: 12px; color: #6b7280;
            background: #f3f4f6; padding: 2px 8px; border-radius: 6px;
        }
        .lead-company { font-weight: 600; color: #111827; }
        .lead-contact { color: #6b7280; font-size: 12.5px; }
        .lead-contact i { width: 14px; color: #9ca3af; }

        .followup-note {
            display: block; max-width: 190px; white-space: nowrap;
            overflow: hidden; text-overflow: ellipsis; color: #374151;
        }
        .followup-note.empty { color: #b0b4bb; font-style: italic; }

        .status-select {
            border-radius: 999px !important; font-weight: 700; font-size: 12px;
            border: 1px solid transparent !important; padding: 4px 10px; min-width: 118px;
            appearance: auto;
        }
        .status-select.status-new    { background: #f3f4f6; color: #6b7280; }
        .status-select.status-hot    { background: var(--status-hot-bg); color: var(--status-hot-text); }
        .status-select.status-warm   { background: var(--status-warm-bg); color: var(--status-warm-text); }
        .status-select.status-cold   { background: var(--status-cold-bg); color: var(--status-cold-text); }
        .status-select.status-dead   { background: var(--status-dead-bg); color: var(--status-dead-text); }
        .status-select.status-closed { background: var(--status-closed-bg); color: var(--status-closed-text); }

        .lead-actions .btn { border-radius: 8px; padding: 5px 10px; }
        .lead-actions .btn + .btn { margin-left: 4px; }
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

                <div class="leads-legend">
                    <span class="chip chip-hot"><span class="dot"></span> Hot</span>
                    <span class="chip chip-warm"><span class="dot"></span> Warm</span>
                    <span class="chip chip-cold"><span class="dot"></span> Cold</span>
                    <span class="chip chip-dead"><span class="dot"></span> Dead</span>
                    <span class="chip chip-closed"><span class="dot"></span> Closed</span>
                </div>

            </div>
        </div>



      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="content">
        <div class="container-fluid">

            <div class="leads-filter-card">
                <form method="get">
                    <div class="row align-items-end">
                        <div class="col-md-2">
                            <div class="form-group mb-0">
                                <label for="date_from">Date from</label>
                                <input value="<?= !empty($_GET['date_from']) ? $_GET['date_from'] : '' ?>" type="date" name="date_from" class="form-control" id="date_from" placeholder="Date From">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group mb-0">
                                <label for="date_to">Date To</label>
                                <input value="<?= !empty($_GET['date_to']) ? $_GET['date_to'] : '' ?>" type="date" name="date_to" class="form-control" id="date_to" placeholder="Date To">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-0">
                                <label for="status">Lead Status</label>
                                <select name="status" id="status" class="form-control" onchange="this.form.submit()">
                                    <option value="">All Statuses</option>
                                    @foreach (App\Models\LeadMarking::LABELS as $val => $label)
                                        <option value="{{ $val }}" {{ (!empty($_GET['status']) && $_GET['status'] == $val) ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group mb-0">
                                <label for="callback">Callback</label>
                                <select name="callback" id="callback" class="form-control" onchange="this.form.submit()">
                                    <option value="">All Leads</option>
                                    <option value="yes" <?= (!empty($_GET['callback']) && $_GET['callback'] == 'yes') ? 'selected' : '' ?>>Callback Only</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-search"></i> Search</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="row">

                <div class="col-12">
                    <div class="leads-table-card">
                        <div class="table-responsive">
                            <table id="example1" class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ID</th>
                                        <th>Company Name</th>
                                        <th>Contact</th>
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


                                            <td><span class="lead-id-pill"><?= 'LML' . str_pad($list['id'], 4, '0', STR_PAD_LEFT) ?></span></td>
                                            <td>
                                                <span class="lead-company"><?= $list['company'] ?></span>
                                            </td>
                                            <td>
                                                <div class="lead-contact"><i class="fa fa-phone"></i> <?= $list['mobile'] ?></div>
                                                <div class="lead-contact"><i class="fa fa-envelope-o"></i> <?= $list['email'] ?></div>
                                            </td>
                                            <td><?= date('M d,Y', strtotime($list['created_at'])) ?></td>
                                            <?php $leadfollowups = $followups[$list['id']] ?? []; ?>
                                            <td>
                                                @if (isset($leadfollowups[0]))
                                                    <span class="followup-note" title="{{ $leadfollowups[0]['followup_note'] }}">{{ $leadfollowups[0]['followup_note'] }}</span>
                                                @else
                                                    <span class="followup-note empty">No note yet</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if (isset($leadfollowups[1]))
                                                    <span class="followup-note" title="{{ $leadfollowups[1]['followup_note'] }}">{{ $leadfollowups[1]['followup_note'] }}</span>
                                                @else
                                                    <span class="followup-note empty">No note yet</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if (isset($leadfollowups[2]))
                                                    <span class="followup-note" title="{{ $leadfollowups[2]['followup_note'] }}">{{ $leadfollowups[2]['followup_note'] }}</span>
                                                @else
                                                    <span class="followup-note empty">No note yet</span>
                                                @endif
                                            </td>
                                            <td>
                                                <form method="POST" action="{{ url('/tele-caller/all-leads/mark-temperature') }}">
                                                    @csrf
                                                    <input type="hidden" name="lead_id" value="{{ $list['id'] }}">
                                                    <select name="temperature" class="form-control form-control-sm status-select status-{{ $temperature }}" onchange="this.form.submit()">
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
                                                <div class="lead-actions">
                                                    <a href="{{url('/tele-caller/lead-detail/'.Crypt::encrypt($list['id'])).'?update=remark'}}" type="button" class="btn btn-success btn-sm" title="View"><i class="fa fa-eye"></i></a>
                                                    <a href="{{url('/tele-caller/lead-edit/'.Crypt::encrypt($list['id']))}}" type="button" class="btn btn-default btn-sm" title="Edit"><i class="fa fa-edit"></i></a>
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
