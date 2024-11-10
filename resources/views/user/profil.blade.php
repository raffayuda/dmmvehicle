@extends('layouts.main')

@section('title')
Edit Profil
@endsection

@section('content')
<div class="container-fluid">
                {{-- <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">Daftar Sparepart</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Sparepart</a></li>
                                <li class="breadcrumb-item active">Daftar Sparepart</li>
                            </ol>
                            <button onclick="addForm()" class="btn btn-info d-none d-lg-block m-l-15">
                                <i class="fa fa-plus-circle"></i> Create New
                            </button>
                            {{ csrf_field() }}
                        </div>
                    </div>
                </div> --}}
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Data User</h4>

                                <form class="form form-horizontal" data-toggle="validator" method="post" enctype="multipart/form-data">
                                    {{csrf_field()}} {{method_field('PATCH')}}
                                    {{-- <div class="box-body"> --}}
                                        <div class="alert alert-info alert-dismissible" style="display:none">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <i class="icon fa fa-check"></i>
                                            Perubahan berhasil disimpan
                                        </div>
                                        <div class="form-group">
                                            <label for="foto" class="col-md-4 control-label">Foto Profil</label>
                                            <div class="col-md-12"><input id="foto" type="file" class="form-control" name="foto">
                                                <br>
                                                <div class="tampil-foto"><img src="{{ asset('public/images/'.Auth::user()->foto) }}"
                                                        width="200"></div>
                                            </div>
                                        </div>
                                            <div class="form-group">
                                                <label for="passwordlama" class="col-md-4 control-label">Password Lama</label>
                                                <div class="col-md-12">
                                                    <input id="passwordlama" type="password" class="form-control" name="passwordlama" autocomplete="current-password">
                                                    <span class="help-block with-errors"></span></div>
                                            </div>
                                            <div class="form-group">
                                                <label for="password" class="col-md-4 control-label">Password </label>
                                                <div class="col-md-12">
                                                    <input id="password" type="password" class="form-control" name="password" autocomplete="new-password">
                                                    <span class="help-block with-errors"></span></div>
                                            </div>
                                            <div class="form-group">
                                                <label for="password1" class="col-md-4 control-label">Ulang Password</label>
                                                <div class="col-md-12">
                                                    <input id="password1" type="password" class="form-control" data-match="#password"
                                                        name="password1" autocomplete="new-password">
                                                    <span class="help-block with-errors"></span></div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary btn-save"><i
                                                    class="fa fa-floppy-o"></i>Simpan</button>
                                            <button type="button" class="btn btn-warning" data-dismiss="modal"><i
                                                    class="fa fa-arrow-circle-left"></i>Batal</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
</div>

@endsection
@section('script')
<script type="text/javascript">
    $(function () {
        //saat password diubah
        $('#passwordlama').keyup(function(){
            if($(this).val() != "") $('#password, #password1').attr('required', true);
            else $('#password, #password1').attr('required', false);
        });
        $('.form').validator().on('submit', function(e){
            if(!e.isDefaultPrevented()){
                //upload via ajax
                $.ajax({
                    url : "{{Auth::user()->id}}/change",
                    type : "POST",
                    data : new FormData($(".form")[0]),
                    dataType: 'JSON',
                    async : false,
                    processData : false,
                    contentType : false,
                    success : function(data){
                        // console.log(data);
                //tampilkan pesan jika data msg=with-error
                        if(data.msg == "error"){
                            alert('Password lama salah!');
                            $('#passwordlama').focus().select();
                        }else{
                            d  = new Date();
                            $('.alert').css('display', 'block').delay(2000).fadeOut();
                //update foto user
                            $('.tampil-foto img, .user-image, .user-header img').attr('src', data.url+'?'+d.getTime());
                        }
                        },
                        error : function(){
                            alert("Tidak dapat menyimpan data!");
                        
                        
                    }
                });
                return false;
            }
        });
    });
</script>
@endsection