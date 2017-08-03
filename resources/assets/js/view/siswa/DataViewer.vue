<template>
	<div class="panel panel-default">
		<div class="panel-heading data-viewer">
			<span class="panel-title">{{title}}</span>
			<div>
				<router-link :to="create" class="btn btn-default btn-sm">Tambah</router-link>
				<button class="btn btn-default btn-sm" @click="showFilter = !showFilter">F</button>
			</div>
		</div>
		<div class="panel-body">
			<div class="filter" v-if="showFilter">
				<div class="filter-column">
					<select class="form-control" v-model="params.cari_kolom">
						<option v-for="kolom in filter" :value="kolom">{{kolom}}</option>
					</select>
				</div>
				<div class="filter-operator">
					<select class="form-control" v-model="params.cari_operator">
						<option v-for="(value, key) in operators" :value="key">{{value}}</option>
					</select>
				</div>
				<div class="filter-input">
					<input class="form-control" v-model="params.cari_kueri_1" @keyup.enter="fetchData" placeholder="Search">
				</div>
				<div class="filter-input" v-if="params.cari_kueri_2 === 'antara'">
					<input class="form-control" v-model="params.cari_kueri_2" @keyup.enter="fetchData" placeholder="Search">
				</div>
				<div class="filter-btn">
					<button class="btn btn-default btn-sm">Filter</button>
				</div>
			</div>

			<table class="table table-striped table-info">
				<thead>
				<tr>
					<th v-for="item in thead">
						<div class="dataviewer-th" @click="sort(item.key)" v-if="item.sort">
							<span>{{item.title}}</span>
                            <span v-if="params.kolom === item.key">
                                <span v-if="params.urutan === 'asc'">&#x25B2;</span>
                                <span v-else>&#x25BC;</span>
                            </span>
						</div>
						<div v-else>
							<span>{{item.title}}</span>
						</div>
					</th>
				</tr>
				</thead>
				<tbody>
				<slot v-for="item in model.data" :item="item"></slot>
				</tbody>
			</table>
			<div class="panel-footer pagination-footer">
				<div class="pagination-item">
					<span>Per Halaman :</span>
					<select v-model="params.per_page" @change="fetchData">
						<option>10</option>
						<option>25</option>
						<option>50</option>
					</select>
				</div>
				<div class="pagination-item">
					<small>Tampilkan {{model.form}} - {{ model.to}} - {{model.total}}</small>
				</div>
				<div class="pagination-item">
					<small>Halaman:</small>
					<input type="text" class="pagination-input" v-model="params.page" @keyup.enter="fetchData">
					<small>of {{model.last_page}}</small>
				</div>
				<div class="pagination-item">
					<button @click="prev" class="btn btn-default btn-sm">Sebelumnya</button>
					<button @click="next" class="btn btn-default btn-sm">Selanjutnya</button>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import Vue from 'vue'
	import axios from 'axios'

	export default {
		props : ['source', 'thead', 'filter', 'create', 'title'],
		beforeMount: function() {
			this.fetchData();
		},
		methods: {
			next: function() {
				if(this.model.next_page_url){
					this.params.page++;
					this.fetchData();
				}
			},
			prev: function() {
				if(this.model.prev_page_url){
					this.params.page--;
					this.fetchData();
				}
			},
			sort: function(column){
				if(column === this.params.kolom){
					if(this.params.urutan === 'desc'){
						this.params.urutan = 'asc';
					}else{
						this.params.urutan = 'desc';
					}
				}else{
					this.params.kolom = column;
					this.params.urutan = 'asc';
				}
				this.fetchData()
			},
			fetchData: function() {
				var vm = this;
				axios.get(this.buildURL())
					.then(function(response){
						Vue.set(vm.$data, 'model', response.data.model);
					})
					.catch(function(error){
						console.log(error);
					})
			},
			buildURL: function(){
				var p = this.params;
				return `${this.source}?page=${p.page}&kolom=${p.kolom}&urutan=${p.urutan}&per_page=${p.per_page}&cari_kolom=${p.cari_kolom}&cari_operator=${p.cari_operator}&cari_kueri_1=${p.cari_kueri_1}&cari_kueri_2=${p.cari_kueri_2}`;
			}
		},
		data () {
		return {
			showFilter: false,
			model: {
				data: []
			},
			params: {
				kolom: 'nama',
				urutan: 'asc',
				per_page: 10,
				page: 1,
				cari_kolom: 'nis',
				cari_operator: 'sama_dengan',
				cari_kueri_1: '',
				cari_kueri_2: '',
			},
			operators: {
				sama_dengan: '=',
//                    tidak_sama_dengan: '<>',
//                    kurang_dari: '<',
//                    lebih_dari: '>',
//                    kurang_dari_sama_dengan: '<=',
//                    lebih_dari_sama_dengan: '>=',
//                    di_dalam: 'IN',
//                    tidak_di_dalam: 'NOT IN',
				seperti: 'LIKE',
//                    antara: 'BETWEEN'
			}
		}
	},
	}
</script>