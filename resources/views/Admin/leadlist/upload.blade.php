
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
            <h1 class="m-0">Lead List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
              <li class="breadcrumb-item active">Lead List</li>
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
        <form method="post" enctype="multipart/form-data" >
            @csrf
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="file">Select File</label>
                        <input  required type="file" name="excel" class="form-control" id="file" placeholder="Select File" accept=".xlsx">
                        @error('file')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        @if (Session()->has('error'))
                            <span class="text-danger">{{ Session()->get('error') }}</span>
                        @endif
                        @if (Session()->has('success'))
                            <span class="text-success">{{ Session()->get('success') }}</span>
                        @endif
                    </div>
                </div>

                <div class="col-md-2">
                    <button style="margin-top: 32px" type="submit" class="btn btn-primary">Upload</button>
                </div>
                <div class="col-md-3">
                    <a style="margin-top: 32px"  href="{{url('asset_data/leadlist.xlsx')}}" class="btn btn-success">Download Sample</a>
                </div>
            </div>
        </form>
    </div>

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

          $('input[name="leads[]"]').on('click',function(){
            if($('input[name="leads[]"]:checked').length > 0){
                $('#leadbutton').show();
            }else{
                $('#leadbutton').hide();
            }
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
