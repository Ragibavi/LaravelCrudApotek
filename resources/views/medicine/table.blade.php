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
            <th scope="col">Type</th>
            <th scope="col">Price</th>
            <th scope="col">Stock</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($medicines as $data)

            <tr>
                <td>{{ ucfirst($data->name)}}</td>
                <td>{{ ucfirst($data->type)}}</td>
                <td>Rp. {{ number_format($data->price)}}</td>
                <td>{{ number_format($data->stock)}}</td>
                <td class="d-flex justify-content-center">
                    <a style="width: 60px" class="btn btn-primary btn-sm me-3" href="{{ route('medicine.edit', $data->id) }}">Edit</a>
                    <form action="{{ route('medicine.destroy', $data->id) }}" method="POST" id="delete-form">
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