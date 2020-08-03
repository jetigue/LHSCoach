<template>
    <form action="/physicals" method="POST" id="newPhysical" enctype="multipart/form-data"
        @submit.prevent="onSubmit"
        @keydown="form.errors.clear()">

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
                      v-model="form.notes"
                      placeholder="Any medical conditions, concerns, etc.">
            </textarea>
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
    data() {
        return {
            form: new Form({
                athlete_id: '',
                exam_date: '',
                restrictions: '',
                form_path: '',
                notes: '',
                history_form: 0,
                physical_exam_form: 0,
                medical_eligibility_form: 0,
                physical_form: 0,
                blanket_waiver_form: 0,
                ghsa_concussion_form: 0,
                ghsa_cardiac_form: 0
            }),

            historyFormConfirmed: false,
            physicalExamFormConfirmed: false,
            eligibilityFormConfirmed: false,
            physicalFormConfirmed: false,
            blanketFormConfirmed: false,
            concussionFormConfirmed: false,
            cardiacFormConfirmed: false,

            athletes: []
        };
    },

    methods: {
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

        onSubmit() {
            this.form
                .post('/api/physicals')

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
                             title: 'Physical Successfully Added!'
                         });

                    this.$emit('created', data);
                    this.resetForm()
                })

                .catch(errors => console.log(errors));
        },

        resetForm() {
            this.form.athlete_id = '';
            this.form.restrictions = '';
            this.form.notes = '';
            this.form.exam_date = '';
            this.form.history_form = 0;
            this.form.physical_exam_form = 0;
            this.form.medical_eligibility_form = 0;
            this.form.physical_form = 0;
            this.form.blanket_waiver_form = 0;
            this.form.ghsa_concussion_form = 0;
            this.form.ghsa_cardiac_form = 0;

            this.historyFormConfirmed = false;
            this.physicalFormConfirmed = false;
            this.eligibilityFormConfirmed = false;
            this.physicalFormConfirmed = false;
            this.blanketFormConfirmed = false;
            this.concussionFormConfirmed = false;
            this.cardiacFormConfirmed = false;
            this.form.errors.clear();
        }
    },

    created() {
        Event.$on('cancel', () => this.resetForm());

        Event.$on('getNames', () =>

            axios.get('api/athletes-physicals')
                .then(response => {
                    this.athletes = response.data;
                })
                .catch(errors => {
                    console.log(errors)
                })
        );
    }
}
</script>
