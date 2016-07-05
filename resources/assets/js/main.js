let Vue = require('vue')
let VueResource = require('vue-resource')

import LoginComponent from './components/Login.vue'

Vue.use(VueResource)

export default Vue

new Vue({
    el: 'body',
    components: {
        LoginComponent
    }
})