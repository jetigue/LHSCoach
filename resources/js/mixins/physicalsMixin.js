export const physicalsMixin= {

    data() {
        return {
            statusColor: '',
            expirationColor: '',

            allClear: false,
            restrict: false,
            notClear: false,
        }
    },

    computed: {
        physicalStatus() {
            if (this.data.latest_physical) {

                let forms = [
                    this.confirmedCardiacForm = this.data.latest_physical.ghsa_cardiac_form === 1,
                    this.confirmedConcussionForm = this.data.latest_physical.ghsa_concussion_form === 1,
                    this.confirmedHistoryForm = this.data.latest_physical.history_form === 1,
                    this.confirmedMedicalEligibilityForm = this.data.latest_physical.medical_eligibility_form === 1,
                    this.confirmedPhysicalExamForm = this.data.latest_physical.physical_exam_form === 1,
                    this.confirmedPhysicalForm = this.data.latest_physical.physical_form === 1,
                    this.confirmedBlanketWaiverForm = this.data.latest_physical.blanket_waiver_form === 1,
                ];
                if (this.expiration === "Expired") {

                    this.statusColor = '#cc0000';

                    return "Not Cleared";

                } else if (forms.every(Boolean) && (this.data.latest_physical.restrictions === null)) {

                    this.statusColor = '#00b300';
                    this.allClear = true;

                    return "Cleared"

                } else if (forms.every(Boolean) && (this.data.latest_physical.restrictions !== null)) {

                    this.statusColor = '#fd6a02';
                    this.restrict = true;

                    return "Cleared with Restrictions";

                } else {
                    this.statusColor = '#cc0000';

                    return "Not Cleared";
                }

            } else {
                this.statusColor = '#cc0000';

                return "Not Cleared";
            }
        },

        expiration() {
            if (this.data.latest_physical) {
                let examination_date = this.$moment(this.data.latest_physical.exam_date);

                let expiration_date = this.$moment(examination_date).add(1, 'years');

                let today = this.$moment();

                let d = this.$moment(expiration_date).diff(today, 'days');

                if (expiration_date > today && d >= 60) {

                    this.expirationColor = '#00b300';

                    return "Expires";

                } else if (expiration_date > today && d <= 59) {

                    this.expirationColor = '#fd6a02';

                    return "Expires";

                } else {

                    this.expirationColor = '#cc0000';

                    return "Expired";
                }

            } else {
                this.statusColor = '#cc0000';

                return "NA";
            }
        }

    }
}
