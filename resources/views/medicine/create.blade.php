    @extends('template.template')

    @section('content')
    <form action="{{route('medicine.store')}}" method="POST" class="card p-5">
    @csrf
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
        <label for="" class="col-sm-2 col-form-label"> Nama Obat : </label>
        <div class="col-sm-10">
            <input type="text" name="name" id="name" class="form-control">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="" class="col-sm-2 col-form-label"> Jenis Obat : </label>
        <div class="col-sm-10">
            <select name="type" id="type" class="form-select">
                <option selected disabled hidden>Pilih</option>
                <option value="tablet">Tablet</option>
                <option value="sirup">Sirup</option>
                <option value="Kapsul">Kapsul</option>
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="" class="col-sm-2 col-form-label"> Harga Obat : </label>
        <div class="col-sm-10">
            <input type="number" name="price" id="price" class="form-control">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="" class="col-sm-2 col-form-label"> Stok Tersedia : </label>
        <div class="col-sm-10">
            <input type="number" name="stock" id="stock" class="form-control">
        </div>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Submit</button>
</form>
@endsection