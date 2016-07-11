import Vue from '../main.js'

const rebuttal = {}

rebuttal.all = () => {
    return new Promise((resolve, reject) => {
        Vue.http.get('/rebuttals/all').then(response => {
            resolve(response)
        })
    })
}

rebuttal.campaign = (campaign) => {
    return new Promise((resolve, reject) => {
        Vue.http.get('/rebuttals/' + campaign).then(response => {
            resolve(response)
        })
    })
}

export default rebuttal