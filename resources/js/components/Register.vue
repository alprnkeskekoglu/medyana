<template>
    <div>
        <alert></alert>
        <form>
            <div class="form-group">
                <div class="input-group">
                    <input type="test" class="form-control" v-model="data.name" placeholder="Name">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="fa fa-user-circle"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <input type="email" class="form-control" v-model="data.email" placeholder="Email">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="fa fa-envelope-open"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <input type="password" class="form-control" v-model="data.password" placeholder="Password">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="fa fa-asterisk"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <input type="password" class="form-control" v-model="data.password_confirmation" placeholder="Password Confirm">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="fa fa-asterisk"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group d-sm-flex justify-content-sm-between align-items-sm-center text-center text-sm-left">
                <div class="font-w600 font-size-sm py-1">
                    <a href="/login"><i class="fa fa-sign-in-alt mr-1"></i>Sign In</a>
                </div>
            </div>
            <div class="form-group text-center">
                <button type="button" class="btn btn-hero-primary" @click="sendForm">
                    <i class="fa fa-fw fa-plus mr-1"></i> Sign Up
                </button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: "Register",
    data() {
        return {
            data: {
                _token: window._token,
                name: null,
                email: null,
                password: null,
                password_confirmation: null,
            },
        }
    },
    methods: {
        sendForm() {
            axios.post('/register', this.data).
            then(response => {
                this.$root.success = response.data.message;
                setTimeout(function () {
                    window.location.href = '/login';
                }, 1250)
            }).catch(e => {
                this.$root.success = null;
                this.$root.errors = e.response.data.errors;
            })
        }
    }
}
</script>

