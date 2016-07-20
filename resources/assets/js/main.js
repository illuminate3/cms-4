let Vue = require('vue')
let VueResource = require('vue-resource')

import LoginComponent from './components/Login.vue'
import DashboardComponent from './components/Dashboard.vue'
import CampaignComponent from './components/Campaign.vue'

import EditRebuttalComponent from './components/Rebuttal/Edit.vue'
import EditPromoComponent from './components/Promo/Edit.vue'
import EditTermsComponent from './components/Terms/Edit.vue'
import EditSectionComponent from './components/Section/Edit.vue'

import CreateCampaignComponent from './components/Campaign/Create.vue'
import CreateRebuttalComponent from './components/Rebuttal/Create.vue'
import CreatePromoComponent from './components/Promo/Create.vue'
import CreateSectionComponent from './components/Section/Create.vue'

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
        EditPromoComponent,
        EditTermsComponent,
        EditSectionComponent,
        
        CreateCampaignComponent,
        CreateRebuttalComponent,
        CreatePromoComponent,
        CreateSectionComponent
    }
})

const sortable = require('sortablejs')

sortable.create(document.querySelector('.draggable'), {
    aggregate: 'tr'
})