/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import 'babel-polyfill'

// window.Vue = require('vue');
import Vue from 'vue'
import Vuetify from 'vuetify'
Vue.use(Vuetify);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('admin-header', require('./components/admin/AdminHeader.vue').default);

Vue.component('create-post', require('./components/admin/posts/CreatePost.vue').default);
Vue.component('post-list', require('./components/admin/posts/PostList.vue').default);
Vue.component('category-list', require('./components/admin/CategoryList.vue').default);

Vue.component('snack-bar', require('./components/SnackBar.vue').default);

// Public
// Vue.component('login-form', require('./components/LoginForm.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify({
      theme: {
        themes: {
          light: {
            // GAG Colors
            gagrey: '#5a5b5c',
            gayellow: '#c7a92e',
            text: 'rgb(0, 0, 0, .75)',
            primary: '#1D1D1B',

            // Vuetify Action Colors
            secondary: '#f5f5f5',
            accent: '#82B1FF',
            error: '#FF5252',
            info: '#2196F3',
            success: '#4CAF50',
            warning: '#FFC107',
          }
        }
      },
      icons: {
        iconfont: 'mdi'
      }
    }),
    data () {
      return {
        //login
        valid: true,
        email: '',
        emailrules: [
          value => !!value || 'Required',
          value => /.+@.+\..+/.test(value) || 'E-mail must be valid'
        ],
        password: '',
        passwordrules: [
          value => !!value || 'Required',
          value => (value && value.length > 8) || 'Password must be atleast 8 characters',
        ],
      }
    },
    methods: {
      clearAlert(){

      },
      validate () {
        if (this.$refs.form.validate()) {
          this.snackbar = true;
        }
      }
    }
});