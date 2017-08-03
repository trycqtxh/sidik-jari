require('./bootstrap');
import FormData from 'form-data';
import axios from 'axios';


$(function(){

    var $table = $('table#tabel').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": 'siswa',
        columns: [
            { data: 'nis', name: 'nis' },
            { data: 'nama', name: 'nama' },
            { data: 'jenis_kelamin', name: 'jenis_kelamin', sortable: false},
            { data: 'tempat_tanggal_lahir',
                render: function(data, type, full, meta){
                    return full.tempat_lahir +', '+ full.tanggal_lahir;
                },
                name: 'tempat_lahir',
                sortable: false
            },
            { data: 'action',
                render: function(data, type, full, meta){
                    return "<div class='btn-group btn-group-xs'>" +
                        "<button href='#' class='btn btn-default' id='btn-lihat' data-nis='"+full.nis+"'><i class='fa fa-search-plus'></i> </button>" +
                        "<button href='#' class='btn btn-default' id='btn-ubah' data-nis='"+full.nis+"'><i class='fa fa-edit'></i> </button>" +
                        "<button href='#' class='btn btn-default' id='btn-hapus' data-nis='"+full.nis+"'><i class='fa fa-trash'></i> </button>" +
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
        axios.get('siswa/create')
            .then(function(response){
                $modal.find('#load').html(response.data);
                $modal.modal("show");
                $('form#form-tambah').submit(function(event){
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
                            toastr.options.progressBar = true;
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
        var nis = $(this).data('nis');
        axios.get('siswa/'+nis+'/edit')
            .then(function(response){
                $modal.find('#load').html(response.data);
                $modal.modal("show");
                $('form#form-ubah').submit(function(event){
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

                    event.preventDefault();
                })
            })
            .catch(function(error){
                toastr.error(error);
            });
    }).on('click', 'tr td button#btn-lihat', function(){
        var nis = $(this).data('nis');
        axios.get('siswa/'+nis)
            .then(function(response){
                $modal.find('#load').html(response.data);
                $modal.modal("show");
            })
            .catch(function(error){
                toastr.error(error);
            });
    }).on('click', 'tr td button#btn-hapus', function(){
        var nis = $(this).data('nis');
        if(confirm('Apakah NIS '+nis+' Yakin Akan dihapus ?')){
            axios.delete('siswa/'+nis)
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