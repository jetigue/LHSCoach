require('./bootstrap');

Vue.component('athletes', require('./components/Athletes.vue').default);
Vue.component('physicals', require('./components/Physicals.vue').default);
Vue.component('sports', require('./components/Sports.vue').default);

Vue.component('cancel-button', require('./components/buttons/CancelButton').default);
Vue.component('create-button', require('./components/buttons/CreateButton').default);
Vue.component('delete-button', require('./components/buttons/DeleteButton').default);
Vue.component('edit-button', require('./components/buttons/EditButton').default);
Vue.component('expand-button', require('./components/buttons/ExpandButton').default);
Vue.component('update-button', require('./components/buttons/UpdateButton').default);

new Vue({
    el: '#app',
});
