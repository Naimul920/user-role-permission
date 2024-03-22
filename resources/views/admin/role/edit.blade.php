@extends('admin.master')

@section('main')
    <section class="py-5">
        <div class="container">
            <div class="row mx-auto">
                <div>
                    <h4 class="text-center"> Edit Role </h4>
                </div>

                <div class="col-md-6 mx-auto">
                    @if(session('message'))
                        <div class="alert alert-success">
                            {{session('message')}}
                        </div>
                    @endif
                    <form action="{{route('update.role',['id'=>$role->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3 ">
                            <label for="exampleFormControlInput1" class="form-label">Role Name</label>
                            <input type="text" name="name" class="form-control" id="exampleFormControlInput1" value="{{$role->name}}">
                        </div>
                        <div >
                            <button class="btn btn-primary" type="submit">Update</button>
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
                            <th scope="col">Role Name</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$role->name}}</td>
                                <td>
                                    <a href="{{route('edit.role',['id'=>$role->id])}}" class="btn btn-primary">Edit</a>
                                    <a href="{{route('delete.role',['id'=>$role->id])}}" class="btn btn-danger">Delete</a>
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
