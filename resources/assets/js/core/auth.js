import Vue from '../main.js'

const auth = {}

auth.login = (data) => {
    return new Promise((resolve, reject) => {
        Vue.http({ url: '/', method: 'POST', data: data }).then(response => {
            resolve(response)
        })
    })
}

export default auth