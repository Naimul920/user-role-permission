@extends('admin.master')

@section('main')
    <section class="py-5">
        <div class="container">
            <div class="row mx-auto">
                <div>
                    <h4 class="text-center"> Add User </h4>
                </div>

                <div class="col-md-6 mx-auto">
                    @if(session('message'))
                        <div class="alert alert-success">
                            {{session('message')}}
                        </div>
                    @endif
                    <form action="{{route('create.user')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 ">
                            <label for="exampleFormControlInput1" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="exampleFormControlInput1">
                        </div>
                        <div class="mb-3 ">
                            <label for="exampleFormControlInput1" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="exampleFormControlInput1">
                        </div>
                        <div class="mb-3 ">
                            <label for="exampleFormControlInput1" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleFormControlInput1">
                        </div>
                        <div class="mb-3 ">
                            <label for="exampleFormControlInput1" class="form-label">Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control" id="exampleFormControlInput1">
                        </div>
                        <div class="mb-3 ">
                            <label for="exampleFormControlInput1" class="form-label">Roles</label>
                            <select name="roles[]" class="form-control" multiple>
                                <option value="">Select Role</option>
                                @foreach($roles as $role)
                                <option value="{{$role->name}}">{{$role->name}}</option>
                                @endforeach
                            </select>

                        </div>
                        <div >
                            <button class="btn btn-primary" type="submit">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-10 mx-auto text-center">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">User Name</th>
                            <th scope="col">User Email</th>
                            <th scope="col">User Role</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @if(!empty($user->getRoleNames()))
                                        @foreach($user->getRoleNames() as $roleName)
                                            <label class="badge bg-primary mx-1">{{$roleName}}</label>
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('edit.user',['id'=>$user->id])}}" class="btn btn-primary">Edit</a>
                                    <a href="{{route('delete.user',['id'=>$user->id])}}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
