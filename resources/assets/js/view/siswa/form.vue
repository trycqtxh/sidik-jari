<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            {{title}}
        </div>
        <div class="panel-body">
            <pre>
                {{form}}
            </pre>
            <form class="form-horizontal" @submit.prevent="save">
                <div class="form-group" v-bind:class="{ 'has-error': errors.nis }">
                    <label class="control-label col-md-3">NIS</label>
                    <div class="col-md-9">
                        <input class="form-control" v-model="form.nis">
                        <span class="help-block" v-if="errors.nis">{{ errors.nis[0] }}</span>
                    </div>
                </div>
                <div class="form-group" v-bind:class="{ 'has-error': errors.nama }">
                    <label class="control-label col-md-3">Nama</label>
                    <div class="col-md-9">
                        <input class="form-control" v-model="form.nama">
                        <span class="help-block" v-if="errors.nama">{{ errors.nama[0] }}</span>
                    </div>
                </div>
                <div class="form-group" v-bind:class="{ 'has-error': errors.jenis_kelamin }">
                    <label class="control-label col-md-3">Jenis Kelamin</label>
                    <div class="col-md-9">
                        <select class="form-control" v-model="form.jenis_kelamin">
                            <option value="">Pilih</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <span class="help-block" v-if="errors.jenis_kelamin">{{ errors.jenis_kelamin[0] }}</span>
                    </div>
                </div>
                <div class="form-group" v-bind:class="{ 'has-error': errors.tempat_lahir }">
                    <label class="control-label col-md-3">Tempat Lahir</label>
                    <div class="col-md-9">
                        <input class="form-control" v-model="form.tempat_lahir">
                        <span class="help-block" v-if="errors.tempat_lahir">{{ errors.tempat_lahir[0] }}</span>
                    </div>
                </div>
                <div class="form-group" v-bind:class="{ 'has-error': errors.tanggal_lahir }">
                    <label class="control-label col-md-3">Tanggal Lahir</label>
                    <div class="col-md-9">
                        <input class="form-control" v-model="form.tanggal_lahir" >
                        <span class="help-block" v-if="errors.tanggal_lahir">{{ errors.tanggal_lahir[0] }}</span>
                    </div>
                </div>
                <div class="form-group" v-bind:class="{ 'has-error': errors.agama }">
                    <label class="control-label col-md-3">Agama</label>
                    <div class="col-md-9">
                        <select class="form-control" v-model="form.agama">
                            <option value="">Pilih</option>
                            <option value="Islam">Islam</option>
                            <option value="Khatolik">Kristen Khatolik</option>
                            <option value="Protestan">Kristen Protestan</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Budha">Budha</option>
                        </select>
                        <span class="help-block" v-if="errors.agama">{{ errors.agama[0] }}</span>
                    </div>
                </div>
                <div class="form-group" v-bind:class="{ 'has-error': errors.warganegara }">
                    <label class="control-label col-md-3">Warganegara</label>
                    <div class="col-md-9">
                        <select class="form-control" v-model="form.warganegara">
                            <option value="">Pilih</option>
                            <option value="WNI">WNI</option>
                            <option value="WNA">WNA</option>
                        </select>

                        <span class="help-block" v-if="errors.warganegara">{{ errors.warganegara[0] }}</span>
                    </div>
                </div>
                {{form.kelas}}
                <div class="form-group" v-bind:class="{ 'has-error': errors.kelas }">
                    <label class="control-label col-md-3">Kelas</label>
                    <div class="col-md-9">
                        <!--<input class="form-control" v-model="form.kelas">-->
                        <select class="form-control" v-model="form.kelas">
                            <option value="">Pilih</option>
                            <option v-for="kls in kelas" v-bind:value="kls.id">{{kls.kelas}}</option>
                        </select>
                        <span class="help-block" v-if="errors.kelas">{{ errors.kelas[0] }}</span>
                    </div>
                </div>
                <div class="form-group" v-bind:class="{ 'has-error': errors.alamat }">
                    <label class="control-label col-md-3">Alamat</label>
                    <div class="col-md-9">
                        <textarea class="form-control" v-model="form.alamat"></textarea>
                        <span class="help-block" v-if="errors.alamat">{{ errors.alamat[0] }}</span>
                    </div>
                </div>
                <div class="form-group" v-bind:class="{ 'has-error': errors.ayah }">
                    <label class="control-label col-md-3">Ayah</label>
                    <div class="col-md-9">
                        <input class="form-control" v-model="form.ayah">
                        <span class="help-block" v-if="errors.ayah">{{ errors.ayah[0] }}</span>
                    </div>
                </div>
                <div class="form-group" v-bind:class="{ 'has-error': errors.ibu }">
                    <label class="control-label col-md-3">Ibu</label>
                    <div class="col-md-9">
                        <input class="form-control" v-model="form.ibu">
                        <span class="help-block" v-if="errors.ibu">{{ errors.ibu[0] }}</span>
                    </div>
                </div>
                <div class="form-group" v-bind:class="{ 'has-error': errors.no_telepon }">
                    <label class="control-label col-md-3">No Hp Ortu</label>
                    <div class="col-md-9">
                        <input class="form-control" v-model="form.no_telepon">
                        <span class="help-block" v-if="errors.no_telepon">{{ errors.no_telepon[0] }}</span>
                    </div>
                </div>
                <div class="form-group" v-bind:class="{ 'has-error': errors.foto }">
                    <label class="control-label col-md-3">Foto</label>
                    <div class="col-md-9">
                        <input class="form-control" type="file">
                        <span class="help-block" v-if="errors.foto">{{ errors.foto[0] }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-9 col-md-offset-3">
                        <button class="btn btn-default">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import Vue from 'vue'
    import axios from 'axios'
//    import {getHeader} from '../../config'

    export default {
        name: 'SiswaForm',
        data() {
        return {
            isErrors: true,
            form: {
                kelas: {
                    data: {}
                }
            },
            kelas: {},
            errors: {},
            option: {},
            title: 'Form Siswa',
            initialize: 'siswa/create',
            store: '/siswa',
            method: 'POST',
        }
    },
    beforeMount: function(){
        if(this.$route.meta.mode === 'edit'){
            this.title = 'Form Ubah'
            this.initialize = 'siswa/'+this.$route.params.id+'/edit'
            this.store = 'siswa/'+this.$route.params.id
            this.redirect = '/siswa/'+this.$route.params.id
            this.method = 'PUT'
        }
        this.fecthData()
    },
    watch: {
        '$route': 'fetchData'
    },
    methods: {
        fecthData: function(){
            var vm = this
            axios.get(this.initialize)
                    .then(function(response){
                        console.log(response.data.form.data.kelas.data)
                        Vue.set(vm.$data, 'form', Object.assign(response.data.form.data, response.data.form.data.kelas.data))
                        Vue.set(vm.$data, 'option', response.data.option)
                        console.log(form)
                    })
                    .catch(function(error){

                    })
            axios.get('kelas?page=1&kolom=kelas&urutan=asc&per_page=100&cari_kolom=kelas&cari_operator=sama_dengan&cari_kueri_1=&cari_kueri_2=')
                    .then(function(res){
//                        console.log(res.data.model.data)
                        Vue.set(vm.$data, 'kelas', res.data.model.data)
                    })
                    .catch(function(error){
                        console.log(error)
                    })
        },
        save: function(){
            var vm = this
            axios({
                method: this.method,
                url: this.store,
                data: this.form,
            }).then(function(response){
                if(response.data.saved){
                    vm.$router.push(vm.redirect)
                }
            }).catch(function(error){
                Vue.set(vm.$data, 'errors', error.response.data)
            })
        }
    }
    }
</script>