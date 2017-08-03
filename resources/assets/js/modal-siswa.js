/**
 * Created by Faisal Abdul Hamid on 30/05/2017.
 */

export const  form = "" +
    '<form class="form-horizontal" @submit.prevent="save">'+
    '<div class="form-group" >'+
    '<label class="control-label col-md-3">NIS</label>'+
    '<div class="col-md-9">'+
    '<input class="form-control" v-model="form.nis">'+
    '<span class="help-block" v-if="errors.nis"></span>'+
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
    </form>;