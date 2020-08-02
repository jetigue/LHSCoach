<template>
    <div v-if="shouldPaginate" class="flex my-4 w-full flex-wrap justify-between items-center">
        <ul class="flex w-auto font-sans text-sm w-full md:w-1/3">
            <li v-show="prevUrl">
                <a class="block text-white bg-red-900 px-3 py-1 rounded-l-lg"
                   rel="prev"
                   href="#" @click.prevent="page--">
                        <i class="fas fa-backward"></i> Previous
                </a>
            </li>

            <li v-show="nextUrl">
                <a class="block text-white bg-red-900 px-3 py-1 rounded-r-lg"
                   rel="next"
                   href="#" @click.prevent="page++">
                        Next <i class="fas fa-forward"></i>
                </a>
            </li>

        </ul>
        <div class="flex w-full md:w-1/2 md:justify-end py-1">
            <p>Showing <span class="text-red-900 font-semibold">{{ firstItem }}</span> to
            <span class="text-red-900 font-semibold">{{ lastItem }}</span> out of
            <span class="text-red-900 font-semibold">{{ total }}</span>
            </p>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Paginator",

        props: ['dataSet'],

        data() {
            return {
                page: 1,
                prevUrl: false,
                nextUrl: false,

                firstItem: 1,
                lastItem: false,
                total: this.records,
            }
        },

        watch: {
            dataSet() {
                this.page = this.dataSet.current_page;
                this.prevUrl = this.dataSet.prev_page_url;
                this.nextUrl = this.dataSet.next_page_url;

                this.firstItem = this.dataSet.from;
                this.lastItem = this.dataSet.to;
                this.total = this.dataSet.total;

            },

            page() {
                this.broadcast().updateUrl();
            }
        },

        computed: {
            shouldPaginate() {
                return !! this.prevUrl || !! this.nextUrl;
            }
        },

        methods: {
            broadcast() {
                return this.$emit('changed', this.page);
            },

            updateUrl() {
                history.pushState(null, null, '?page=' + this.page);
            }
        }
    }
</script>

<style scoped>

</style>
