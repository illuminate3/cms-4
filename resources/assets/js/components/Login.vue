<template>
    <form @submit.prevent="login">
        <fieldset class="form-group" :class="{ 'has-danger': error }">
            <input type="text" v-model="user.username" class="form-control username" placeholder="your username">
        </fieldset>
        <fieldset class="form-group" :class="{ 'has-danger': error }">
            <input type="password" v-model="user.password" class="form-control password" placeholder="your password">
        </fieldset>
        <fieldset class="form-group">
            <button class="btn btn-block btn-default">Login</button>
        </fieldset>
    </form>
</template>

<script>

import auth from '../core/auth'

export default {
    props: ['token'],
    
    data() {
        return {
            user: {
                username: null,
                password: null
            },
            error: false
        }
    },

    methods: {
        login() {
            auth.login(this.user).then(result => {
                this.error = !result.data

                if (!this.error) {
                    window.location.href = '/dashboard'
                }
            })
        }
    }
}

</script>