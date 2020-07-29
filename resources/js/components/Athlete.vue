<template>
    <div class="">
        <div v-if="editing" class="p-3">
            <div class="w-full lg:w-1/2 mx-auto">
                <form action="api/athletes/id" method="POST" id="editAthlete" @submit.prevent="update"
                      @keydown="form.errors.clear()"
                      class="bg-gray-200 shadow-md rounded px-8 pt-6 pb-8 mb-4">
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

                    <div class="py-2">
                        <div class="flex justify-between content-end">
                            <label class="text-sm font-semibold text-red-900">
                                Fall Sport
                            </label>
                            <span id="fallSportHelp"
                                  class="text-red-600 text-xs font-semibold"
                                  v-if="form.errors.has('fall_sport_id')"
                                  v-text="form.errors.get('fall_sport_id')">
                            </span>
                        </div>
                        <select class="form-input" name="fall_sport_id" v-model="form.fall_sport_id" required>
                            <option v-for="sport in fallSports" :key="sport.id" :value="sport.id">
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
        <div v-else class="flex py-1 items-center hover:bg-gray-200">
            <div class="flex flex-col w-full">
                <div class="flex w-full">
                    <div class="flex pt-1 w-11/12 px-2" :class="{'font-semibold': active}">
                        <div class="flex w-1/3">
                            {{ last_name }}, {{ first_name }}
                        </div>
                        <div class="flex w-1/3">
                            <div v-if="fallSport" class="px-2">{{ fallSport }}</div>
                            <div v-if="winterSport" class="px-2">{{ winterSport }}</div>
                            <div v-if="springSport" class="px-2">{{ springSport }}</div>

                        </div>
                        <div class="flex w-1/3 px-2">
                             <physical-status :data="data"></physical-status>
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

                            <p class="text-gray-500 w-full py-1">Active:
                                <a v-if="active" class="" @click="inactivate">
                                    <span class="text-lg" style="color:green;">
                                        <i class="fas fa-check-square"></i>
                                    </span>
                                </a>
                                <a v-else
                                   @click="activate">
                                    <span class="text-lg text-gray-500">
                                        <i class="far fa-square bg-white"></i>
                                    </span>
                                </a>
                            </p>
                        </div>
                        <div class="flex w-2/3">
                            <div class="flex w-full">
                                <div class="flex flex-col w-1/3">
                                    Hello

                                </div>
                            </div>

<!--                                <div class="text-gray-500 w-full py-1">{{ sport.name }}-->
<!--                                    <a v-if="enrolledXC" class="" @click="dropXC">-->
<!--                                        <span class="text-lg" style="color:green;">-->
<!--                                            <i class="fas fa-check-square"></i>-->
<!--                                        </span>-->
<!--                                    </a>-->
<!--                                    <a v-else-->
<!--                                       @click="enrollXC">-->
<!--                                        <span class="text-lg text-gray-500">-->
<!--                                            <i class="far fa-square bg-white"></i>-->
<!--                                        </span>-->
<!--                                    </a>-->
<!--                                </div>-->
<!--                            </div>-->
                        </div>
                    </div>
                    <div class="flex justify-start cursor-pointer pt-1">
                        <edit-button @clicked="editing=true"></edit-button>
                        <delete-button @clicked="destroy"></delete-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import PhysicalStatus from "./PhysicalStatus";
    export default {
        name: "Athlete",
        components: {PhysicalStatus},
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
                status: this.data.status,

                form: new Form({
                    first_name: this.data.first_name,
                    last_name: this.data.last_name,
                    sex: this.data.sex,
                    dob: this.data.dob,
                    grad_year: this.data.grad_year,
                    status: this.data.status,
                }),

                fallSports: []
            }
        },

        computed: {
            sexName() {
                return this.sex === 'm' ? "Male" : "Female";
            },

            isInactive: function () {
                if (this.status === 'i') {
                    return true;
                }
            },

            fallSport() {
                if (this.data.fall_sport !== null) {
                    return this.data.fall_sport.name
                }
            },

            winterSport() {
                if (this.data.winter_sport !== null) {
                    return this.data.winter_sport.name
                }
            },

            springSport() {
                if (this.data.spring_sport !== null) {
                    return this.data.spring_sport.name
                }
            }
        },

        methods: {
            toggleRow() {
                this.isExpanded = !this.isExpanded
                this.getSports();
            },

            getSports() {
                function getFallSports() {
                    return axios.get('api/sports/fall')
                }

                function getWinterSports() {
                    return axios.get('api/sports/winter')
                }

                function getSpringSports() {
                    return axios.get('api/sports/spring')
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


            activate() {
                axios.patch('api/athletes/' + this.data.id, {
                    status: this.status = 'a',
                    last_name: this.last_name,
                    first_name: this.first_name,
                    sex: this.sex,
                    dob: this.dob,
                    grad_year: this.grad_year
                })
                .catch(errors => {
                        console.log(errors);
                });

                this.active = true;
            },

            inactivate() {
                axios.patch('/api/athletes/' + this.data.id, {
                    status: this.status = 'i',
                    last_name: this.last_name,
                    first_name: this.first_name,
                    sex: this.sex,
                    dob: this.dob,
                    grad_year: this.grad_year
                })
                .catch(errors => {
                        console.log(errors);
                });

                this.active = false;
            },

            // enrollXC() {
            //     axios.post('/athletes/' + this.data.id + '/sports', {
            //         athlete_id: this.data.id,
            //     })
            //     .then((response) => {
            //       console.log(response);
            //     }, (error) => {
            //       console.log(error);
            //     });
            //
            //     this.enrolledXC = true;
            // },

            // dropXC() {
            //     this.enrolledXC = false
            //     console.log('dropped')
            // },

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
                        this.status = this.data.status

                        this.editing = false;
                        this.isExpanded = false;

                         if (
                             this.first_name !== this.data.first_name ||
                             this.last_name !== this.data.last_name ||
                             this.sex !== this.data.sex ||
                             this.dob !== this.data.dob ||
                             this.grad_year !== this.data.grad_year
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
                this.isExpanded = false;
            },
        },
    }
</script>

<style scoped>

</style>