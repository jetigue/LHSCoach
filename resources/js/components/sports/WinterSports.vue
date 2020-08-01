<template>
    <div class="flex flex-col w-full">
        <header class="w-full lg:text-2xl py-4 text-gray-900 text-center">Winter Sports</header>

        <div class="">
            <div class="flex">
                <div class="flex w-10/12 px-2 text-gray-500 font-semibold">
                    <div class="w-1/3">
                        <p class="">Name</p>
                    </div>
                </div>
                <div class="flex w-2/12 justify-end px-2 items-center">
                    <button type="button" @click="active=true" class="flex">
                        <i class="fas fa-plus text-red-900 pt-1 px-2"></i>
                    </button>
                    <div v-show="active" class="flex w-full fixed inset-0 overflow-auto z-50 bg-gray-700 bg-opacity-75">
                        <div class="relative bg-white w-full md:w-2/3 lg:w-1/3 h-full md:h-auto m-auto md:rounded flex flex-col p-4">
                            <header class="border-b-2 border-red-900 flex justify-between items-center">
                                <div>
                                    <p class="font-thin text-2xl text-black">
                                        Create New Winter Sport
                                    </p>
                                </div>
                                <button type="button" aria-label="close" @click="close">
                                    <i class="fas fa-times text-xl text-gray-700"></i>
                                </button>
                            </header>
                            <section class="my-3 p-4 bg-gray-200 rounded-lg">
                                <new-winter-sport @created="add"></new-winter-sport>
                            </section>
                            <footer class="border-t-2 border-red-900 flex justify-end">
                                <button type="button" class="py-2 text-gray-800 text-sm" @click="close">
                                    Cancel
                                </button>
                            </footer>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="records" class="divide-y border-t border-b">
                <div v-for="(winterSport, index) in items" :key="winterSport.id">
                    <winter-sport :data="winterSport" @deleted="remove(index)"></winter-sport>
                </div>
            </div>

            <div v-else class="flex flex-col text-center">
                <p class="text-2xl text-tertiary p-4">No Sports Listed</p>
            </div>
        </div>
    </div>

</template>

<script>
    import Collection from "../../Collection";
    import WinterSport from "./WinterSport";
    import NewWinterSport from "../forms/NewWinterSport";

    export default Collection.extend({
        name: "WinterSports",
        components: {WinterSport, NewWinterSport},

        props: ['data'],

        data() {
            return {
                active: false,
            };
        },

        created() {
            Event.$on('formSubmitted', () => this.close());
        },

        methods: {
            close() {
                Event.$emit('cancel')
                this.active = false
            },
        }
    })
</script>

