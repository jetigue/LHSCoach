<template>
    <div class="">
        <div v-if="editing" class="p-3">
            <div class="w-full mx-auto">
                <form action="api/fall/sports/id" method="POST" id="editFallSport" @submit.prevent="update"
                      @keydown="form.errors.clear()"
                      class="bg-gray-100 shadow-md rounded px-8 pt-6 pb-8 mb-4">

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
                        <div class="flex">
                            <a :href="url" class="hover:font-semibold hover:underline">
                                {{ name }}
                            </a>
                        </div>
                    </div>
                    <div class="flex w-1/12 pt-1 justify-end px-4">
                        <expand-button @toggleRow="toggleRow" class=""></expand-button>
                    </div>
                </div>
                <div v-if="isExpanded" class="p-2">
                    <div class="flex justify-start cursor-pointer">
                        <edit-button @clicked="editing=true"></edit-button>
                        <delete-button @clicked="destroy"></delete-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "FallSport",

        props: ['data'],

        data() {
            return {
                editing: false,
                isExpanded: false,

                name: this.data.name,
                url: '/fall/sports/' + this.data.slug,

                form: new Form({
                    name: this.data.name,
                }),
            }
        },

        computed: {
        },

        methods: {
            toggleRow() {
                this.isExpanded = !this.isExpanded
            },

            update() {
                this.form
                    .patch('/api/fall/sports/' + this.data.id)
                    .then(data => {
                        this.name = this.form.name;

                        this.editing = false;
                        this.isExpanded = false;

                         if (
                             this.name !== this.data.name
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
                                 title: 'Fall Sport Updated!'
                             });
                         }
                    })
                    .catch(errors => {
                        console.log(errors);
                    });
            },

            destroy() {
                axios.delete('api/fall/sports/' + this.data.id);

                this.$emit('deleted', this.data.id);
            },

            resetForm() {
                this.form.name = this.name
                this.isExpanded = false;
            },
        },
    }
</script>

<style scoped>

</style>
