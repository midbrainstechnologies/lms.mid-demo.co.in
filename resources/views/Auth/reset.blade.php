@extends('Auth.Common.main')
@section('cardbody')
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Here You Can Reset Your Password</p>

            @if (Session()->has('error'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-info"></i> Uff!</h5>
                {{Session()->get('error')}}
            </div>
            @endif
            @if (Session()->has('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-info"></i> Success!</h5>
                {{Session()->get('success')}}
            </div>
            @endif



            <form action="" method="post">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                        placeholder="Enter email">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                        placeholder="Password">
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Confirm Password</label>
                    <input type="password" name="confirmpassword" class="form-control" id="exampleInputPassword1"
                        placeholder="Confirm Password">
                    @error('confirmpassword')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-3">

                    </div>
                    <!-- /.col -->
                    <div class="col-9">
                        <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>



            <p class="mb-1">
                <a href="{{url('login')}}">Just Remember Password</a>
            </p>

        </div>
        <!-- /.login-card-body -->
    </div>
@endsection
