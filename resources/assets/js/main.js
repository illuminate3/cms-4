let Vue = require('vue')
let VueResource = require('vue-resource')

import LoginComponent from './components/Login.vue'
import DashboardComponent from './components/Dashboard.vue'
import CampaignComponent from './components/Campaign.vue'
import EditRebuttalComponent from './components/Rebuttal/Edit.vue'
import EditPromoComponent from './components/Promo/Edit.vue'

Vue.use(VueResource)

Vue.http.options.root = 'http://cms.dev/'
Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#csrf_token').getAttribute('content')

export default Vue

new Vue({
    el: 'body',

    components: {
        LoginComponent,
        DashboardComponent,
        CampaignComponent,
        EditRebuttalComponent,
        EditPromoComponent
    }
})