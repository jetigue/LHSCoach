<template>
    <div class="">
        <div class="flex py-1 items-center hover:bg-gray-100">
            <div class="flex flex-col w-full">
                <div class="flex w-full">
                    <div class="flex pt-1 w-11/12 px-2 flex-wrap">
                        <div class="w-full lg:flex lg:w-1/3">
                            {{ exam_date | moment("MM/DD/YYYY") }}
                        </div>
                        <div class="w-full lg:flex lg:w-1/3 px-2">
                            <div class="w-full"
                                 :style="{color: statusColor}">
                                    {{ status }}
                                <span v-if="allClear"><i class="fas fa-check"></i> </span>
                                <span v-else-if="restrict"><i class="fas fa-exclamation"></i></span>
                                <span v-else><i class="fas fa-times"></i></span>
                            </div>
                        </div>
                        <div class="w-full lg:flex lg:w-1/3 px-2">
                            <div class="w-full" :style="{color: expirationColor}">
                                {{ expiration }}
                                <span>{{ exam_date | moment("add", "1 year") | moment("from", "now") }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex w-1/12 pt-1 justify-end px-4">
                        <expand-button @toggleRow="toggleRow" class=""></expand-button>
                    </div>
                </div>
                <div v-if="isExpanded" class="p-2">
                    <div class="flex w-11/12 flex-wrap lg:px-2">
                        <div class="w-full lg:flex-col lg:w-1/3">
                            <p class="text-gray-500 w-full py-1">Restrictions:
                                <span class="text-gray-800 font-semibold text-orange-500">
                                    {{ restrictions }}
                                </span>
                            </p>
                            <p class="text-gray-500 w-full py-1">Notes:
                                <span class="text-gray-800 font-semibold">{{ notes }}</span>
                            </p>
                        </div>

                        <div class="w-full lg:flex lg:w-1/3 lg:px-2">
                            <div v-if="this.expiration ==='Expired'">
                                <p class="text-sm font-semibold text-red-700">All Forms Have Expired</p>
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
                        <div class="w-full lg:flex lg:w-1/3"></div>

                    </div>
                </div>

            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: "ProfilePhysical",
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
                exam_date: this.data.exam_date,
                restrictions: this.data.restrictions,
                notes: this.data.notes,
                athlete_id: this.data.athlete_id,

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

                if  (forms.every(Boolean) && (this.restrictions === null)) {

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

                    this.expirationColor = '#cc0000';

                    return "Expired"
                }
            }
        },

        methods: {
            toggleRow() {
                this.isExpanded = !this.isExpanded
            },
        }

    }
</script>

<style scoped>

</style>
