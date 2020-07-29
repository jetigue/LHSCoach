<template>
    <form action="/api/athletes" method="POST" id="newSport"
        @submit.prevent="onSubmit" @keydown="form.errors.clear()">

        <div class="py-2">
            <div class="flex justify-between content-end">
                <label class="text-sm font-semibold text-red-900" for="form.name">
                    Name
                </label>
                <span id="nameHelp"
                      class="text-red-600 text-xs font-semibold"
                      v-if="form.errors.has('name')"
                      v-text="form.errors.get('name')">
                            </span>
            </div>
            <input id="form.name"
                   type="text"
                   v-model="form.name"
                   class="w-full rounded border px-3 py-2 text-lg border shadow-md"
                   required
            >
        </div>

        <div class="my-2">
            <div class="flex justify-between content-end">
                <label class="text-sm font-semibold text-red-900">Season</label>
                <span id="seasonHelp"
                      class="text-red-600 text-xs font-semibold"
                      v-if="form.errors.has('season')"
                      v-text="form.errors.get('season')">
                            </span>
            </div>
            <select id="form.season"
                    name="season"
                    v-model="form.season"
                    class="w-full rounded border px-3 py-2 text-lg border shadow-md "
                    required
            >
                <option value="fall">Fall</option>
                <option value="winter">Winter</option>
                <option value="spring">Spring</option>
            </select>
        </div>

        <div class="text-right pt-2">
            <button type="submit"
                    class="bg-green-500 text-white w-20 py-2 rounded-md"
                    :disabled="form.errors.any()">
                Create
            </button>
        </div>
    </form>
</template>

<script>
    export default {
        name: "NewAthleteForm",

        data() {
            return {
                form: new Form({
                    name: '',
                    season: ''
                })
            };
        },

        created() {
            Event.$on('cancel', () => this.resetForm());
        },

        methods: {
            onSubmit() {
                this.form
                    .post('/api/sports')

                    .then(data => {

                        Event.$emit('formSubmitted');

                         const Toast = Vue.swal.mixin({
                             toast: true,
                             position: 'top-end',
                             showConfirmButton: false,
                             timer: 2500,
                             timerProgressBar: true,
                             onOpen: (toast) => {
                                 toast.addEventListener('mouseenter', Vue.swal.stopTimer)
                                 toast.addEventListener('mouseleave', Vue.swal.resumeTimer)
                             }
                         })

                         Toast.fire({
                             icon: 'success',
                             title: 'Sport Added!'
                         });

                        this.$emit('created', data)
                        this.resetForm()
                    })

                    .catch(errors => console.log(errors));
            },

            resetForm() {
                this.form.name = ''
                this.form.season = ''
                this.form.errors.clear();
            }
        }
    }
</script>

<style scoped>

</style>