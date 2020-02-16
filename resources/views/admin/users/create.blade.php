@extends('layouts.app')


@section('content')
<body>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-white bg-dark">Add User</div>
                <div class="card-body">
                    <form method="post" action="{{ route('users.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name :</label>
                            <input type="text" class="form-control" name="name" placeholder="Full Name">
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="email">Email :</label>
                                <input type="email" class="form-control" name="email" placeholder="Email">
                            </div>
                            <div class="col">
                                <label for="role">Role :</label>
                                <select class="form-control col" name="role">
                                    <option value="" disabled selected>Select role</option>
                                    @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row pt-3">
                            <div class="col">
                                <label for="password">Password :</label>
                                <input type="password" class="form-control" name="password" placeholder="Please enter strong password">
                            </div>
                            <div class="col pb-3">
                                <label for="confirm-password">Confirm password :</label>
                                <input type="password" class="form-control" name="confirm-password" placeholder="Please re-enter your password">
                            </div>
                        </div>
                        <div class="float-right mt-4">
                            <button class="btn btn-danger" type="reset">Clear</button>
                            <button class="btn btn-success" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>


@endsection