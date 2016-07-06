import Vue from '../main.js'

const auth = {}

auth.login = (data) => {
    return new Promise((resolve, reject) => {
        Vue.http.post('/', data).then(response => {
            resolve(response)
        })
    })
}

export default auth