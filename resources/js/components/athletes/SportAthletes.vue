<template>
    <div class="flex flex-col w-full">
        <div class="flex justify-end w-full">
            <div class="flex w-full md:w-1/2 lg:w-1/3 mb-8">
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
        <div class="">
            <div class="flex">
                <div class="flex w-11/12 px-2 text-gray-500 font-semibold">
                    <div class="w-full lg:w-1/3">
                        <p class="">Name</p>
                    </div>
                    <div class="hidden lg:flex lg:w-1/3">
                        <p class="px-2">Physical Status</p>
                    </div>
                    <div class="hidden px-2 lg:flex lg:w-1/3">
                        <p class="">Expiration</p>
                    </div>
                </div>
            </div>
            <div v-if="records" class="divide-y border-t border-b">
                <div v-for="(athlete, index) in filteredAthletes" :key="athlete.id">
                    <sport-athlete :data="athlete" @deleted="remove(index)"></sport-athlete>
                </div>
            </div>

            <div v-else class="flex flex-col text-center">
                <p class="text-2xl text-tertiary p-4">No Athletes Listed</p>
            </div>
        </div>
    </div>
</template>

<script>
    import Collection from "../../Collection";
    import SportAthlete from "./SportAthlete";
    export default Collection.extend({
        name: "SportAthletes",
        components: {SportAthlete},
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
