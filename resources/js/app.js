import 'babel-polyfill';

require('./bootstrap');

// window.Vue = require('vue');
import Vue from 'vue'
import Vuetify from 'vuetify'
import VueRouter from 'vue-router'
import Vuex from 'vuex'
// import AdminApp from './components/admin/AdminApp'
// import Dashboard from './components/admin/Dashboard'
import {routes} from './routes'

Vue.use(Vuetify);
Vue.use(VueRouter);
Vue.use(Vuex);


// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('admin-header', require('./components/admin/AdminHeader.vue').default);
// Vue.component('admin-app', require('./components/admin/AdminApp.vue').default);
// Vue.component('admin-dashboard', require('./components/admin/Dashboard.vue').default);

// Vue.component('create-post', require('./components/admin/posts/CreatePost.vue').default);
// Vue.component('post-list', require('./components/admin/posts/PostList.vue').default);
// Vue.component('edit-post', require('./components/admin/posts/EditPost.vue').default);
// Vue.component('category-list', require('./components/admin/CategoryList.vue').default);

Vue.component('post-form', require('./components/admin/posts/PostForm.vue').default);
Vue.component('snack-bar', require('./components/SnackBar.vue').default);
// Vue.component('editor', require('./components/Editor.vue').default);

// Public
Vue.component('login-form', require('./components/LoginForm.vue').default);
Vue.component('search-job', require('./components/frontend/SearchJob.vue').default);
Vue.component('job-list', require('./components/frontend/JobList.vue').default);
Vue.component('side-bar', require('./components/frontend/SideBar.vue').default);

/**
 * Applicants Portal
 */
Vue.component('applicant-side-nav', require('./components/applicants/ApplicantSideNav.vue').default);
Vue.component('personal-details', require('./components/applicants/cv/PersonalDetails.vue').default);
Vue.component('work-experience', require('./components/applicants/cv/WorkExperience.vue').default);



// Vue Router
const router = new VueRouter({
    routes,
    mode: 'history',
  })


const app = new Vue({
    el: '#app',
    router,
    component: {
      // Dashboard
    },
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
        },
        logout: function (event) {
            event.preventDefault();
            document.getElementById('logout-form').submit();
        },
    }
});
