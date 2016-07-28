import Vue from '../main.js'

const feature = {}

feature.create = (data) => {
    return new Promise((resolve, reject) => {
        Vue.http.post('/features', data).then(response => {
            resolve(response)
        })
    })
}

feature.find = (id) => {
    return new Promise((resolve, reject) => {
        Vue.http.get('/features/' + id).then(response => {
            resolve(response)
        })
    })
}

feature.edit = (id, data) => {
    return new Promise((resolve, reject) => {
        Vue.http.put('/features/' + id, data).then(response => {
            resolve(response)
        })
    })
}

export default feature