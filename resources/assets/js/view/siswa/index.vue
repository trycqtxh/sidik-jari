<template>
    <data-viewer :source="source" :thead="thead" :filter="filter" :create="create" :title="title">
        <template scope="props">
            <tr>
                <td>{{props.item.nis}}</td>
                <td>{{props.item.nama}}</td>
                <td>{{props.item.jenis_kelamin}}</td>
                <td>{{props.item.tempat_lahir}}, {{props.item.tanggal_lahir}}</td>
                <td>
                    <div class="btn-group btn-group-xs">
                        <button class="btn btn-default" @click="$router.push('/'+props.item.nis+'/lihat')"><i class="fa fa-search-plus"></i> </button>
                        <button class="btn btn-default" @click="$router.push('/'+props.item.nis+'/ubah')"><i class="fa fa-edit"></i> </button>
                        <button class="btn btn-default" @click="remove(props.item.nis)"><i class="fa fa-trash"></i> </button>
                    </div>
                </td>
            </tr>
        </template>
    </data-viewer>
</template>

<script>
    import DataViewer from './DataViewer'
    import {mapState} from 'vuex'
    import axios from 'axios'

    export default {
        name: 'SiswaIndex',
        data() {
            return {
                title: 'Data Siswa',
                source: 'siswa',
                create: 'tambah',
                thead: [
                    {title: 'NIS', key: 'nis', sort: true},
                    {title: 'Nama', key: 'nama', sort: true},
                    {title: 'Jenis Kelamin', key: 'jenis_kelamin'},
                    {title: 'Tempat Tanggal Lahir', key: 'tempat_tanggal_lahir'},
                    {title: 'Action'},
                ],
                filter: [
                    'nis', 'nama',
                ],
            }
        },
        components: {
            DataViewer
        },
        computed: mapState({
                userStore: state => state.userStore
        }),
        methods: {
            remove: function(nis){
                if(confirm('Apakah Yakin NIS '+nis+' Akan Dihapus ?')){
                    var vm = this
                    axios.delete(this.source+'/'+nis)
                            .then(function(response){
                                if(response.data.deleted){
                                    console.log(vm)
                                }
                            })
                            .catch(function(error){
                                console.log(error)
                            })
                }
                return false;
            }
        }
    }
</script>