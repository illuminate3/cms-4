import Vue from '../main.js'

const rebuttal = {}

rebuttal.all = (campaign) => {
    return new Promise((resolve, reject) => {
        Vue.http.get('/rebuttals/' + campaign).then(response => {
            resolve(response)
        })
    })
}

export default rebuttal