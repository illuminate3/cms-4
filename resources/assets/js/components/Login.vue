<template>
    <div class="panel panel-default auth">
        <div class="panel-heading">Sign in to your account</div>
        <div class="panel-body">
            <form @submit.prevent="login" class="form-horizontal">
                <div class="form-group" v-bind:class="{ 'has-error': error }">
                    <label class="col-sm-3 text-right">username</label>
                    <div class="col-sm-7">
                        <input type="text" v-model="user.username" class="form-control" placeholder="Enter your username">
                    </div>
                </div>
                <div class="form-group" v-bind:class="{ 'has-error': error }">
                    <label class="col-sm-3 text-right">password</label>
                    <div class="col-sm-7">
                        <input type="password" v-model="user.password" class="form-control" placeholder="Password">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-7 col-sm-push-3">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember"> Keep me signed in
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-7 col-sm-offset-3">
                        <button class="btn btn-info">Log in</button>
                        <a href="" class="btn btn-link">Reset password</a>
                    </div>
                </div>
            </form>
        </div>
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