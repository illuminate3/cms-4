import Vue from '../main.js'

const campaign = {}

campaign.all = () => {
    return new Promise((resolve, reject) => {
        Vue.http.get('/campaigns/all').then(response => {
            resolve(response)
        })
    })
}

campaign.find = (id) => {
    return new Promise((resolve, reject) => {
        Vue.http.get('/campaigns/' + id).then(response => {
            resolve(response)
        })
    })
}

export default campaign