import Vue from '../main.js'

const promo = {}

promo.all = () => {
    return new Promise((resolve, reject) => {
        Vue.http.get('/promos/all').then(response => {
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
        Vue.http.post('/promos/create', data).then(response => {
            resolve(response)
        })
    })
}

promo.update = (id, data) => {
    return new Promise((resolve, reject) => {
        Vue.http.post('/promos/' + id + '/edit', data).then(response => {
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