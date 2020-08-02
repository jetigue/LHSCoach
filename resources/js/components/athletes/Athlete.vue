<template>
    <div class="">
        <div v-if="editing" class="p-3">
            <div class="w-full lg:w-1/2 mx-auto">
                <form action="api/athletes/id" method="POST" id="editAthlete" @submit.prevent="update"
                      @keydown="form.errors.clear()"
                      class="bg-gray-100 shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    <div class="flex items-center mb-4">
                        <div class="form-label ml-1">
                            <p>id</p>
                        </div>
                        <div class="w-full text-gray-800 px-4">
                            <p v-text="id"></p>
                        </div>
                    </div>

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
                               class="w-full rounded px-3 h-10 text-blue-800 font-semibold shadow-md"
                               autocomplete="off"
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
                               class="w-full rounded px-3 h-10 text-blue-800 font-semibold shadow-md"
                               autocomplete="off"
                               required
                        >
                    </div>

                    <div class="py-2">
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
                                class="w-full rounded px-3 h-10 text-blue-800 font-semibold shadow-md"
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
                               class="w-full rounded px-3 h-10 text-blue-800 font-semibold shadow-md"
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
                               class="w-full rounded px-3 h-10 text-blue-800 font-semibold shadow-md"
                               required
                        >
                    </div>

                    <div class="py-2">
                        <div class="flex justify-between content-end">
                            <label class="text-sm font-semibold text-red-900" for="form.fall_sport_id">
                                Fall Sport
                            </label>
                            <span
                                id="fallSportHelp"
                                class="text-red-600 text-xs font-semibold"
                                v-if="form.errors.has('fall_sport_id')"
                                v-text="form.errors.get('fall_sport_id')">
                            </span>
                        </div>
                        <select
                            class="w-full rounded px-3 h-10 text-blue-800 font-semibold shadow-md"
                            name="fall_sport_id"
                            v-model="form.fall_sport_id"
                            id="form.fall_sport_id"
                            required>
                            <option v-for="sport in fallSports" :key="sport.id" :value="sport.id">
                                {{ sport.name }}
                            </option>
                        </select>
                    </div>

                    <div class="py-2">
                        <div class="flex justify-between content-end">
                            <label class="text-sm font-semibold text-red-900" for="form.winter_sport_id">
                                Winter Sport
                            </label>
                            <span
                                id="winterSportHelp"
                                class="text-red-600 text-xs font-semibold"
                                v-if="form.errors.has('winter_sport_id')"
                                v-text="form.errors.get('winter_sport_id')">
                            </span>
                        </div>
                        <select
                            class="w-full rounded px-3 h-10 text-blue-800 font-semibold shadow-md"
                            name="winter_sport_id"
                            v-model="form.winter_sport_id"
                            id="form.winter_sport_id"
                            required>
                            <option v-for="sport in winterSports" :key="sport.id" :value="sport.id">
                                {{ sport.name }}
                            </option>
                        </select>
                    </div>

                    <div class="py-2">
                        <div class="flex justify-between content-end">
                            <label class="text-sm font-semibold text-red-900" for="form.spring_sport_id">
                                Spring Sport
                            </label>
                            <span
                                id="springSportHelp"
                                class="text-red-600 text-xs font-semibold"
                                v-if="form.errors.has('spring_sport_id')"
                                v-text="form.errors.get('spring_sport_id')">
                            </span>
                        </div>
                        <select
                            class="w-full rounded px-3 h-10 text-blue-800 font-semibold shadow-md"
                            name="spring_sport_id"
                            v-model="form.spring_sport_id"
                            id="form.spring_sport_id"
                            required>
                            <option v-for="sport in springSports" :key="sport.id" :value="sport.id">
                                {{ sport.name }}
                            </option>
                        </select>
                    </div>

                    <div class=" pt-2 flex items-center justify-end">
                        <update-button class="mr-4" :disabled="form.errors.any()">
                            Update
                        </update-button>
                        <cancel-button @clicked="resetForm"></cancel-button>
                    </div>
                </form>
            </div>
        </div>
        <div v-else class="flex py-1 items-center hover:bg-gray-100">
            <div class="flex flex-col w-full">
                <div class="flex w-full">
                    <div class="flex pt-1 w-11/12 px-2 flex-wrap">
                        <div class="flex w-full lg:w-1/3">
                            <a :href="athleteUrl" class="hover:font-semibold hover:underline">
                                {{ last_name }}, {{ first_name }}
                            </a>

                        </div>
                        <div class="hidden lg:flex lg:w-1/6">
                            {{ sexName }}
                        </div>
                        <div class="hidden lg:flex lg:w-1/6">
                             {{ grade }}
                        </div>
                        <div class="flex flex-col w-full text-gray-700 lg:text-black lg:flex-row lg:w-1/3">
                            <span v-show="fallSport" class="px-2">
                                <a :href="fallSportUrl" class="hover:font-semibold hover:underline">
                                    {{ fallSport }}
                                </a>
                            </span>
                            <span v-show="winterSport" class="px-2">
                                <a :href="winterSportUrl" class="hover:font-semibold hover:underline">
                                    {{ winterSport }}
                                </a>
                            </span>
                            <span v-show="springSport" class="px-2">
                                <a :href="springSportUrl" class="hover:font-semibold hover:underline">
                                    {{ springSport }}
                                </a>

                            </span>
                        </div>
                    </div>
                    <div class="flex w-1/12 pt-1 justify-end px-4">
                        <expand-button @toggleRow="toggleRow" class=""></expand-button>
                    </div>
                </div>
                <div v-if="isExpanded" class="p-2">
                    <div class="flex w-11/12 flex-wrap px-4">
                        <div class="flex flex-col w-full lg:w-1/3">
                            <p class="text-gray-500 w-full py-1">Sex:
                                <span class="text-gray-800 font-semibold">{{ sexName }}</span>
                            </p>

                            <p class="text-gray-500 w-full py-1">DOB:
                                <span class="text-gray-800 font-semibold">{{ dob | moment("MM/DD/YYYY") }}</span>
                                <span class="text-gray-500 text-sm font-semibold">{{ age }} years old</span>
                            </p>


                            <p class="text-gray-500 w-full py-1">Class:
                                <span class="text-gray-800 font-semibold">{{ grad_year }}</span>
                                <span class="text-gray-500 text-sm font-semibold">{{ grade }}</span>
                            </p>

                        </div>
                        <div class="flex w-2/3">
                            <div class="flex w-full">
                                <div class="flex flex-col w-1/3">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-start cursor-pointer pt-1">
                        <edit-button @clicked="getSports"></edit-button>
                        <delete-button @clicked="destroy"></delete-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        name: "Athlete",
        props: ['data'],

        data() {
            return {
                editing: false,
                isExpanded: false,
                active: this.data.status === 'a',

                age: this.data.age,
                dob: this.data.dob,
                first_name: this.data.first_name,
                grad_year: this.data.grad_year,
                grade: this.data.class,
                id: this.data.id,
                last_name: this.data.last_name,
                sex: this.data.sex,
                fall_sport_id: this.data.fall_sport_id,
                winter_sport_id: this.data.winter_sport_id,
                spring_sport_id: this.data.spring_sport_id,

                athleteUrl: '/athletes/' + this.data.slug,
                fallSportUrl: '/fall/sports/' + this.data.fall_sport.slug,
                winterSportUrl: '/winter/sports/' + this.data.winter_sport.slug,
                springSportUrl: '/spring/sports/' + this.data.spring_sport.slug,


                form: new Form({
                    first_name: this.data.first_name,
                    last_name: this.data.last_name,
                    sex: this.data.sex,
                    dob: this.data.dob,
                    grad_year: this.data.grad_year,
                    fall_sport_id: this.data.fall_sport_id,
                    winter_sport_id: this.data.winter_sport_id,
                    spring_sport_id: this.data.spring_sport_id
                }),

                fallSports: [],
                springSports: [],
                winterSports: [],
            }
        },

        computed: {
            sexName() {
                return this.sex === 'm' ? "Male" : "Female";
            },

            fallSport() {
                if (this.data.fall_sport_id !== 1) {
                    return this.data.fall_sport.name
                }
                return ''
            },

            winterSport() {
                if (this.data.winter_sport_id !== 1) {
                    return this.data.winter_sport.name
                }
                return ''
            },

            springSport() {
                if (this.data.spring_sport_id !== 1) {
                    return this.data.spring_sport.name
                }
                return ''
            }
        },

        methods: {
            toggleRow() {
                this.isExpanded = !this.isExpanded
            },

            getSports() {
                this.editing = true;

                function getFallSports() {
                    return axios.get('api/fall/sports/')
                }

                function getWinterSports() {
                    return axios.get('api/winter/sports/')
                }

                function getSpringSports() {
                    return axios.get('api/spring/sports')
                }

                axios.all([
                    getFallSports(),
                    getWinterSports(),
                    getSpringSports(),

                ])
                    .then(axios.spread((
                        fallResponse,
                        winterResponse,
                        springResponse
                    ) => {
                        this.fallSports = fallResponse.data;
                        this.winterSports = winterResponse.data;
                        this.springSports = springResponse.data;
                    }));
            },

            update() {
                this.form
                    .patch('/api/athletes/' + this.data.id)
                    .then(data => {
                        this.first_name = this.form.first_name;
                        this.last_name = this.form.last_name;
                        this.sex = this.form.sex;
                        this.grad_year = this.form.grad_year;
                        this.dob = this.form.dob;
                        this.name = this.form.last_name + ", " + this.form.first_name;
                        this.fall_sport_id = this.form.fall_sport_id;
                        this.winter_sport_id = this.form.winter_sport_id;
                        this.spring_sport_id = this.form.spring_sport_id;

                        this.editing = false;
                        this.isExpanded = false;

                         if (
                             this.first_name !== this.data.first_name ||
                             this.last_name !== this.data.last_name ||
                             this.sex !== this.data.sex ||
                             this.dob !== this.data.dob ||
                             this.grad_year !== this.data.grad_year ||
                             this.fall_sport_id !== this.data.fall_sport_id ||
                             this.winter_sport_id !== this.data.winter_sport_id ||
                             this.spring_sport_id !== this.data.spring_sport_id
                             )
                         {
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
                                 title: 'Athlete Updated!'
                             });
                         }
                    })
                    .catch(errors => {
                        console.log(errors);
                    });
            },

            destroy() {
                axios.delete('api/athletes/' + this.data.id);

                this.$emit('deleted', this.data.id);
            },

            resetForm() {
                this.form.first_name = this.first_name
                this.form.last_name = this.last_name
                this.form.sex = this.sex
                this.form.dob = this.dob
                this.form.grad_year = this.grad_year
                this.form.fall_sport_id = this.fall_sport_id
                this.form.winter_sport_id = this.winter_sport_id
                this.form.spring_sport_id = this.spring_sport_id
                this.isExpanded = false;
            },
        },
    }
</script>

<style scoped>

</style>
