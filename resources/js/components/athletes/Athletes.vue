<template>
    <div class="flex flex-col w-full">
        <div class="flex justify-end w-full">
            <div class="flex md:w-1/2 lg:w-1/3">
                <input type="text"
                       v-model="search"
                       placeholder="Find an athlete..."
                       class="flex w-full rounded-md border px-3 py-2 text-lg border shadow"
                />
                <button @click="clearSearch"
                        class="w-20 py-2 ml-2 bg-green-500 text-white text-sm font-bold rounded-md border-2 border-green-400">
                    Clear
                </button>
            </div>
        </div>

        <header class="w-full md:w-1/2 font-thin text-2xl lg:text-5xl py-4 text-red-900">Athletes</header>

        <div class="w-full">
            <div class="flex">
                <div class="flex w-11/12 px-2 text-gray-500 font-semibold">
                    <div class="w-full lg:w-3/12">
                        <div @click="sort('last_name')" class="cursor-pointer">Name
                            <span v-if="this.currentSort==='last_name' && this.currentSortDir==='desc'"><i class="fas fa-sort-down"></i></span>
                            <span v-else-if="this.currentSort==='last_name' && this.currentSortDir==='asc'"><i class="fas fa-sort-up"></i></span>
                            <span v-else><i class="fas fa-sort"></i></span>
                        </div>
                    </div>
                    <div class="hidden lg:flex lg:w-2/12">
                        <div @click="sort('sex')" class="cursor-pointer">Sex
                            <span v-if="this.currentSort==='sex' && this.currentSortDir==='desc'"><i class="fas fa-sort-down"></i></span>
                            <span v-else-if="this.currentSort==='sex' && this.currentSortDir==='asc'"><i class="fas fa-sort-up"></i></span>
                            <span v-else><i class="fas fa-sort"></i></span>
                        </div>
                    </div>
                    <div class="hidden lg:flex lg:w-2/12">
                        <div @click="sort('grade')" class="cursor-pointer">Grade
                            <span v-if="this.currentSort==='grade' && this.currentSortDir==='desc'"><i class="fas fa-sort-down"></i></span>
                            <span v-else-if="this.currentSort==='grade' && this.currentSortDir==='asc'"><i class="fas fa-sort-up"></i></span>
                            <span v-else><i class="fas fa-sort"></i></span>
                        </div>
                    </div>
                    <div class="hidden lg:flex lg:w-5/12 px-2">
                        <div @click="sort('fall_sport_id')" class="cursor-pointer w-1/3">Fall Sport
                            <span v-if="this.currentSort==='fall_sport_id' && this.currentSortDir==='desc'"><i class="fas fa-sort-down"></i></span>
                            <span v-else-if="this.currentSort==='fall_sport_id' && this.currentSortDir==='asc'"><i class="fas fa-sort-up"></i></span>
                            <span v-else><i class="fas fa-sort"></i></span>
                        </div>
                        <div @click="sort('winter_sport_id')" class="cursor-pointer w-1/3">Winter Sport
                            <span v-if="this.currentSort==='winter_sport_id' && this.currentSortDir==='desc'"><i class="fas fa-sort-down"></i></span>
                            <span v-else-if="this.currentSort==='winter_sport_id' && this.currentSortDir==='asc'"><i class="fas fa-sort-up"></i></span>
                            <span v-else><i class="fas fa-sort"></i></span>
                        </div>
                        <div @click="sort('spring_sport_id')" class="cursor-pointer w-1/3">Spring Sport
                            <span v-if="this.currentSort==='spring_sport_id' && this.currentSortDir==='desc'"><i class="fas fa-sort-down"></i></span>
                            <span v-else-if="this.currentSort==='spring_sport_id' && this.currentSortDir==='asc'"><i class="fas fa-sort-up"></i></span>
                            <span v-else><i class="fas fa-sort"></i></span>
                        </div>

                    </div>
                </div>
                <div class="flex w-1/12 justify-end px-2 items-center">
                    <create-button title="Create New Athlete">
                        <new-athlete-form @created="add"></new-athlete-form>
                    </create-button>
                </div>
            </div>
            <div v-if="records" class="divide-y border-t border-b">
                <div v-for="(athlete, index) in sortedAthletes" :key="athlete.id">
                    <athlete :data="athlete" @deleted="remove(index)"></athlete>
                </div>
            </div>

            <div v-else class="flex flex-col text-center">
                <p class="text-2xl text-tertiary p-4">No Athletes Listed</p>
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
    import Athlete from "./Athlete";
    import NewAthleteForm from "../forms/NewAthleteForm";

    export default Collection.extend({
        name: "Athletes",
        components: {Athlete, NewAthleteForm},
        mixins: [paginationMixin],

        props: ['data'],

        data() {
            return {
                search: '',
                currentSort: 'last_name',
                currentSortDir: 'asc',
            }
        },

        computed: {
            filteredAthletes() {
                return this.items.filter((athlete) => {
                    return (
                        athlete.last_name.toLowerCase().match(this.search.toLowerCase()) ||
                        athlete.first_name.toLowerCase().match(this.search.toLowerCase())
                    )
                });
            },

            sortedAthletes: function() {
                return this.filteredAthletes.sort((a, b) => {
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
