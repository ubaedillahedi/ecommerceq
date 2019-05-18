/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

$(document).on('click', '#clickme', function(){
    alert('You clicked me');
});

$(document).on('click', '#clicksuccess', function(){
    console.log('Huahhhh')
});

$(document).on('click', '.js-submit-confirm', function(event){
    event.preventDefault();
    var $form = $(this).closest('form');
    var $el = $(this);
    var text = $el.data('confirm-message') ? $el.data('confirm-message') : 'Kamu tidak akan bisa membatalkan proses ini!';
    swal({
        title : 'Kamu yakin?',
        text : text,
        icon: "warning",
        buttons: ["Batal", "Yap, Lanjutkan!"],
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
          $form.submit();
        }
    });
});

