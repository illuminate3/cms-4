import Vue from '../main.js'

const term = {}

term.types = () => {
    return new Promise((resolve, reject) => {
        Vue.http.get('/types').then(response => {
            resolve(response)
        })
    })
}

term.all = () => {
    return new Promise((resolve, reject) => {
        Vue.http.get('/terms').then(response => {
            resolve(response)
        })
    })
}

term.find = (id) => {
    return new Promise((resolve, reject) => {
        Vue.http.get('/terms/' + id).then(response => {
            resolve(response)
        })
    })
}

term.create = (data) => {
    return new Promise((resolve, reject) => {
        Vue.http.post('/terms', data).then(response => {
            resolve(response)
        })
    })
}

term.delete = (id) => {
    return new Promise((resolve, reject) => {
        Vue.http.delete('/terms/' + id).then(response => {
            resolve(response)
        })
    })
}

term.update = (id, data) => {
    return new Promise((resolve, reject) => {
        Vue.http.put('/terms/' + id, data).then(response => {
            resolve(response)
        })
    })
}

export default term