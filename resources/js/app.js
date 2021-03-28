require('./bootstrap');

window.Vue = require('vue');

Vue.component('register', require('./components/Register.vue').default);
Vue.component('login', require('./components/Login.vue').default);

if(document.getElementById("register")){
    window.register = new Vue({
        el: '#register',
    });
}
if(document.getElementById("login")){
    window.register = new Vue({
        el: '#login',
    });
}
