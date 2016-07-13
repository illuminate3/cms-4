import Vue from '../main.js'

const rebuttal = {}

rebuttal.all = () => {
    return new Promise((resolve, reject) => {
        Vue.http.get('/rebuttals').then(response => {
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

rebuttal.find = (id) => {
    return new Promise((resolve, reject) => {
        Vue.http.get('/rebuttals/' + id).then(response => {
            resolve(response)
        })
    })
}

rebuttal.create = (data) => {
    return new Promise((resolve, reject) => {
        Vue.http.post('/rebuttals', data).then(response => {
            resolve(response)
        })
    })
}

rebuttal.update = (id, data) => {
    return new Promise((resolve, reject) => {
        Vue.http.put('/rebuttals/' + id, data).then(response => {
            resolve(response)
        })
    })
}

rebuttal.delete = (id) => {
    return new Promise((resolve, reject) => {
        Vue.http.delete('/rebuttals/' + id).then(response => {
            resolve(response)
        })
    })
}

export default rebuttal