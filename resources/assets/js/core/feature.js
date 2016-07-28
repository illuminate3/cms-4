import Vue from '../main.js'

const feature = {}

feature.create = (data) => {
    return new Promise((resolve, reject) => {
        Vue.http.post('/features', data).then(response => {
            resolve(response)
        })
    })
}

export default feature