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
                      <h1 class="m-0"> Services/Payment List</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
                        <li class="breadcrumb-item active">Services/Payment List</li>
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


                    <div class="col-lg-12 col-md-12 flex-column">
                        <div class="card mb-3 color-bg-200">
                            <div class="card-body">
                                <h6 class="mb-3 fw-bold ">Service List</h6>
                                <a href="javascript:void(0)"  data-toggle="modal" data-target="#modalAddUpdates" class="btn btn-dark w-sm-100">
                                    <i class="icofont-plus-circle me-2 fs-6"></i>Add Service</a>

                                <div class="">
                                    <table id="example1" class="table table-bordered table-striped" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Sr. No.</th>
                                                <th>Id</th>
                                                <th>Service Name</th>
                                                <th>Amount</th>
                                                <th>Remarks</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>   <?php $sr = 0; ?>
                                            @foreach ($services as $list)
                                            <?php
                                            $spt = 0;
                                            $pt = 0;
                                            $sget =  App\Models\Service::select()->where('id',$list['serviceid'])->first(); ?>
                                            <tr>
                                                <td>{{++$sr}}</td>
                                                <td>{{"LMSS-".str_pad($list['id'], 3, '0', STR_PAD_LEFT)}}</td>

                                                <td>{{$sget->name}}</td>
                                                <td>{{"Rs. ".$list->payment}}</td>

                                                <td><?=$list->remarks;?></td>

                                                <td>
                                                    <div class="btn-group mt-2" role="group" aria-label="Basic outlined example">
                                                        <a type="button" href="{{'/admin/ser-gen-d/'.Crypt::encrypt($list->id)}}" class="btn btn-outline-warning"  title="Delete" ><i class="fa fa-trash text-danger"></i></a>

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

                    <div class="col-lg-12 col-md-12 flex-column">
                        <div class="card mb-3 color-bg-200">
                            <div class="card-body">
                                <h6 class="mb-3 fw-bold ">Payment List</h6>
                                <a href="javascript:void(0)"  data-toggle="modal" data-target="#modalAddUpdatess" class="btn btn-dark w-sm-100">
                                    <i class="icofont-plus-circle me-2 fs-6"></i>Receive Payment</a>
                                <div class="">
                                    <table id="example2" class="table table-bordered table-striped" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Sr. No.</th>
                                                <th>Id</th>
                                                <th>Amount</th>
                                                <th>Remarks</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>   <?php $sr = 0; ?>
                                            @foreach ($pay as $list)
                                            <?php
                                            $spt = 0;
                                            $pt = 0;?>
                                            <tr>
                                                <td>{{++$sr}}</td>
                                                <td>{{"LMP-".str_pad($list['id'], 3, '0', STR_PAD_LEFT)}}</td>

                                                <td>{{"Rs. ".$list->payment}}</td>

                                                <td><?=$list->remarks;?></td>

                                                <td>
                                                    <div class="btn-group mt-2" role="group" aria-label="Basic outlined example">
                                                        <a type="button" href="{{'/admin/ser-pay-d/'.Crypt::encrypt($list->id)}}" class="btn btn-outline-warning"  title="Delete" ><i class="fa fa-trash text-danger"></i></a>

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



<!-- Modal  Delete Folder/ File-->
<div class="modal fade" id="deletemdl" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
        <div class="modal-content">
            <form method="POST" action="{{asset('/admin/ser/delete')}}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title  fw-bold" id="deleteprojectLabel"> Delete Permanently?</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body justify-content-center flex-column d-flex">
                    <i class="icofont-ui-delete text-danger display-2 text-center mt-2"></i>
                    <p class="mt-4 fs-5 text-center">You can only delete this Permanently</p>
                </div>
                <input type="hidden" name="id_delete" id="id_delete"/>
                <div class="modal-footer">
                    <button type="button" onclick="closedl()" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger color-fff">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>




<div class="modal fade" id="modalAddUpdates" tabindex="-1" aria-labelledby="modalAddUpdatesLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddUpdatesLabel">Add Service</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" enctype="multipart/form-data" action="{{asset('/admin/ser-gen/'.Crypt::encrypt($user['lead_id']))}}">
                @csrf
                <div class="modal-body">





                    <div class="col-md-12">
                        <label class="form-label">Select Service Name</label>
                        <select required name="item"   class="form-control " >
                            <option value="">Select Service Name</option>
                            @foreach ($items as $list)
                                <option data-price="{{$list['seq']}}" value="{{$list['id']}}" <?=(!empty($data->category_id)?(($data->category_id == $list['id'])?'selected':''):'')?> >{{$list['name']}} </option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="price" class="col-md-12 col-12 mb-0">Price </label>
                        <input name="price" required  id="price" autocomplete="off"  type="text" class="form-control ps-2 form-control-line">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="remarks" class="col-md-12 col-12 mb-0">Remark </label>
                        <input name="remarks" required   autocomplete="off"  type="text" class="form-control ps-2 form-control-line">
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" value="Allot Service" id="profile_update"  class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="modalAddUpdatess" tabindex="-1" aria-labelledby="modalAddUpdatesLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddUpdatesLabel">Receive Payment</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" enctype="multipart/form-data" action="{{asset('/admin/ser-pay/'.Crypt::encrypt($user['lead_id']))}}">
                @csrf
                <div class="modal-body">





                    <div class="form-group">
                        <label for="price" class="col-md-12 col-12 mb-0">Amount </label>
                        <input name="price" required  id="price" autocomplete="off"  type="text" class="form-control ps-2 form-control-line">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="remarks" class="col-md-12 col-12 mb-0">Remark </label>
                        <input name="remarks" required   autocomplete="off"  type="text" class="form-control ps-2 form-control-line">
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" value="Received" id="profile_update"  class="btn btn-primary" />
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
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            $("#example2").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            $('select[name="item"]').on("change", function() {

                $amt = $(this).find(':selected').attr('data-price');
                $("#price").val($amt);
            });
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
