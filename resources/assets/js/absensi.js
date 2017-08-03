import Vue from 'vue';
import axios from 'axios';
//import pace from '/node_modules/pace-js/pace.min.js';
//import pace from '../../../node_modules/pace-js/pace.min.js';
require('./bootstrap');

//Vue.component('absensi', App);

const app = new Vue({
    el: '#absensi',
    data() {
        return {
            params: {
                kelas: "all",
                date_range: ''
            },
            data: []
        }
    },
    beforeMount: function() {
        this.fetchData();
    },
    methods: {
        cari: function(){
            this.params.date_range;
            this.params.kelas;
            this.fetchData();
        },
        exportData: function(){
            this.params.date_range;
            this.params.kelas;
            window.location = this.excelURL();
        },
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
            return `absensi?vuejs=true&kelas=${p.kelas}&date_range=${p.date_range}`;
        },
        excelURL: function(){
            var p = this.params;
            return `excel?kelas=${p.kelas}&date_range=${p.date_range}`;
        },
    },


});