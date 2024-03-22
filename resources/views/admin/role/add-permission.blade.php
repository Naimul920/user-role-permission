@extends('admin.master')

@section('main')
    <section class="py-5">
        <div class="container">
            <div class="row mx-auto">
                <div>
                    <h4 class="text-center"> Role Name: {{$role->name}} </h4>
                </div>

                <div class="col-md-6 mx-auto">
                    @if(session('message'))
                        <div class="alert alert-success">
                            {{session('message')}}
                        </div>
                    @endif
                    <form action="{{route('add-permission-to-role',['id'=>$role->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3 ">
                            <label for="exampleFormControlInput1" class="form-label">Permissions to {{$role->name}}</label>
                            <div class="row">
                                @foreach($permissions as $permission)
                                    <div class="col-md-3">
                                        <label><input type="checkbox" name="permission[]" value="{{$permission->name}}" {{in_array($permission->id, $rolePermissions)? 'checked':''}}> {{$permission->name}}</label>
                                    </div>
                                @endforeach
                            </div>


                        </div>
                        <div >
                            <button class="btn btn-primary" type="submit">Add permission to role</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
