
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
        offset: 5,
        formData: {},
        message: '',
        loading: false,
        subjects:[],
        showModal: false,
        editsubjectdata: '',
        editnumberdata:0,
        newSubject: '',
        newNumber:'',
        errors:[],
        total_number:''
    },
    created: function() {
        this.getData();
    },
    computed: {
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
                var receivedData = result.data.data;
                receivedData.forEach(function(element) {
                self.subjects.push(element)
                })
                this.total();

            }).catch(error => {
                console.log(error);
                this.loading = false;
            });

        },
        addSubject(){
            this.formData = new FormData();
            this.formData.append('subject', this.newSubject);
            this.formData.append('mark', this.newNumber);
            axios.post('/add', this.formData)
                .then(response => {
                    this.formData = {};
                    this.newSubject = '';
                    this.newNumber = '';
                    this.getData();
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                    alert("Could not insert data")
                });
        },
        removeSubject(index){
            if (confirm("Do you really want to delete it?")) {
                    
                    axios.post('/delete_data/' + index)
                        .then(response => {
                            
                            this.getData();
                        })
                        .catch(error => {
                            alert("Could not delete data");
                        });
                }
        },
        modalId1(i) {
            return 'modal1' + i;
        },
        editSubject(index) {
            
            this.editsubjectdata = this.subjects[index].name;
            this.editnumberdata = this.subjects[index].number; 
        },
        submitEditSubject(index) {
            var data = {
                name: this.editsubjectdata,
                number: this.editnumberdata
            }
            axios.post('/edit/' +  this.subjects[index].id, data)
                .then(response => {
                    this.editsubjectdata = '';
                    this.editnumberdata = 0;
                    this.getData();
                    this.showModal = false;
                    alert('Successful');
                })
                .catch(error => {
                    alert("Could not edit data\n Please fill data correctly");
                });
        }
    }
});
