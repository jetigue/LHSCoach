<template>
    <div class="flex flex-col w-full">

        <header class="w-full md:w-1/2 font-thin lg:text-5xl py-4 text-red-900"><slot></slot></header>

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
                <div v-for="(sport, index) in items" :key="sport.id">
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

            }
        },

        computed: {

        },

        methods: {
        }
    })
</script>

<style scoped>

</style>
