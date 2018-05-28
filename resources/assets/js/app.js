
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
        subjects:[
            {name:'General Math', number:98},
            {name:'Biology', number:97},
            {name:'Higher Math', number:96},
        ],
        newSubject: '',
        newNumber:''
    },
    computed:{
        total(){
            var total = 0
            this.subjects.forEach(subject=>{
                total+=parseFloat(subject.number)
            })
            return total
        }
    },
    methods:{
        addSubject(){
            this.subjects.push({
                name: this.newSubject,
                number: this.newNumber,
            })
        },
        removeSubject(index){
            this.subjects.splice(index, 1)
        }
    }	
});
