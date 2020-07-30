<template>
    <form action="/api/athletes" method="POST" id="newAthlete"
        @submit.prevent="onSubmit" @keydown="form.errors.clear()">

        <div class="py-2">
            <div class="flex justify-between content-end">
                <label class="text-sm font-semibold text-red-900" for="form.first_name">
                    First Name
                </label>
                <span id="first_nameHelp"
                      class="text-red-600 text-xs font-semibold"
                      v-if="form.errors.has('first_name')"
                      v-text="form.errors.get('first_name')">
                            </span>
            </div>
            <input id="form.first_name"
                   type="text"
                   v-model="form.first_name"
                   class="w-full rounded border px-3 py-2 text-lg border shadow-md"
                   required
            >
        </div>

        <div class="py-2">
            <div class="flex justify-between content-end">
                <label class="text-sm font-semibold text-red-900" for="form.last_name">
                    Last Name
                </label>
                <span id="last_nameHelp"
                      class="text-red-600 text-xs font-semibold"
                      v-if="form.errors.has('last_name')"
                      v-text="form.errors.get('last_name')">
                            </span>
            </div>
            <input id="form.last_name"
                   type="text"
                   v-model="form.last_name"
                   class="w-full rounded border px-3 py-2 text-lg border shadow-md"
                   required
            >
        </div>

        <div class="my-2">
            <div class="flex justify-between content-end">
                <label class="text-sm font-semibold text-red-900">Sex</label>
                <span id="sexHelp"
                      class="text-red-600 text-xs font-semibold"
                      v-if="form.errors.has('sex')"
                      v-text="form.errors.get('sex')">
                            </span>
            </div>
            <select id="form.sex"
                    name="sex"
                    v-model="form.sex"
                    class="w-full rounded border px-3 py-2 text-lg border shadow-md"
                    required
            >
                <option value="f">Female</option>
                <option value="m">Male</option>
            </select>
        </div>

        <div class="py-2">
            <div class="flex justify-between content-end">
                <label class="text-sm font-semibold text-red-900" for="form.dob">Date of Birth</label>
                <span id="dobHelp"
                      class="text-red-600 text-xs font-semibold"
                      v-if="form.errors.has('dob')"
                      v-text="form.errors.get('dob')">
                            </span>
            </div>
            <input id="form.dob"
                   type="date"
                   v-model="form.dob"
                   class="w-full rounded border px-2 py-1 text-lg border shadow-md"
            >
        </div>

        <div class="py-2">
            <div class="flex justify-between content-end">
                <label class="text-sm font-semibold text-red-900" for="form.grad_year">Graduation Year</label>
                <span id="grad_yearHelp"
                      class="text-red-600 text-xs font-semibold"
                      v-if="form.errors.has('grad_year')"
                      v-text="form.errors.get('grad_year')">
                </span>
            </div>
            <input id="form.grad_year"
                   type="number"
                   min="2009"
                   max="2025"
                   v-model="form.grad_year"
                   class="w-full rounded border px-3 py-2 text-lg border shadow-md"
                   required
            >
        </div>

        <div class="mb-2">
            <div class="flex justify-between content-end">
                <label class="text-sm font-semibold text-red-900" for="form.grad_year">Status</label>
                <span id="statusHelp"
                      class="text-red-600 text-xs font-semibold"
                      v-if="form.errors.has('status')"
                      v-text="form.errors.get('status')">
                </span>
            </div>
            <select id="form.status"
                    name="status"
                    v-model="form.status"
                    class="w-full rounded border px-3 py-2 text-lg border shadow-md"
                    required
            >
                <option value="a">Active</option>
                <option value="i">Inactive</option>
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
                    first_name: '',
                    last_name: '',
                    sex: '',
                    dob: '',
                    grad_year: '',
                    status: ''
                })
            };
        },

        created() {
            Event.$on('cancel', () => this.resetForm());
        },

        methods: {
            onSubmit() {
                this.form
                    .post('/api/athletes')

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
                             title: 'Athlete Added!'
                         });

                        this.$emit('created', data)
                        this.resetForm()
                    })

                    .catch(errors => console.log(errors));
            },

            resetForm() {
                this.form.first_name = ''
                    this.form.last_name = ''
                    this.form.sex = ''
                    this.form.dob = ''
                    this.form.grad_year = ''
                    this.form.status = ''
                    this.form.errors.clear();
            }
        }
    }
</script>

<style scoped>

</style>
