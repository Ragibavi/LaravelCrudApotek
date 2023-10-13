@extends('template.template')

@section('content')
<form action="{{route('user.update', $users->id)}}" method="POST" class="card p-5">
@csrf
@method('PATCH')
@if(Session::get('success'))
<div class="alert alert-success">{{ Session::get('success')}}</div>
@endif
@if ($errors->any())
<ul class="alert alert-danger">
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>
@endif
<div class="mb-3 row">
    <label for="" class="col-sm-2 col-form-label"> Nama : </label>
    <div class="col-sm-10">
        <input type="text" name="name" id="name" class="form-control" value="{{$users->name}}">
    </div>
</div>
<div class="mb-3 row">
    <label for="" class="col-sm-2 col-form-label"> Email : </label>
    <div class="col-sm-10">
        <input type="email" name="email" id="email" class="form-control" value="{{$users->email}}">
    </div>
</div>
<div class="mb-3 row">
    <label for="" class="col-sm-2 col-form-label"> Role : </label>
    <div class="col-sm-10">
        <select name="role" id="role" class="form-select">
            <option value="{{$users->role}}">{{$users->role}}</option>
            <option value="admin">Admin</option>
            <option value="cashier">Cashier</option>
        </select>
    </div>
</div>
<div class="mb-3 row">
    <label for="" class="col-sm-2 col-form-label"> Ubah Password : </label>
    <div class="col-sm-10">
        <input type="password" name="password" id="password" class="form-control">
    </div>
</div>
<button type="submit" class="btn btn-primary mt-3">Submit</button>
</form>
@endsection