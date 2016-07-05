const auth = {}

import Vue from '../main.js'

auth.login = () => {
    return new Promise((resolve, reject) => {
        Vue.http.post('/', response => {
            resolve(response)
        })
    })
}

export default auth