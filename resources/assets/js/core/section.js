import Vue from '../main.js'

const section = {}

section.all = () => {
    return new Promise((resolve, reject) => {
        Vue.http.get('/sections').then(response => {
            resolve(response)
        })
    })
}

section.find = (id) => {
    return new Promise((resolve, reject) => {
        Vue.http.get('/sections/' + id).then(response => {
            resolve(response)
        })
    })
}

export default section