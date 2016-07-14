import Vue from '../main.js'

const tab = {}

tab.all = () => {
    return new Promise((resolve, reject) => {
        Vue.http.get('/tabs').then(response => {
            resolve(response)
        })
    })
}

tab.create = (data) => {
    return new Promise((resolve, reject) => {
        Vue.http.post('/tabs', data).then(response => {
            resolve(response)
        })
    })
}

export default tab