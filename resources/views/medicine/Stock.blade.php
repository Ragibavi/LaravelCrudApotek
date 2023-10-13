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
                <a onclick="edit('{{$data['id']}}')" class="btn btn-primary me-3" style="cursor: pointer">Tambah Stock</a>
            </td>
        </tr>

    @endforeach
    </tbody>
    </table>
    
    <div class="modal" tabindex="-1" id="edit-stock">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Data Stock</h5>
                    <button type="button" class="btn-close" data-bs-dimiss="modal" aria-label="close"></button>
                </div>
                <form method="POST" id="form-stock">
                    <div class="modal-body">
                      <div id="msg"></div>

                      <input type="hidden" name="id" id="id">
                      <div class="mb-3">
                        <label for="name" class="form-label">Nama Obat :</label>
                        <input type="text" class="form-control" id="name" name="name" disabled>
                      </div>
                      <div class="mb-3">
                        <label for="stock" class="form-label">Stock Obat :</label>
                        <input type="number" class="form-control" id="stock" name="stock">
                      </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bd-dimiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                  </form>
            </div>
        </div>
    </div>

@push('script')
    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function edit(id){
            var url = "{{ route('medicine.stock.edit', ":id")}}";
            url = url.replace(':id', id);
            $.ajax({
                type:"GET",
                url: url,
                dataType: 'json',
                success: function(res){
                    $('#edit-stock').modal('show');
                    $('#id').val(res.id);
                    $('#name').val(res.name);
                    $('#stock').val(res.stock);
                }
            });
        }

        $('#form-stock').submit(function(e){
            e.preventDefault();

            var id = $('#id').val();
            var urlForm = "{{ route('medicine.stock.update', ":id") }}";
            urlForm = urlForm.replace(':id', id);

            var data = {
                stock: $('#stock').val(),
            }

            $.ajax({
                type: 'PATCH',
                url: urlForm,
                data: data,
                cache: false,
                success: (data) => {
                    $("#edit-stock").modal('hide');
                    sessionStorage.reloadAfterPageLoad = true;
                    window.location.reload();
                },
                error: function(data){
                    $('#msg').attr("class", "alert alert-danger");
                    $('#msg').text(data.responseJSON.message);
                }
            });
        });

        $(function (){
            if (sessionStorage.reloadAfterPageLoad) {
                $('#msg-success').attr("class", "alert alert-success");
                $('#msg-success').text("Berhasil menambahkan data stock!");
                sessionStorage.clear();
            }
        });
        </script>
@endpush
@endsection