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
                        <h1 class="m-0"><?= !empty($seo['title']) ? $seo['title'] : 'Admin Dashboard' ?> </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
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


                    <div class="col-12">
                        <div class="card">
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
                                            <th></th>
                                            <th>ID</th>
                                            <th>Billing</th>
                                            <th>Online</th>
                                            <th>Name</th>
                                            <th>Mobile No.</th>
                                            <th>Email</th>
                                            {{-- <th>History</th> --}}
                                            <th>Address</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody> <?php $srno = 0; ?>
                                        @foreach ($userlist as $list)
                                            <tr>
                                                <td><?= ++$srno ?></td>
                                                <td>
                                                    <?php
                                                        if($list['user_role']=="lead-creater"){
                                                            echo "Lead Creator";
                                                            $href = ' href="'.url('/admin/creator-list?user='.Crypt::encrypt($list['id'])).'" ';
                                                        }
                                                        if($list['user_role']=="tele-caller"){
                                                            echo "Telecaller";
                                                            $href = '';
                                                        }
                                                    ?>
                                                </td>
                                                <td><?="LM".str_pad($list['id'],4,'0',STR_PAD_LEFT)?></td>
                                                <td><?php
                                                if($list['is_billing'] == "1"){
                                                    echo "Yes";
                                                }
                                                ?></td>
                                                <td><?php
                                                    if($list['is_online'] == "1"){
                                                        echo "Yes";
                                                    }
                                                    ?></td>

                                                <td><a <?=$href?> >
                                                    <img src="<?= !empty($list['photo']) ? url($list['photo']) : url(env('APP_LOGO')) ?>"
                                                        alt="Product 1" class="img-circle img-size-32 mr-2" style="height: 2rem;">
                                                    <?= $list['name'] ?>
                                                    </a>
                                                </td>
                                                <td><a href="tel:<?= $list['mobile'] ?>"><?= $list['mobile'] ?></a></td>
                                                <td><a href="mailto:<?= $list['email'] ?>"><?= $list['email'] ?></a></td>
                                                {{-- <td><a href="{{url('/admin/history?user_id='.Crypt::encrypt($list['id']))}}" type="button" class="btn btn-success"><i class="fa fa-eye"></i></a></td> --}}
                                                <td><?= $list['address1'].", ".$list['address2'] ?></td>
                                                <td>

                                                    <div class="btn-group">
                                                        <?php if($list['block']=="0"){?>
                                                        <a href="{{url('/admin/users/block/'.Crypt::encrypt($list['id']))}}" type="button" class="btn btn-success"><i class="fa fa-ban"></i></a>
                                                        <?php }else{ ?>
                                                        <a href="{{url('/admin/users/unblock/'.Crypt::encrypt($list['id']))}}" type="button" class="btn btn-danger"><i class="fa fa-ban"></i></a>
                                                        <?php }
                                                        if($list['status']=="1"){?>
                                                        <a href="{{url('/admin/users/deactive/'.Crypt::encrypt($list['id']))}}" type="button" class="btn btn-success"><i class="fa fa-toggle-on"></i></a>
                                                        <?php }else{ ?>
                                                        <a href="{{url('/admin/users/active/'.Crypt::encrypt($list['id']))}}" type="button" class="btn btn-danger"><i class="fa fa-toggle-on"></i></a>
                                                        <?php } ?>
                                                        <a href="{{url('/admin/users/view/'.Crypt::encrypt($list['id']))}}" type="button" class="btn btn-default"><i class="fa fa-edit"></i></a>
                                                        <?php if($list['is_delete']=="0"){?>
                                                        <a onclick="deletemdl('{{Crypt::encrypt($list['id'])}}')"  type="button" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                                        <?php } ?>
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
                            <form action="{{url('/admin/users')}}" method="POST">
                                @csrf
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="user_role">Select User</label>
                                        <select required  name="user_role" class="form-control" id="user_role"   >
                                            <option value="" >Select Option</option>
                                            <option <?=(!empty($data))?(($data['user_role']=="tele-caller")?' selected ':''):''?> value="tele-caller" >Telecaller</option>
                                            <option <?=(!empty($data))?(($data['user_role']=="lead-creater")?' selected ':''):''?> value="lead-creater" >Lead Creator</option>
                                        </select>
                                        @error('user_role')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div>
                                        <div class="form-group">
                                            <label for="is_billing">Allow Billing</label>
                                            <select required  name="is_billing" class="form-control" id="is_billing"   >
                                                <option value="" >Select Billing</option>
                                                <option <?=(!empty($data))?(($data['is_billing']=="1")?' selected ':''):''?> value="1" >Yes</option>
                                                <option <?=(!empty($data))?(($data['is_billing']=="0")?' selected ':''):''?> value="0" >No</option>
                                            </select>
                                            @error('user_role')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="is_online">Allow Online Leads</label>
                                            <select required  name="is_online" class="form-control" id="is_online"   >
                                                <option value="" >Select Online Leads</option>
                                                <option <?=(!empty($data))?(($data['is_online']=="1")?' selected ':''):''?> value="1" >Yes</option>
                                                <option <?=(!empty($data))?(($data['is_online']=="0")?' selected ':''):''?> value="0" >No</option>
                                            </select>
                                            @error('user_role')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group" id="can_create_lead_wrap" style="display:none;">
                                            <label for="can_create_lead">Allow Lead Creation</label>
                                            <select name="can_create_lead" class="form-control" id="can_create_lead"   >
                                                <option <?=(!empty($data))?(($data['can_create_lead']=="1")?' selected ':''):''?> value="1" >Yes</option>
                                                <option <?=(!empty($data))?(($data['can_create_lead']=="0")?' selected ':''):' selected '?> value="0" >No</option>
                                            </select>
                                            <small class="form-text text-muted">Lets this Telecaller create new leads themselves, like a Lead Creator.</small>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input required type="text" name="name" class="form-control"
                                            id="name" placeholder="User Name" value="<?=(!empty($data))?$data['name']:''?>">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input required type="email" name="email" class="form-control"
                                            id="email" placeholder="User Email" value="<?=(!empty($data))?$data['email']:''?>">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile">Mobile</label>
                                        <input required type="text" name="mobile" class="form-control"
                                            id="mobile" placeholder="User Mobile" value="<?=(!empty($data))?$data['mobile']:''?>">
                                        @error('mobile')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="add1">Address Line 1</label>
                                        <input required type="text" name="add1" class="form-control"
                                            id="add1" placeholder="User Address Line 1" value="<?=(!empty($data))?$data['address1']:''?>">
                                        @error('add1')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="add2">Address Line 2</label>
                                        <input  type="text" name="add2" class="form-control"
                                            id="add2" placeholder="User Address Line 2" value="<?=(!empty($data))?$data['address2']:''?>">

                                    </div>

                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">{{((!empty($data))?' Update User ':' Add User ')}}</button>
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
                <form method="POST" action="{{asset('/admin/users-data/delete')}}">
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

        function toggleCanCreateLead(){
            if($("#user_role").val() === "tele-caller"){
                $("#can_create_lead_wrap").show();
            }else{
                $("#can_create_lead_wrap").hide();
                $("#can_create_lead").val("0");
            }
        }
        $(function(){
            toggleCanCreateLead();
            $("#user_role").on("change", toggleCanCreateLead);
        });
    </script>
@endsection
