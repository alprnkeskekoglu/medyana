<template>
    <div>
        <alert></alert>
        <form>
            <div class="form-group">
                <div class="input-group">
                    <input type="text" class="form-control" v-model="data.email" placeholder="Email">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="fa fa-envelope-open"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <input type="password" class="form-control" v-model="data.password"  placeholder="Password">
                    <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fa fa-asterisk"></i>
                            </span>
                    </div>
                </div>
            </div>
            <div class="form-group d-sm-flex justify-content-sm-between align-items-sm-center text-center text-sm-left">
                <div class="custom-control custom-checkbox custom-control-primary">
                    <input type="checkbox" class="custom-control-input" id="remember-me" v-model="data.remember">
                    <label class="custom-control-label" for="remember-me">Remember Me</label>
                </div>
                <div class="font-w600 font-size-sm py-1">
                    <a href="/register"><i class="fa fa-plus mr-1"></i>New Account</a>
                </div>
            </div>
            <div class="form-group text-center">
                <button type="button" class="btn btn-hero-primary" @click="sendLoginForm">
                    <i class="fa fa-fw fa-sign-in-alt mr-1"></i> Sign In
                </button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: "Login",
    data() {
        return {
            data: {
                _token: window._token,
                email: window.email,
                password: null,
                remember: 1,
            },
        }
    },
    methods: {
        sendLoginForm() {
            axios.post('/login', this.data).
            then(response => {
                window.location.href = '/clinics';
            }).catch(e => {
                this.$root.errors = e.response.data.errors;
            })
        }
    }
}
</script>

<style scoped>

</style>
