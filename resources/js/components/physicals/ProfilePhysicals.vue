<template>
    <div class="flex flex-col w-full">

        <header class="w-full md:w-1/2 font-thin text-xl lg:text-3xl py-2 text-red-900">Physicals</header>
        <div class="">
            <div class="flex">
                <div class="flex w-11/12 px-2 text-gray-500 font-semibold">
                    <div class="w-full lg:w-1/3">
                        <p class="">Exam Date</p>
                    </div>
                    <div class="hidden lg:flex lg:px-2 lg:w-1/3">
                        <p class="">Physical Status</p>
                    </div>
                    <div class="hidden lg:flex lg:w-1/3">
                        <p class="px-2">Expiration Status</p>
                    </div>
                </div>
                <div class="flex w-1/12 justify-end px-2 items-center">
                </div>
            </div>
            <div v-if="records" class="divide-y border-t border-b">
                <div v-for="(physical, index) in items" :key="physical.id">
                    <profile-physical :data="physical" @deleted="remove(index)"></profile-physical>
                </div>
            </div>

            <div v-else class="flex flex-col text-center">
                <p class="text-2xl text-tertiary p-4">No Physicals Listed</p>
            </div>
        </div>
    </div>
</template>

<script>
    import ProfilePhysical from "./ProfilePhysical";

    export default {
        name: "ProfilePhysicals",
        components: {ProfilePhysical},
        props: ['data'],

        data() {
            return {
                recordsCount: this.data.length,
                items: this.data
            };
        },

        computed: {
            records: {
                get: function () {
                    return this.recordsCount
                },
                set: function () {
                    if (this.recordsCount !== 0) {
                        return this.records = true;
                    }
                    return this.records = false;
                }
            }
        },
    }
</script>

<style scoped>

</style>
