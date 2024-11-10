@extends('layouts.main')
@section('title')
Daftar Supplier
@endsection
@section('breadcrumb')

<li>Supplier</li>

@endsection
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <a onclick="addForm()" class="btn btn-success"><i class="fa fa-plus-circle"></i>Tambah</a>
                <div class="box-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th width="30">
                                    No
                                </th>
                                <th>
                                    Nama User
                                </th>
                                <th>
                                    Email
                                </th>
                                <th width="100">Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('user.form')
@endsection
@section('script')
<script type="text/javascript">
    var table, save_method;
    $(function () {
        table = $('.table').DataTable({
            "processing": true,
            "ajax": {
                "url": "{{ route('user.data') }}",
                "type": "GET"
            }
        });
        //Menyimpan data 
        $('#modal-form form').validator().on('submit', function (e) {
            if (!e.isDefaultPrevented()) {
                var id = $('#id').val();
                if (save_method == "add") url = "{{route('user.store') }}";
                else url = "user/" + id;

                $.ajax({
                    url: url,
                    type: "POST",
                    data: $('#modal-form form').serialize(),
                    success: function (data) {
                        $('#modal-form').modal('hide');
                        table.ajax.reload();
                    },
                    error: function () {
                        alert("Cannot Save Data");
                    }
                });
                return false;
            }
        });
    });
    //Menampilkan form tambah
    function addForm() {
        save_method = "add";
        $('input[name=_method]').val('POST');
        $('#modal-form').modal('show');
        $('#modal-form form')[0].reset();
        $('.modal-title').text('Tambah User');
        $('#password, #password1').attr('required', true);
    }
    // Menampilkan form edit
    function editForm(id) {
        save_method = "edit";
        $('input[name =_method]').val('PATCH');
        $('#modal-form form')[0].reset();
        $.ajax({
            url: "user/" + id + "/edit",
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('#modal-form').modal('show');
                $('.modal-title').text('Edit User');

                $('#id').val(data.id);
                $('#nama').val(data.name);
                $('#alamat').val(data.email);
                $('#password, #password1').removeAttr('required');
            },
            error: function () {
                alert("Tidak dapat menampilkan data!");
            }
        });
    }
    //Menghapus data
    function deleteData(id) {
        if (confirm("Are you Sure?")) {
            $.ajax({
                url: "user/" + id,
                type: "DELETE",
                data: {
                    'method': 'DELETE',
                    "_token": "{{ csrf_token() }}"

                },
                success: function (data) {
                    table.ajax.reload();
                },
                error: function () {
                    alert("Cannot Delete Data");
                }
            });
        }
    }

</script>
@endsection
