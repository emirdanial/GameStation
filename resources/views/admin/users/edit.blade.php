@extends('layouts.app')


@section('content')
<body>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-white bg-dark">Add User</div>
                <div class="card-body">
                    <form method="post" action="{{ route('users.update', $user->id) }}">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <label for="name">Name :</label>
                            <input type="text" class="form-control" name="name" value="{{$user->name}}">
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="email">Email :</label>
                                <input type="email" class="form-control" name="email" value="{{$user->email}}">
                            </div>
                        </div>
                        <div class="form-group mt-4 ml-2">
                            <label>Permission :</label>
                            @foreach($permissions as $permission)
                              <div class="form-check">
                                <label for="permission" class="form-check-label">
                                <input class="form-check-input" type="checkbox" value="{{ $permission->id }}" name="check_list[]" {{ $user->hasPermissionTo($permission) ? 'checked' : '' }}>
                                {{ $permission->name }}</label>
                              </div>
                            @endforeach
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