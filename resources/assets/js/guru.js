require('./bootstrap');
import FormData from 'form-data';
import axios from 'axios';

$(function(){
    var $table = $('table#tabel').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": 'guru',
        columns: [
            { data: 'nip', name: 'nip' },
            { data: 'nama', name: 'nama' },
            { data: 'action',
                render: function(data, type, full, meta){
                    return "<div class='btn-group btn-group-xs'>" +
                        "<button href='#' class='btn btn-default' id='btn-lihat' data-nip='"+full.nip+"'><i class='fa fa-search-plus'></i> </button>" +
                        "<button href='#' class='btn btn-default' id='btn-ubah' data-nip='"+full.nip+"'><i class='fa fa-edit'></i> </button>" +
                        "<button href='#' class='btn btn-default' id='btn-hapus' data-nip='"+full.nip+"'><i class='fa fa-trash'></i> </button>" +
                        "</div>";
                },
                //name: 'action',
                searchable: false,
                sortable: false

            }
        ]
    });

    var $modal = $('#modal');
    $('#btn-tambah').click(function(){
        axios.get('guru/create')
            .then(function(response){
                $modal.find('#load').html(response.data);
                $modal.modal("show");
                $('form#form-guru').submit(function(event){
                    axios({
                        method : "POST",
                        url    : $(this).attr('action'),
                        data   : new FormData(this),
                    }).then(function(res){
                        if(res.data.saved){
                            $table.ajax.reload();
                            $("#modal").modal("hide");
                        }
                    }).catch(function(error){
                        $.each(error.response.data, function(index, value){
                            toastr.error(value);
                        })
                    });
                    event.preventDefault();
                })
            })
            .catch(function(error){
                toastr.error(error);
            });
    });

    $('table#tabel tbody').on('click', 'tr td button#btn-ubah', function(){
        var nip = $(this).data('nip');
        axios.get('guru/'+nip+'/edit')
            .then(function(response){
                $modal.find('#load').html(response.data);
                $modal.modal("show");
                $('form#form-guru').submit(function(event){
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type     : 'PUT',
                        url      : $(this).attr('action'),
                        dataType : 'json',
                        data     : $(this).serialize(),
                    }).done(function(res){
                        if(res.saved){
                            $table.ajax.reload();
                            $("#modal").modal("hide");
                        }
                    }).fail(function(error){
                        $.each(error.responseJSON, function(index, value){
                            toastr.error(value);
                        })
                    });
                    //axios({
                    //    method : "PUT",
                    //    url    : $(this).attr('action'),
                    //    data   : new FormData(this),
                    //}).then(function(res){
                    //    if(res.data.saved){
                    //        $table.ajax.reload();
                    //        $("#modal").modal("hide");
                    //    }
                    //}).catch(function(error){
                    //    $.each(error.response.data, function(index, value){
                    //        toastr.error(value);
                    //    })
                    //});
                    event.preventDefault();
                });
            })
            .catch(function(error){
                toastr.error(error);
            });
    }).on('click', 'tr td button#btn-lihat', function(){
        var nip = $(this).data('nip');
        axios.get('guru/'+nip)
            .then(function(response){
                $modal.find('#load').html(response.data);
                $modal.modal("show");
            })
            .catch(function(error){
                toastr.error(error);
            });
    }).on('click', 'tr td button#btn-hapus', function(){
        var nip = $(this).data('nip');
        if(confirm('Apakah NIP '+nip+' Yakin Akan dihapus ?')){
            axios.delete('guru/'+nip)
                .then(function(response){
                    if(response.data.deleted){
                        $table.ajax.reload();
                    }
                })
                .catch(function(error){
                    toastr.error(error);
                });
        }
        return false;
    });
});