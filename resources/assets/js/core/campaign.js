import Vue from '../main.js'

const main = {}

main.all = () => {
    return new Promise((resolve, reject) => {
        Vue.http.get('/campaigns/all').then(response => {
            resolve(response)
        })
    })
}

export default main