<template>
    <div class="">
        <div v-if="editing" class="p-3">
            <div class="w-full lg:w-1/2 mx-auto">
                <form action="api/physicals/id" method="POST" id="editPhysical" @submit.prevent="update"
                      @keydown="form.errors.clear()"
                      class="bg-gray-100 shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    <div class="flex items-center mb-4">
                        <div class="form-label ml-1">
                            <p>id</p>
                        </div>
                        <div class="w-full text-gray-800 px-4">
                            <p>{{ id }}</p>
                        </div>
                    </div>

                    <div class="mb-2">
                        <div class="flex justify-between content-end">
                            <label class="text-sm font-semibold text-red-900" for="form.athlete_id">
                                Athlete
                            </label>
                            <span id="athleteHelp" class="form-help" v-if="form.errors.has('athlete_id')"
                                  v-text="form.errors.get('athlete_id')">
                            </span>
                        </div>
                        <select
                            class="w-full rounded border px-3 py-2 text-lg border shadow-md"
                            name="athlete_id"
                            v-model="form.athlete_id"
                            id="form.athlete_id"
                            required>
                            <option v-for="athlete in athletes" :key="athlete.id" :value="athlete.id">
                                {{ athlete.last_name }}, {{ athlete.first_name }}
                            </option>
                        </select>
                    </div>

                    <div class="py-2">
                        <div class="flex justify-between content-end">
                            <label class="text-sm font-semibold text-red-900" for="form.exam_date">Exam Date</label>
                            <span id="exam_dateHelp"
                                  class="text-red-600 text-xs font-semibold"
                                  v-if="form.errors.has('exam_date')"
                                  v-text="form.errors.get('exam_date')">
                                        </span>
                        </div>
                        <input id="form.exam_date"
                               type="date"
                               v-model="form.exam_date"
                               class="w-full rounded border px-2 py-2 text-lg border shadow-md"
                        >
                    </div>

                    <div class="mt-2">
                        <p class="text-sm font-semibold text-red-900">Forms</p>
                    </div>

                    <div class="flex flex-col px-4">
                        <div class="flex items-center py-1">
                            <input
                                type="radio"
                                id="form.history_form"
                                value="1"
                                class="hidden"
                                v-model="form.history_form">
                                <a v-if="historyFormConfirmed" class="text-xl" @click="unconfirmHistoryForm">
                                    <span style="color:green;">
                                        <i class="fas fa-check-square"></i>
                                    </span>
                                </a>
                                <a v-else
                                   @click="confirmHistoryForm">
                                    <span class="text-xl text-gray-500">
                                        <i class="bg-white far fa-square"></i>
                                    </span>
                                </a>
                                <label for="form.history_form" class="text-sm font-semibold px-2">
                                    Medical History Form
                                    <span class="text-xs text-gray-600">student and parent signature</span>
                                </label>
                        </div>
                    </div>

                    <div class="flex flex-col px-4">
                        <div class="flex items-center py-1">
                            <input
                                type="radio"
                                id="form.physical_exam_form"
                                value="1"
                                class="hidden"
                                v-model="form.physical_exam_form">
                                <a v-if="physicalExamFormConfirmed" class="text-xl" @click="unconfirmPhysicalExamForm">
                                    <span style="color:green;">
                                        <i class="fas fa-check-square"></i>
                                    </span>
                                </a>
                                <a v-else
                                   @click="confirmPhysicalExamForm">
                                    <span class="text-xl text-gray-500">
                                        <i class="bg-white far fa-square"></i>
                                    </span>
                                </a>
                                <label for="form.physical_exam_form" class="text-sm font-semibold px-2">
                                    Physical Examination Form
                                    <span class="text-xs text-gray-600">physician's signature</span>
                                </label>
                        </div>
                    </div>

                    <div class="flex flex-col px-4">
                        <div class="flex items-center py-1">
                            <input
                                type="radio"
                                id="form.medical_eligibility_form"
                                value="1"
                                class="hidden"
                                v-model="form.medical_eligibility_form">
                                <a v-if="eligibilityFormConfirmed" class="text-xl" @click="unconfirmEligibilityForm">
                                    <span style="color:green;">
                                        <i class="fas fa-check-square"></i>
                                    </span>
                                </a>
                                <a v-else
                                   @click="confirmEligibilityForm">
                                    <span class="text-xl text-gray-500">
                                        <i class="bg-white far fa-square"></i>
                                    </span>
                                </a>
                                <label for="form.medical_eligibility_form" class="text-sm font-semibold px-2">
                                    Medical Eligibility Form
                                    <span class="text-xs text-gray-600">physician's signature</span>
                                </label>
                        </div>
                    </div>

                    <div class="flex flex-col px-4">
                        <div class="flex items-center py-1">
                            <input
                                type="radio"
                                id="form.physical_form"
                                value="1"
                                class="hidden"
                                v-model="form.physical_form">
                                <a v-if="physicalFormConfirmed" class="text-xl" @click="unconfirmPhysicalForm">
                                    <span style="color:green;">
                                        <i class="fas fa-check-square"></i>
                                    </span>
                                </a>
                                <a v-else
                                   @click="confirmPhysicalForm">
                                    <span class="text-xl text-gray-500">
                                        <i class="bg-white far fa-square"></i>
                                    </span>
                                </a>
                                <label for="form.physical_form" class="text-sm font-semibold px-2">
                                    LHS Physical Form
                                    <span class="text-xs text-gray-600">insurance information and parent signature</span>
                                </label>
                        </div>
                    </div>

                    <div class="flex flex-col px-4">
                        <div class="flex items-center py-1">
                            <input
                                type="radio"
                                id="form.blanket_waiver_form"
                                value="1"
                                class="hidden"
                                v-model="form.blanket_waiver_form">
                                <a v-if="blanketFormConfirmed" class="text-xl" @click="unconfirmBlanketForm">
                                    <span style="color:green;">
                                        <i class="fas fa-check-square"></i>
                                    </span>
                                </a>
                                <a v-else
                                   @click="confirmBlanketForm">
                                    <span class="text-xl text-gray-500">
                                        <i class="bg-white far fa-square"></i>
                                    </span>
                                </a>
                                <label for="form.blanket_waiver_form" class="text-sm font-semibold px-2">
                                    Blanket Waiver Form
                                    <span class="text-xs text-gray-600">2 parent signatures</span>
                                </label>
                        </div>
                    </div>

                    <div class="flex flex-col px-4">
                        <div class="flex items-center py-1">
                            <input
                                type="radio"
                                id="form.ghsa_concussion_form"
                                value="1"
                                class="hidden"
                                v-model="form.ghsa_concussion_form">
                                <a v-if="concussionFormConfirmed" class="text-xl" @click="unconfirmConcussionForm">
                                    <span style="color:green;">
                                        <i class="fas fa-check-square"></i>
                                    </span>
                                </a>
                                <a v-else
                                   @click="confirmConcussionForm">
                                    <span class="text-xl text-gray-500">
                                        <i class="bg-white far fa-square"></i>
                                    </span>
                                </a>
                                <label for="form.ghsa_concussion_form" class="text-sm font-semibold px-2">
                                    GHSA Concussion Form
                                    <span class="text-xs text-gray-600">student and parent signature</span>
                                </label>
                        </div>
                    </div>

                    <div class="flex flex-col px-4">
                        <div class="flex items-center py-1">
                            <input
                                type="radio"
                                id="form.ghsa_cardiac_form"
                                value="1"
                                class="hidden"
                                v-model="form.ghsa_cardiac_form">
                                <a v-if="cardiacFormConfirmed" class="text-xl" @click="unconfirmCardiacForm">
                                    <span style="color:green;">
                                        <i class="fas fa-check-square"></i>
                                    </span>
                                </a>
                                <a v-else
                                   @click="confirmCardiacForm">
                                    <span class="text-xl text-gray-500">
                                        <i class="bg-white far fa-square"></i>
                                    </span>
                                </a>
                                <label for="form.ghsa_cardiac_form" class="text-sm font-semibold px-2">
                                    GHSA Cardiac Form
                                    <span class="text-xs text-gray-600">student and parent signature</span>
                                </label>
                        </div>
                    </div>

                    <div class="py-2">
                        <div class="flex justify-between content-end">
                            <label class="text-sm font-semibold text-red-900" for="form.restrictions">Restrictions (if any)</label>
                            <span id="restrictionsHelp"
                                  class="text-red-600 text-xs font-semibold"
                                  v-if="form.errors.has('restrictions')"
                                  v-text="form.errors.get('restrictions')">
                            </span>
                        </div>
                        <input id="form.restrictions"
                               type="text"
                               v-model="form.restrictions"
                               class="w-full rounded border px-3 py-2 text-lg border shadow-md"
                        >
                    </div>

                    <div class="py-2">
                        <div class="flex justify-between content-end">
                            <label class="text-sm font-semibold text-red-900"
                                   for="form.notes">
                                Notes (optional)
                            </label>
                            <span id="notesHelp" class="form-help" v-if="form.errors.has('notes')"
                                  v-text="form.errors.get('notes')">
                            </span>
                        </div>
                        <textarea class="w-full rounded border px-3 py-2 text-lg border shadow-md"
                                  id="form.notes"
                                  v-model="form.notes">
                        </textarea>
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
                        <div class="flex w-full lg:w-1/3 px-2">
                            <div class="w-full"
                                 :style="{color: statusColor}">
                                    {{ status }}
                                <span v-if="allClear"><i class="fas fa-check"></i> </span>
                                <span v-else-if="restrict"><i class="fas fa-exclamation"></i></span>
                                <span v-else><i class="fas fa-times"></i></span>
                            </div>
                        </div>
                        <div class="flex w-full lg:w-1/3 px-2 justify-between flex-wrap">
                            <div class="w-full lg:w-4/5" :style="{color: expirationColor}">
                                {{ expiration }}
                                <span>{{ exam_date | moment("add", "1 year") | moment("from", "now") }}</span>
                            </div>
                            <div v-if="physicalUploaded" class="lg:w-1/5" style="color:#000080">
                                <a :href="url" class="text-xl fas fa-file-download"></a>
                            </div>
                        </div>
                    </div>
                    <div class="flex w-1/12 pt-1 justify-end px-4">
                        <expand-button @toggleRow="toggleRow" class=""></expand-button>
                    </div>
                </div>
                <div v-if="isExpanded" class="p-2">
                    <div class="flex w-11/12 flex-wrap px-4">
                        <div class="w-full lg:w-1/3">
                            <p class="text-gray-500 w-full py-1">Exam Date:
                                <span class="text-gray-800 font-semibold">
                                    {{ exam_date | moment("MM/DD/YYYY") }}
                                </span>
                            </p>

                            <p class="text-gray-500 w-full py-1">Restrictions:
                                <span class="text-gray-800 font-semibold text-orange-500">
                                    {{ restrictions }}
                                </span>
                            </p>

                            <p class="text-gray-500 w-full py-1">Notes:
                                <span class="text-gray-800 font-semibold">{{ notes }}</span>
                            </p>
                        </div>
                        <div class="w-full lg:w-1/3">
                            <div v-if="this.expiration ==='Expired'">
                                <p class="lg:px-1 font-sm font-semibold text-red-700">All Forms Have Expired</p>
                            </div>
                            <div v-else-if="this.status === 'Not Cleared'">
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
                        <div class="w-1/3 p-3">
                            <physical-upload-form
                                :data="data"
                                @formUploaded="resetPage">
                            </physical-upload-form>
                        </div>
                    </div>
                    <div class="flex justify-start cursor-pointer pt-1">
                        <edit-button @clicked="getNames"></edit-button>
                        <delete-button @clicked="destroy"></delete-button>
                    </div>
                </div>

            </div>
        </div>

    </div>
</template>

<script>
    import PhysicalUploadForm from "../forms/PhysicalUploadForm";
    export default {
        name: "Physical",
        components: {PhysicalUploadForm},
        props: ['data'],

        data() {
            return {
                editing: false,
                isExpanded: false,

                statusColor: '',
                expirationColor: '',

                allClear: false,
                restrict: false,
                notClear: false,

                id: this.data.id,
                last_name: this.data.athlete.last_name,
                first_name: this.data.athlete.first_name,
                exam_date: this.data.exam_date,
                restrictions: this.data.restrictions,
                notes: this.data.notes,
                athlete_id: this.data.athlete_id,
                athleteUrl: '/athletes/' + this.data.athlete.slug,
                form_path: this.data.form_path,
                physicalUploaded: this.data.form_path !== null,
                url: location.pathname +'/'+this.data.id,

                athletes: [],

                form: new Form({
                    athlete_id: this.data.athlete_id,
                    exam_date: this.data.exam_date,
                    restrictions: this.data.restrictions,
                    form_path: this.data.form_path,
                    notes: this.data.notes,
                    history_form: this.data.history_form,
                    physical_exam_form: this.data.physical_exam_form,
                    medical_eligibility_form: this.data.medical_eligibility_form,
                    physical_form: this.data.physical_form,
                    blanket_waiver_form: this.data.blanket_waiver_form,
                    ghsa_concussion_form: this.data.ghsa_concussion_form,
                    ghsa_cardiac_form: this.data.ghsa_cardiac_form
                }),

                historyFormConfirmed: this.data.history_form === 1,
                physicalExamFormConfirmed: this.data.physical_exam_form === 1,
                eligibilityFormConfirmed: this.data.medical_eligibility_form === 1,
                physicalFormConfirmed: this.data.physical_form === 1,
                blanketFormConfirmed: this.data.blanket_waiver_form === 1,
                concussionFormConfirmed: this.data.ghsa_concussion_form === 1,
                cardiacFormConfirmed: this.data.ghsa_cardiac_form === 1
            }
        },

        computed: {

            status() {
                let forms =[
                    this.historyFormConfirmed,
                    this.physicalExamFormConfirmed,
                    this.eligibilityFormConfirmed,
                    this.physicalFormConfirmed,
                    this.blanketFormConfirmed,
                    this.concussionFormConfirmed,
                    this.cardiacFormConfirmed
                ];

                if (this.expiration === 'Expired') {

                    this.statusColor = '#cc0000';

                    return "Not Cleared"
                }
                else if  (forms.every(Boolean) && (this.restrictions === null)) {

                    this.statusColor = '#00b300';
                    this.allClear = true;

                    return "Cleared"

                } else if  (forms.every(Boolean) && (this.restrictions !== null)) {

                    this.statusColor = '#fd6a02';
                    this.restrict = true;

                    return "Cleared with Restrictions"


                } else {
                    this.statusColor = '#cc0000';

                    return "Not Cleared"
                }
            },

            expiration() {
                let examination_date = this.$moment(this.exam_date);

                let expiration_date = this.$moment(examination_date).add(1, 'years');

                let today = this.$moment();

                let d = this.$moment(expiration_date).diff(today, 'days');

                if  (expiration_date > today && d >= 60) {

                    this.expirationColor = '#00b300';

                    return "Expires"

                } else if (expiration_date > today && d <= 59) {

                    this.expirationColor = '#fd6a02';

                    return "Expires"

                } else {

                    axios.patch('/api/physicals/' + this.data.id, {
                        history_form: this.history_form = '0',
                        physical_exam_form: this.physical_exam_form = '0',
                        medical_eligibility_form: this.medical_eligibility_form = '0',
                        physical_form: this.physical_form = '0',
                        blanket_waiver_form: this.blanket_waiver_form = '0',
                        ghsa_concussion_form: this.ghsa_concussion_form = '0',
                        ghsa_cardiac_form: this.ghsa_cardiac_form = '0',
                    })
                        .catch(errors => {
                            console.log(errors);
                        });

                    this.expirationColor = '#cc0000';

                    return "Expired"
                }
            }
        },

        methods: {
            toggleRow() {
                this.isExpanded = !this.isExpanded
            },

            resetPage() {
                this.physicalUploaded = true;
            },

            confirmHistoryForm() {
                this.form.history_form = 1
                this.historyFormConfirmed = true
            },

            unconfirmHistoryForm() {
                this.form.history_form = 0
                this.historyFormConfirmed = false
            },

            confirmPhysicalExamForm() {
                this.form.physical_exam_form = 1
                this.physicalExamFormConfirmed = true
            },

            unconfirmPhysicalExamForm() {
                this.form.physical_exam_form = 0
                this.physicalExamFormConfirmed = false
            },

            confirmEligibilityForm() {
                this.form.medical_eligibility_form = 1
                this.eligibilityFormConfirmed = true
            },

            unconfirmEligibilityForm() {
                this.form.medical_eligibility_form = 0
                this.eligibilityFormConfirmed = false
            },

            confirmPhysicalForm() {
                this.form.physical_form = 1
                this.physicalFormConfirmed = true
            },

            unconfirmPhysicalForm() {
                this.form.physical_form = 0
                this.physicalFormConfirmed = false
            },

            confirmBlanketForm() {
                this.form.blanket_waiver_form = 1
                this.blanketFormConfirmed = true
            },

            unconfirmBlanketForm() {
                this.form.blanket_waiver_form = 0
                this.blanketFormConfirmed = false
            },

            confirmConcussionForm() {
                this.form.ghsa_concussion_form = 1
                this.concussionFormConfirmed = true
            },

            unconfirmConcussionForm() {
                this.form.ghsa_concussion_form = 0
                this.concussionFormConfirmed = false
            },

            confirmCardiacForm() {
                this.form.ghsa_cardiac_form = 1
                this.cardiacFormConfirmed = true
            },

            unconfirmCardiacForm() {
                this.form.ghsa_cardiac_form = 0
                this.cardiacFormConfirmed = false
            },

            getNames() {
                this.editing = true;

                axios.get('/api/athletes')
                    .then(response => {
                        this.athletes = response.data;
                    })
                    .catch(errors => {
                        console.log(errors)
                    })
            },

            update() {
                this.form
                    .patch('/api/physicals/' + this.data.id)
                    .then(data => {
                        this.last_name =
                            this.athletes.find(athlete => athlete.id === this.form.athlete_id).last_name;
                        this.first_name =
                            this.athletes.find(athlete => athlete.id === this.form.athlete_id).first_name;
                        this.exam_date = this.form.exam_date;
                        this.restrictions = this.form.restrictions;
                        this.notes = this.form.notes;
                        this.history_form = this.form.history_form,
                        this.physical_exam_form = this.form.physical_exam_form,
                        this.medical_eligibility_form = this.form.medical_eligibility_form,
                        this.physical_form = this.form.physical_form,
                        this.blanket_waiver_form = this.form.blanket_waiver_form,
                        this.ghsa_concussion_form = this.form.ghsa_concussion_form,
                        this.ghsa_cardiac_form = this.form.ghsa_cardiac_form

                        this.editing = false;
                        this.isExpanded = false;

                         if (
                             this.athlete_id !== this.data.athlete_id ||
                             this.exam_date !== this.data.exam_date ||
                             this.restrictions !== this.data.restrictions ||
                             this.notes !== this.data.notes ||
                             this.grad_year !== this.data.grad_year ||
                             this.history_form !== this.data.history_form ||
                             this.physical_exam_form !== this.data.physical_exam_form ||
                             this.medical_eligibility_form !== this.data.medical_eligibility_form ||
                             this.physical_form !== this.data.physical_form ||
                             this.blanket_waiver_form !== this.data.blanket_waiver_form ||
                             this.ghsa_concussion_form !== this.data.ghsa_concussion_form ||
                             this.ghsa_cardiac_form !== this.data.ghsa_cardiac_form
                             ) {
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
                                 title: 'Physical Updated!'
                             });
                         }
                    })
                    .catch(errors => {
                        console.log(errors);
                    });
            },

            destroy() {
                axios.delete('api/physicals/' + this.data.id);

                this.$emit('deleted', this.data.id);
            },

            resetForm() {
                this.form.athlete_id = this.data.athlete_id,
                this.form.exam_date = this.data.exam_date,
                this.form.restrictions = this.data.restrictions,
                this.form.form_path = this.data.form_path,
                this.form.notes = this.data.notes,
                this.form.history_form = this.data.history_form,
                this.form.physical_exam_form = this.data.physical_exam_form,
                this.form.medical_eligibility_form = this.data.medical_eligibility_form,
                this.form.physical_form = this.data.physical_form,
                this.form.blanket_waiver_form = this.data.blanket_waiver_form,
                this.form.ghsa_concussion_form = this.data.ghsa_concussion_form,
                this.form.ghsa_cardiac_form = this.data.ghsa_cardiac_form
            }
        }

    }
</script>

<style scoped>

</style>
