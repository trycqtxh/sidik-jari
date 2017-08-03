<template>
        <div class="panel-body">
            <table class="table table-bordered table-responsive" id="tabel">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nis</th>
                    <th>Nama</th>
                    <th>Masuk</th>
                    <th>Izin</th>
                    <th>Sakit</th>
                    <th>Alpa</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(siswa, index) in data">
                    <td width="50px">{{ index+1 }}</td>
                    <td width="200px">{{ siswa.nis }}</td>
                    <td>{{ siswa.nama }}</td>
                    <td width="50px">{{ siswa.masuk}}</td>
                    <td width="50px">{{ siswa.izin}}</td>
                    <td width="50px">{{ siswa.sakit}}</td>
                    <td width="50px">{{ siswa.alpa}}</td>
                </tr>
                </tbody>
            </table>
        </div>
</template>

<script>
    import Vue from 'vue';
    import axios from 'axios';

    export default {
        beforeMount: function() {
            this.fetchData();
        },
        methods: {
            fetchData: function(){
                var vm = this;
                axios.get(this.buildURL())
                        .then(function(response){
                            Vue.set(vm.$data, 'data', response.data.data);
                        })
                        .catch(function(error){
                            console.log(error);
                        })
            },
            buildURL: function(){
                var p = this.params;
                return `absensi?vuejs=true&kelas=${p.kelas}`;
            }
        },
        data() {
            return {
                params: {
                    kelas: "2"
                },
                data: []
            }
        }
    }
</script>