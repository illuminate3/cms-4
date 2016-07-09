let Vue = require('vue')
let VueResource = require('vue-resource')

import LoginComponent from './components/Login.vue'
import DashboardComponent from './components/Dashboard.vue'

Vue.use(VueResource)

Vue.http.options.root = 'http://cms.dev/'
Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#csrf_token').getAttribute('content')

export default Vue

new Vue({
    el: 'body',
    components: {
        LoginComponent, DashboardComponent
    }
})