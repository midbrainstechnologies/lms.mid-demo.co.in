@extends('LeadCreator.main')
@section('headerfile')
@endsection
@section('body')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?= !empty($seo['title']) ? $seo['title'] : 'Upload Leads' ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/tele-caller')}}">Home</a></li>
              <li class="breadcrumb-item active"><?= !empty($seo['title']) ? $seo['title'] : 'Upload Leads' ?></li>
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
                        <input required type="file" name="excel" class="form-control" id="file" placeholder="Select File" accept=".xlsx">
                        @error('file')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-2">
                    <button style="margin-top: 32px" type="submit" class="btn btn-primary">Upload</button>
                </div>
                <div class="col-md-3">
                    <a style="margin-top: 32px" href="{{url('asset_data/leadlist.xlsx')}}" class="btn btn-success">Download Sample</a>
                </div>
            </div>
        </form>
    </div>

  </div>
  <!-- /.content-wrapper -->

@endsection
@section('footerfile')
@endsection
