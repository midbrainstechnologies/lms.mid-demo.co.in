@extends('Admin.main')
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

@endsection
