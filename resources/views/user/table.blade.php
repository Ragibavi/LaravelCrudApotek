@extends('template.template')

@section('content')
<div class="d-flex justify-content-end">
    <a href="{{route('user.create')}}" class="btn btn-primary btn-lg mb-3">Tambah Pengguna</a>
</div>
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
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $data)
                
                <tr>
                    <td>{{ ucfirst($data->name)}}</td>
                    <td>{{ ($data->email)}}</td>
                    <td>{{ ucfirst(($data->role))}}</td>
                    <td class="d-flex justify-content-center">
                        <a style="width: 60px" class="btn btn-primary btn-sm me-3" href="{{route('user.edit', $data->id)}}">Edit</a>
                        <form action="{{ route('user.destroy', $data->id) }}" method="POST" id="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete()">Delete</button>
                        </form>
                    </td>
                </tr>
                
                @endforeach
            </tbody>
        </table>
        <script>
            function confirmDelete() {
                if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                    document.getElementById('delete-form').submit();
                }
            }
        </script>
@endsection