require('./bootstrap');
import FormData from 'form-data';
import axios from 'axios';

$(function(){
    var $table = $('table#tabel').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": 'kelas',
        columns: [
            { data: 'kelas', name: 'kelas' },
            { data: 'action',
                render: function(data, type, full, meta){
                    return "<div class='btn-group btn-group-xs'>" +
                        "<button href='#' class='btn btn-default' id='btn-ubah' data-id='"+full.id+"'><i class='fa fa-edit'></i> </button>" +
                        "<button href='#' class='btn btn-default' id='btn-hapus' data-id='"+full.id+"'><i class='fa fa-trash'></i> </button>" +
                        "</div>";
                },
                searchable: false,
                sortable: false

            }
        ]
    });

    var $modal = $('#modal');
    $('#btn-tambah').click(function(){
        axios.get('kelas/create')
            .then(function(response){
                $modal.find('#load').html(response.data);
                $modal.modal("show");
                $('form#form-kelas').submit(function(event){
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
        var id = $(this).data('id');
        axios.get('kelas/'+id+'/edit')
            .then(function(response){
                $modal.find('#load').html(response.data);
                $modal.modal("show");
                $('form#form-kelas').submit(function(event){
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
                })
            })
            .catch(function(error){
                toastr.error(error);
            });
    }).on('click', 'tr td button#btn-hapus', function(){
        var id = $(this).data('id');
        if(confirm('Apakah Yakin Akan dihapus ?')){
            axios.delete('kelas/'+id)
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
    })
});