@extends('template.template')

@section('content')
    @if(Session::get('success'))
    <div class="alert alert-success"> {{Session::get('success')}}</div>
    @endif
    @if($errors->any())
    <ul class="alert alert-danger">
        @foreach($errors->any() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif
    <table class="table table-bordered">
    <thead class="table-dark">
    <tr>
        <th scope="col">Name</th>
        <th scope="col">Stock</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($medicines as $data)

        <tr>
            <td>{{ ucfirst($data->name)}}</td>

            <td>{{ number_format($data->stock)}}</td>
            <td class="d-flex justify-content-center">
                <a style="width: 60px" class="btn btn-primary btn-sm me-3" href="{{route('medicine.editStock', $data->id)}}">Edit</a>
            </td>
        </tr>

    @endforeach
    </tbody>
    </table>
@endsection