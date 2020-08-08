<template>
    <div class="flex flex-col w-full">
        <div class="flex justify-end w-full">
            <div class="flex md:w-1/2 lg:w-1/3">
                <input type="text"
                       v-model="search"
                       placeholder="Find a physical..."
                       class="flex w-full rounded-md border px-3 py-2 text-lg border shadow"
                />
                <button @click="clearSearch"
                        class="w-20 py-2 ml-2 bg-green-500 text-white text-sm font-bold rounded-md border-2 border-green-400">
                    Clear
                </button>
            </div>
        </div>

        <header class="w-full md:w-1/2 font-thin text-2xl lg:text-5xl py-4 text-red-900">Physicals</header>

        <div class="">
            <div class="flex">
                <div class="flex w-11/12 px-2 text-gray-500 font-semibold">
                    <div class="w-full lg:w-1/3">
                        <div @click="sort('athlete_name')" class="cursor-pointer">
                            Name
                            <span v-if="this.currentSort==='athlete_name' && this.currentSortDir==='desc'"><i class="fas fa-sort-down"></i></span>
                            <span v-else-if="this.currentSort==='athlete_name' && this.currentSortDir==='asc'"><i class="fas fa-sort-up"></i></span>
                            <span v-else><i class="fas fa-sort"></i></span>
                        </div>

                    </div>
                    <div class="hidden lg:flex px-2 lg:w-1/3">
                        <div @click="sort('physical_status')"class="cursor-pointer">Physical Status
                            <span v-if="this.currentSort==='physical_status' && this.currentSortDir==='desc'"><i class="fas fa-sort-down"></i></span>
                            <span v-else-if="this.currentSort==='physical_status' && this.currentSortDir==='asc'"><i class="fas fa-sort-up"></i></span>
                            <span v-else><i class="fas fa-sort"></i></span>
                        </div>
                    </div>
                    <div class="hidden lg:flex lg:w-1/3">
                        <div @click="sort('exam_date')" class="px-2 cursor-pointer">
                            Expiration Status
                            <span v-if="this.currentSort==='exam_date' && this.currentSortDir==='desc'"><i class="fas fa-sort-down"></i></span>
                            <span v-else-if="this.currentSort==='exam_date' && this.currentSortDir==='asc'"><i class="fas fa-sort-up"></i></span>
                            <span v-else><i class="fas fa-sort"></i></span>
                        </div>
                    </div>
                </div>
                <div class="flex w-1/12 justify-end px-2 items-center">
                    <create-button title="Add New Physical">
                        <new-physical-form @created="add"></new-physical-form>
                    </create-button>
                </div>
            </div>
            <div v-if="records" class="divide-y border-t border-b">
                <div v-for="(physical, index) in sortedPhysicals" :key="physical.id">
                    <physical :data="physical" @deleted="remove(index)"></physical>
                </div>
            </div>

            <div v-else class="flex flex-col text-center">
                <p class="text-2xl text-tertiary p-4">No Physicals Listed</p>
            </div>
        </div>
        <div v-if="records">
            <paginator :dataSet="dataSet" @changed="fetch">Athletes</paginator>
        </div>
    </div>

</template>

<script>
    import {paginationMixin} from "../../mixins/paginationMixin";
    import Collection from "../../Collection";
    import Physical from "./Physical";
    import NewPhysicalForm from "../forms/NewPhysicalForm";

    export default Collection.extend({
        name: "Physicals",
        components: {Physical, NewPhysicalForm},
        mixins: [paginationMixin],

        props: ['data'],

        data() {
            return {
                search: '',
                currentSort: 'athlete_name',
                currentSortDir: 'asc',
            }
        },

        computed: {
            filteredPhysicals() {
                return this.items.filter((physical) => {
                    return (
                        physical.exam_date.toLowerCase().match(this.search.toLowerCase()) ||
                        physical.athlete.last_name.toLowerCase().match(this.search.toLowerCase()) ||
                        physical.athlete.first_name.toLowerCase().match(this.search.toLowerCase())
                    )
                });
            },

            sortedPhysicals: function() {
                return this.filteredPhysicals.sort((a, b) => {
                    let modifier = 1;
                    if (this.currentSortDir === 'desc') modifier = -1;
                    if (a[this.currentSort] < b[this.currentSort]) return -1 * modifier;
                    if (a[this.currentSort] > b[this.currentSort]) return modifier;
                    return 0;
                });
            },
        },

        methods: {
            clearSearch() {
                this.search = ''
            },

            sort:function(s) {
                if (s === this.currentSort) {
                    this.currentSortDir = this.currentSortDir === 'asc'?'desc':'asc';
                }
                this.currentSort = s;
            }
        }
    })
</script>

<style scoped>

</style>
