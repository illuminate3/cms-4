<template>
    <form @submit.prevent="save">
        <div class="form-group row" :class="{ 'has-danger': errors.name != null }">
            <label class="col-sm-3 text-xs-right">Name</label>
            <div class="col-sm-7">
                <input type="text" v-model="data.name" class="form-control">
                <label class="form-control-label" v-show="errors.name != null">{{ errors.name }}</label>
            </div>
        </div>
        <div class="form-group row" :class="{ 'has-danger': errors.username != null }">
            <label class="col-sm-3 text-xs-right">Username</label>
            <div class="col-sm-7">
                <input type="text" v-model="data.username" class="form-control">
                <label class="form-control-label" v-show="errors.username != null">{{ errors.username }}</label>
            </div>
        </div>
        <div class="form-group row" :class="{ 'has-danger': errors.email != null }">
            <label class="col-sm-3 text-xs-right">Email</label>
            <div class="col-sm-7">
                <input type="text" v-model="data.email" class="form-control">
                <label class="form-control-label" v-show="errors.email != null">{{ errors.email }}</label>
            </div>
        </div>
        <div class="form-group row" :class="{ 'has-danger': errors.password != null }">
            <label class="col-sm-3 text-xs-right">Password</label>
            <div class="col-sm-7">
                <input type="password" v-model="data.password" class="form-control">
                <label class="form-control-label" v-show="errors.password != null">{{ errors.password }}</label>
            </div>
        </div>
        <div class="form-group row" :class="{ 'has-danger': errors.position != null }">
            <label class="col-sm-3 text-xs-right">Position</label>
            <div class="col-sm-7">
                <input type="text" v-model="data.position" class="form-control">
                <label class="form-control-label" v-show="errors.position != null">{{ errors.position }}</label>
            </div>
        </div>
        <div class="form-group row" :class="{ 'has-danger': errors.admin != null }">
            <label class="col-sm-3 text-xs-right">Admin</label>
            <div class="col-sm-7">
                <select v-model="data.admin" class="form-control c-select">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
                <label class="form-control-label" v-show="errors.admin != null">{{ errors.admin }}</label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-7 col-sm-offset-3">
                <button class="btn btn-default">Save</button>
            </div>
        </div>
    </form>
</template>

<script>

import auth from '../../core/auth.js'

export default {
    data() {
        return {
            data: {
                username: null,
                name: null,
                email: null,
                password: null,
                position: null,
                admin: null
            },
            errors: {
                username: null,
                name: null,
                email: null,
                password: null,
                position: null,
                admin: null
            }
        }
    },

    methods: {
        save() {
            auth.create(this.data).then(response => {
                const result = JSON.parse(response.body)

                if (Object.keys(result).length === 0) {
                    window.location.href = '/users'
                }

                this.errors = result
            })
        }
    }
}

</script>