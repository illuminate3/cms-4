<template>
    <div class="auth">
        <div class="header">
            <h4>Total Marketing Concepts</h4>
            <p>Verizon Wireless CMS</p>
        </div>
        <form @submit.prevent="login">
            <fieldset class="form-group" :class="{ 'has-danger': error }">
                <label :class="{ 'text-danger': error }">Username</label>
                <input type="text" v-model="user.username" class="form-control">
            </fieldset>
            <fieldset class="form-group" :class="{ 'has-danger': error }">
                <label :class="{ 'text-danger': error }">Password</label>
                <input type="password" v-model="user.password" class="form-control">
            </fieldset>
            <fieldset class="form-group">
                <button class="btn btn-block btn-default">Login</button>
            </fieldset>
        </form>
        <p class="text-xs-center">
            <a href="" class="text-muted">Forgot Your Password?</a>
        </p>
    </div>
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