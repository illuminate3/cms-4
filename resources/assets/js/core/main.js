import Vue from '../main.js'

const main = {}

main.campaigns = () => {
    return new Promise((resolve, reject) => {
        Vue.http.get('/campaigns').then(response => {
            resolve(response)
        })
    })
}

export default main