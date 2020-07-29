<template>
    <div class="flex flex-col w-full">
        <div class="flex justify-end w-full">
            <div class="flex md:w-1/2 lg:w-1/3">
                <input type="text"
                       v-model="search"
                       placeholder="Find a sport..."
                       class="flex w-full rounded-md border px-3 py-2 text-lg border shadow"
                />
                <button @click="clearSearch"
                        class="w-20 py-2 ml-2 bg-green-500 text-white text-sm font-bold rounded-md border-2 border-green-400">
                    Clear
                </button>
            </div>
        </div>

        <header class="w-full md:w-1/2 font-thin lg:text-5xl py-4 text-red-900">Sports</header>

        <div class="">
            <div class="flex">
                <div class="flex w-10/12">
                    <div class="">
                        <p class="text-red-900 font-thin">Name</p>
                    </div>
                </div>
                <div class="flex w-2/12 justify-end px-2 items-center">
                    <create-button title="Create New Sport">
                        <new-sport-form @created="add"></new-sport-form>
                    </create-button>
                </div>
            </div>
            <div v-if="records" class="divide-y border-t border-b">
                <div v-for="(sport, index) in filteredAthletes" :key="sport.id">
                    <sport :data="sport" @deleted="remove(index)"></sport>
                </div>
            </div>

            <div v-else class="flex flex-col text-center">
                <p class="text-2xl text-tertiary p-4">No Sports Listed</p>
            </div>
        </div>
    </div>

</template>

<script>
    import Collection from "../Collection";
    import Sport from "./Sport";
    import NewSportForm from "./forms/NewSportForm";

    export default Collection.extend({
        name: "Sports",
        components: {Sport, NewSportForm},

        props: ['data'],

        data() {
            return {
                search: '',

            }
        },

        computed: {
            filteredAthletes() {
                return this.items.filter((sport) => {
                    return (
                        sport.name.toLowerCase().match(this.search.toLowerCase()) ||
                        sport.season.toLowerCase().match(this.search.toLowerCase())
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