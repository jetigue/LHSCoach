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

        <header class="w-full md:w-1/2 font-thin lg:text-5xl py-4 text-red-900">Athletes</header>

        <div class="">
            <div class="flex">
                <div class="flex w-11/12 px-2 text-gray-500 font-semibold">
                    <div class="w-1/3">
                        <p class="">Name</p>
                    </div>
                    <div class="w-1/3">
                        <p class="px-2">Sports</p>
                    </div>
                    <div class="px-2 w-1/3">
                        <p class="">Physical Status</p>
                    </div>
                </div>
                <div class="flex w-1/12 justify-end px-2 items-center">
                    <create-button title="Create New Athlete">
                        <new-athlete-form @created="add"></new-athlete-form>
                    </create-button>
                </div>
            </div>
            <div v-if="records" class="divide-y border-t border-b">
                <div v-for="(athlete, index) in filteredAthletes" :key="athlete.id">
                    <athlete :data="athlete" @deleted="remove(index)"></athlete>
                </div>
            </div>

            <div v-else class="flex flex-col text-center">
                <p class="text-2xl text-tertiary p-4">No Athletes Listed</p>
            </div>
        </div>
    </div>

</template>

<script>
    import Collection from "../Collection";
    import Athlete from "./Athlete";
    import NewAthleteForm from "./forms/NewAthleteForm";

    export default Collection.extend({
        name: "Athletes",
        components: {Athlete, NewAthleteForm},

        props: ['data'],

        data() {
            return {
                search: '',

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
            }
        },

        methods: {
            clearSearch() {
                this.search = ''
            }
        }
    })
</script>

<style scoped>

</style>
