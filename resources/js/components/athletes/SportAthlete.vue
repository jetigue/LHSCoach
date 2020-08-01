<template>
    <div class="">
        <div v-if="editing" class="p-3">
            <div class="w-full lg:w-1/2 mx-auto">
                <form action="api/athletes/id" method="POST" id="editSportAthlete" @submit.prevent="update"
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
                    <div class="flex pt-1 w-11/12 px-2">
                        <div class="flex w-full lg:w-1/3">
                            <a :href="url" class="hover:font-semibold hover:underline">
                                {{ last_name }}, {{ first_name }}
                            </a>
                        </div>
                        <div class="flex w-1/3 px-2">
                            <div class="w-full"
                                 :style="{color: statusColor}">
                                        {{ physicalStatus }}
                                <span v-if="allClear"><i class="fas fa-check"></i> </span>
                                <span v-else-if="restrict"><i class="fas fa-exclamation"></i></span>
                                <span v-else><i class="fas fa-times"></i></span>
                            </div>
                        </div>
                        <div class="flex w-1/3 px-2">
                            <div v-if="this.data.latest_physical" class="w-full" :style="{color: expirationColor}">
                                {{ expiration }}
                                <span>{{ exam_date | moment("add", "1 year") | moment("from", "now") }}</span>
                            </div>
                            <div v-else class="w-full text-gray-500">
                                No Physical on File
                            </div>
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
                                <span class="text-gray-800 font-semibold">{{ gender }}</span>
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
                                <div v-if="this.physicalStatus === 'Not Cleared'">
                                    <p class="text-gray-500 w-full py-1 px-1">Missing:</p>
                                    <div class="text-sm px-1">
                                        <p v-show="!historyFormConfirmed">Medical History Form</p>
                                        <p v-show="!physicalExamFormConfirmed">Physical Exam Form</p>
                                        <p v-show="!eligibilityFormConfirmed">Elegibility Form</p>
                                        <p v-show="!physicalFormConfirmed">LHS Physical Form</p>
                                        <p v-show="!blanketFormConfirmed">Blanket Waiver Form</p>
                                        <p v-show="!concussionFormConfirmed">Concussion Form</p>
                                        <p v-show="!cardiacFormConfirmed">Cardiac Form</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-start cursor-pointer pt-1">
                        <edit-button @clicked="getSports"></edit-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {physicalsMixin} from "../../mixins/physicalsMixin";
    export default {
        name: "SportAthlete",
        mixins: [physicalsMixin],
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
                gender: this.data.gender,
                fall_sport_id: this.data.fall_sport_id,
                winter_sport_id: this.data.winter_sport_id,
                spring_sport_id: this.data.spring_sport_id,

                url: '/athletes/' + this.data.slug,

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
                winterSports: []
            }
        },

        computed: {
            exam_date() {
                if (this.data.latest_physical) {
                    return this.data.latest_physical.exam_date
                }
            },

            historyFormConfirmed() {
                if (this.data.latest_physical) {
                    return this.data.latest_physical.history_form === 1
                }
            },

            physicalExamFormConfirmed() {
                if (this.data.latest_physical) {
                    return this.data.latest_physical.physical_exam_form === 1
                }
            },

            eligibilityFormConfirmed() {
                if (this.data.latest_physical) {
                    return this.data.latest_physical.medical_eligibility_form === 1
                }
            },

            physicalFormConfirmed() {
                if (this.data.latest_physical) {
                    return this.data.latest_physical.physical_form === 1
                }
            },

            blanketFormConfirmed() {
                if (this.data.latest_physical) {
                    return this.data.latest_physical.blanket_waiver_form === 1
                }
            },

            concussionFormConfirmed() {
                if (this.data.latest_physical) {
                    return this.data.latest_physical.ghsa_concussion_form === 1
                }
            },

            cardiacFormConfirmed() {
                if (this.data.latest_physical) {
                    return this.data.latest_physical.ghsa_cardiac_form === 1
                }
            },
        },

        methods: {
            toggleRow() {
                this.isExpanded = !this.isExpanded
            },

            getSports() {
                this.editing = true;

                function getFallSports() {
                    return axios.get('/api/fall/sports/')
                }

                function getWinterSports() {
                    return axios.get('/api/winter/sports/')
                }

                function getSpringSports() {
                    return axios.get('/api/spring/sports')
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

            resetForm() {
                this.form.first_name = this.first_name
                this.form.last_name = this.last_name
                this.form.sex = this.sex
                this.form.dob = this.dob
                this.form.grad_year = this.grad_year
                this.isExpanded = false;
            },
        },
    }
</script>

<style scoped>

</style>
