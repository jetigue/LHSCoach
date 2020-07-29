<template>
    <div class="flex">
        <button type="button"
                class="text-red-900"
                @click="loadSelects"
                @mouseover="showTooltip = true"
                @mouseleave="showTooltip = false"
        >
            <span class="hidden lg:inline-flex"></span>
            <i class="fas fa-plus text-lg pt-1 pl-1 pr-2"></i>
        </button>
        <div v-show="showTooltip" class="flex">
            <create-button-tooltip>
                {{ title }}
            </create-button-tooltip>
        </div>
        <portal to="create-modal">
            <div v-show="active" class="flex w-full fixed inset-0 overflow-auto z-50 bg-gray-700 bg-opacity-75">
                <div class="relative bg-white w-full md:w-2/3 lg:w-1/3 h-full md:h-auto m-auto md:rounded flex flex-col p-4">
                    <header class="border-b-2 border-red-900 flex justify-between items-center">
                        <div>
                            <p class="font-thin text-2xl text-black">
                                {{ title }}
                            </p>
                        </div>
                        <button type="button" aria-label="close" @click="close">
                            <i class="fas fa-times text-xl text-gray-700"></i>
                        </button>
                    </header>
                    <section class="my-3 p-4 bg-gray-200 rounded-lg">
                        <slot></slot>
                    </section>
                    <footer class="border-t-2 border-red-900 flex justify-end">
                        <button type="button" class="py-2 text-gray-800 text-sm" @click="close">
                            Cancel
                        </button>
                    </footer>
                </div>
            </div>
        </portal>
    </div>
</template>

<script>
    import CreateButtonTooltip from "../toolTips/CreateButtonTooltip";
    export default {
        name: "CreateButton",
        components: {CreateButtonTooltip},
        props: ['title'],

        data() {
            return {
                active: false,
                showTooltip: false

            }
        },

        methods: {
            close() {
                Event.$emit('cancel')
                    this.active = false
            },

            loadSelects() {
                this.active = true
                Event.$emit('getNames');
            },
        },

        created() {
            Event.$on('formSubmitted', () => this.close());
        }
    }
</script>

<style scoped>

</style>