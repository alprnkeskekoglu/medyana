require('./bootstrap');

window.Vue = require('vue');

Vue.component('register', require('./components/Register.vue').default);
Vue.component('login', require('./components/Login.vue').default);

Vue.component('alert', require('./components/Alert.vue').default);

Vue.component('clinic-index', require('./components/clinics/Index.vue').default);
Vue.component('clinic-create', require('./components/clinics/Create.vue').default);
Vue.component('clinic-edit', require('./components/clinics/Edit.vue').default);

if(document.getElementById("register")){
    window.register = new Vue({
        el: '#register',
        data: {
            errors: {},
            success: null
        }
    });
}
if(document.getElementById("login")){
    window.register = new Vue({
        el: '#login',
        data: {
            errors: {},
            success: null
        }
    });
}
if(document.getElementById("app")){
    window.app = new Vue({
        el: '#app',
        data: {
            errors: {},
            success: null
        }
    });
}

