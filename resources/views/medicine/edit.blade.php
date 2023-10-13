@extends('template.template')

@section('content')
<form action="{{ route('medicine.update', $medicines->id)}}" method="POST" class="card p-5">
@csrf
@method('PATCH')
<div class="mb-3 row">
    <label for="" class="col-sm-2 col-form-label"> Nama Obat : </label>
    <div class="col-sm-10">
        <input type="text" name="name" id="name" class="form-control" value="{{ $medicines->name}}">
    </div>
</div>
<div class="mb-3 row">
    <label for="" class="col-sm-2 col-form-label"> Jenis Obat : </label>
    <div class="col-sm-10">
        <select name="type" id="type" class="form-select">
            <option value="{{ $medicines->type}}">{{ ucfirst($medicines->type) }}</option>
            <option value="tablet">Tablet</option>
            <option value="sirup">Sirup</option>
            <option value="Kapsul">Kapsul</option>
        </select>
    </div>
</div>
<div class="mb-3 row">
    <label for="" class="col-sm-2 col-form-label"> Harga Obat : </label>
    <div class="col-sm-10">
        <input value="{{ $medicines->price }}" type="number" name="price" id="price" class="form-control">
    </div>
</div>
<div class="mb-3 row">
    <label for="" class="col-sm-2 col-form-label" hidden> Stock Obat : </label>
    <div class="col-sm-10">
        <input value="{{ $medicines->stock }}" type="number" name="stock" id="stock" class="form-control" hidden>
    </div>
</div>
<button type="submit" class="btn btn-primary mt-3">Submit</button>
</form>
@endsection