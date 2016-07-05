<template>
    <div class="auth login-form">
        <form @submit.prevent="login">
            <div class="form-group">
                <input type="text" name="username" class="form-control login-field" id="username" placeholder="Enter your username">
                <label class="login-field-icon fui-user" for="username"></label>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control login-field" id="password" placeholder="Password">
                <label class="login-field-icon fui-lock" for="password"></label>
            </div>
            <button class="btn btn-primary btn-lg btn-block">Log in</button>
            <a href="" class="login-link">forgot your password?</a>
        </form>
    </div>
</template>

<script>

export default {
    data() {
        return {
            user: {
                username: null,
                password: null
            }
        }
    },
    methods: {
        login() {
           console.log(this.user)
        }
    }
}

</script>