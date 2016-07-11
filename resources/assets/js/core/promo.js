import Vue from '../main.js'

const promo = {}

promo.all = () => {
    return new Promise((resolve, reject) => {
        Vue.http.get('/promos/all').then(response => {
            resolve(response)
        })
    })
}

promo.campaign = (campaign) => {
    return new Promise((resolve, reject) => {
        Vue.http.get('/promos/' + campaign).then(response => {
            resolve(response)
        })
    })
}

export default promo