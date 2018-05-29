
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'

Vue.use(BootstrapVue);
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
window.Vue = require('vue');
window.axios = require('axios');
let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/*Vue.component('example-component', require('./components/ExampleComponent.vue'));*/

const app = new Vue({
    el: '#app',
    data:{
        pagination: {},
        offset: 5,
        formData: {},
        editingFile: {},
        deletingFile: {},
        notification: false,
        message: '',
        errors: {},
        loading: false,
        subjects:[],

        newSubject: '',
        newNumber:'',
        total_number:''
    },
    created: function() {
        this.getData();
    },
    computed: {
        /*pages() {
            let pages = [];

            let from = this.pagination.current_page - Math.floor(this.offset / 2);

            if (from < 1) {
                from = 1;
            }

            let to = from + this.offset - 1;

            if (to > this.pagination.last_page) {
                to = this.pagination.last_page;
            }

            while (from <= to) {
                pages.push(from);
                from++;
            }

            return pages;
        },*/
    },
    methods:{
        total(){
            var total =  0
            this.subjects.forEach(subject=>{
                total+=parseFloat(subject.number)
            })
            this.total_number=total;
        },
        getData() {
            this.loading = true;
            axios.get('/marksheet').then(result => {
                this.loading = false;
                var self = this;
                self.subjects = [];
                // console.log(result.data.data);
                var receivedData = result.data.data;
                receivedData.forEach(function(element) {
                //console.log(element)
                self.subjects.push(element)
                })
                this.total();
                //this.pagination = result.data.pagination


            }).catch(error => {
                console.log(error);
                this.loading = false;
            });

        },
        resetForm() {
            this.formData = {};
            this.newSubject = '';
            this.newNumber = '';
        },
        /*isCurrentPage(page) {
            return this.pagination.current_page === page;
        },*/

        addSubject(){
            this.formData = new FormData();
            this.formData.append('subject', this.newSubject);
            this.formData.append('mark', this.newNumber);
            //this.formData.append('_token', csrf-token);
            axios.post('/add', this.formData)
                .then(response => {
                    this.formData = {};
                    this.newSubject = '';
                    this.newNumber = '';
                    //console.log(response);
                    //this.resetForm();
                    //this.showNotification('Data successfully inserted!', true);
                    this.getData();
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                    //this.showNotification(error.response.data.message, false);
                    //this.getData(this.activeTab);
                });
        },
        removeSubject(index){
            this.subjects.splice(index, 1)
        },
        modalId(i) {
            return 'modal' + i;
        },
        modalId1(i) {
            return 'modal1' + i;
        },
        showNotification(text, success) {
            if (success === true) {
                this.clearErrors();
            }

            var application = this;
            application.message = text;
            application.notification = true;
            setTimeout(function() {
                application.notification = false;
            }, 15000);
        }


        /*changePage(page) {
            if (page > this.pagination.last_page) {
                page = this.pagination.last_page;
            }
            this.pagination.current_page = page;
            this.fetchFile(this.activeTab, page);
        },*/
/*
        anyError() {
            return Object.keys(this.errors).length > 0;
        },

        clearErrors() {
            this.errors = {};
        }
        mounted() {
        this.fetchFile(this.pagination.current_page);
        }*/
    }
});
