<template>
    <div class="row home">
        <div class="col-md-4">
            <div class="col-md-12 jam-digital">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3 class="text-center" id="tanggal-jam">{{ moment() }}</h3>
                        <hr>
                        <h1 class="text-center"><jam-digital></jam-digital></h1>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel panel-default profil-absensi">
                    <div class="panel-body">
                        <div class="img-absensi">
                            <img class="img-thumbnail img-responsive" v-bind:src="foto">
                        </div>

                        <table class="table table-condensed">
                            <tbody>
                            <tr>
                                <td>NIS</td>
                                <td>:</td>
                                <td>{{nis}}</td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td>{{nama}}</td>
                            </tr>
                            <tr>
                                <td>Kelas</td>
                                <td>:</td>
                                <td>{{kelas}}</td>
                            </tr>
                            </tbody>
                        </table>
                        <!--<button @click="pingServer()">Ping Server</button>-->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body panel-absensi">
                        <table class="table table-striped table-bordered table-absensi">
                            <thead>
                            <tr>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Jam Masuk</th>
                                <th>Kelas</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="kehadiran in model">
                                <td>{{ kehadiran.nip_nis }}</td>
                                <td>{{ kehadiran.siswa.data.nama }}</td>
                                <td>{{ kehadiran.jam_masuk }}</td>
                                <td>{{ kehadiran.siswa.data.kelas.data.kelas }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="panel-footer pagination-footer">
                        <div class="pagination-item">
                            <small>Showing - {{ paging.count}} - {{paging.total}}</small>
                        </div>
                        <div class="pagination-item">
                            <small>Current Page:</small>
                            <small>{{paging.current_page}}</small>
                            <small>of {{paging.total_pages}}</small>
                        </div>
                        <div class="pagination-item">
                            <button @click="prev" class="btn btn-default btn-sm">Prev</button>
                            <button @click="next" class="btn btn-default btn-sm">Next</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    import JamDigital from './JamDigital.vue'
    import moment from 'moment';
//    import {getHeader} from '../../config.js'
    import {mapState} from 'vuex'
    require('moment-timezone')
//
    export default {
//        computed: mapState({
//                    userStore: state => state.userStore
//    }),
    name: 'AbsensiIndex',
    components:{
        'jam-digital': JamDigital,
    },
    beforeMount: function() {
        this.fetchData();
    },
    methods: {
        moment: function(){
            return moment().tz('Asia/Jakarta').locale('id').format('DD MMMM YYYY')
        },
        next: function() {
            console.log(this.paging)
            if(this.paging.links.next){
                this.paging.current_page++;
                this.fetchData();
            }
        },
        prev: function() {
            if(this.paging.links.previous){
                this.paging.current_page--;
                this.fetchData();
            }
        },
        fetchData: function(){
            var vm = this;
            axios.get(this.buildURL())
                    .then(function(response){

                        Vue.set(vm.$data, 'model', response.data.data)
                        Vue.set(vm.$data, 'paging', response.data.meta.pagination)

                    })
                    .catch(function(error){
                        console.log(error);
                    })
        },
        buildURL: function(){
            var p = this.paging;
            return `${this.source}?page=${p.current_page}`;
        },
        pingServer() {
            // Send the "pingServer" event to the server.
            this.$socket.emit('pingServer', 'PING!')
        }
    },
    beforeMount: function() {
        this.fetchData()
    },
    data(){
        return {
            model   : [],
            paging  : {},
            nis     : '',
            nama    : '',
            kelas   : '',
            foto    : 'images/user/default.png',
            source  : 'absensi',
        }
    },
    //Redis
    sockets:{
        connect:function(){
            console.log('socket connected ')
        },
        disconnect: function(){
            console.log('socket disconnected')
        },
        message(data) {
            let siswa = JSON.parse(data)
            console.log(siswa)
            var vm = this
            vm.nama = siswa.nama
            vm.nis = siswa.nis
            vm.kelas = siswa.kelas
            vm.foto = (siswa.foto) ? siswa.foto : 'images/user/default.png'
            vm.fetchData()
        },
        responseServer(data){
            console.log('response Server : ', data)
        }
    }
    }
</script>