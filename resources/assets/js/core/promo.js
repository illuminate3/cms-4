import Vue from '../main.js'

const promo = {}

promo.all = () => {
    return new Promise((resolve, reject) => {
        Vue.http.get('/promos').then(response => {
            resolve(response)
        })
    })
}

promo.find = (id) => {
    return new Promise((resolve, reject) => {
        Vue.http.get('/promos/' + id).then(response => {
            resolve(response)
        })
    })
}

promo.create = (data) => {
    return new Promise((resolve, reject) => {
        Vue.http.post('/promos', data).then(response => {
            resolve(response)
        })
    })
}

promo.update = (id, data) => {
    return new Promise((resolve, reject) => {
        Vue.http.put('/promos/' + id, data).then(response => {
            resolve(response)
        })
    })
}

promo.delete = (id) => {
    return new Promise((resolve, reject) => {
        Vue.http.delete('/promos/' + id).then(response => {
            resolve(response)
        })
    })
}

export default promo