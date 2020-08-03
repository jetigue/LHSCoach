require('./bootstrap');

Vue.component('athletes', require('./components/athletes/Athletes.vue').default);
Vue.component('sport-athletes', require('./components/athletes/SportAthletes.vue').default);

Vue.component('physicals', require('./components/physicals/Physicals.vue').default);
Vue.component('profile-physicals', require('./components/physicals/ProfilePhysicals.vue').default);

Vue.component('fall-sports', require('./components/sports/FallSports.vue').default);
Vue.component('winter-sports', require('./components/sports/WinterSports.vue').default);
Vue.component('spring-sports', require('./components/sports/SpringSports.vue').default);

Vue.component('cancel-button', require('./components/buttons/CancelButton').default);
Vue.component('create-button', require('./components/buttons/CreateButton').default);
Vue.component('delete-button', require('./components/buttons/DeleteButton').default);
Vue.component('edit-button', require('./components/buttons/EditButton').default);
Vue.component('expand-button', require('./components/buttons/ExpandButton').default);
Vue.component('update-button', require('./components/buttons/UpdateButton').default);

Vue.component('paginator', require('./components/Paginator').default);

new Vue({
    el: '#main',
});

