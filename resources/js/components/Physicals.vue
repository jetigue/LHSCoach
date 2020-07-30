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

        <header class="w-full md:w-1/2 font-thin lg:text-5xl py-4 text-red-900">Physicals</header>

        <div class="">
            <div class="flex">
                <div class="flex w-11/12 px-2 text-gray-500 font-semibold">
                    <div class="w-1/3">
                        <p class="">Name</p>
                    </div>
                    <div class="w-1/3">
                        <p class="px-2">Expiration Status</p>
                    </div>
                    <div class="px-2 w-1/3">
                        <p class="">Physical Status</p>
                    </div>
                </div>
                <div class="flex w-1/12 justify-end px-2 items-center">
                    <create-button title="Add New Physical">
                        <new-physical-form @created="add"></new-physical-form>
                    </create-button>
                </div>
            </div>
            <div v-if="records" class="divide-y border-t border-b">
                <div v-for="(physical, index) in filteredPhysicals" :key="physical.id">
                    <physical :data="physical" @deleted="remove(index)"></physical>
                </div>
            </div>

            <div v-else class="flex flex-col text-center">
                <p class="text-2xl text-tertiary p-4">No Physicals Listed</p>
            </div>
        </div>
    </div>

</template>

<script>
    import Collection from "../Collection";
    import Physical from "./Physical";
    import NewPhysicalForm from "./forms/NewPhysicalForm";

    export default Collection.extend({
        name: "Physicals",
        components: {Physical, NewPhysicalForm},

        props: ['data'],

        data() {
            return {
                search: '',

            }
        },

        computed: {
            filteredPhysicals() {
                return this.items.filter((physical) => {
                    return (
                        physical.exam_date.toLowerCase().match(this.search.toLowerCase())
                        // athlete.first_name.toLowerCase().match(this.search.toLowerCase())
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
