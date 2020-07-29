<template>
    <div class="text-gray-800 px-1 cursor-pointer" @click="deleteRecord">
<!--        <span>Delete</span>-->
        <i class="fas fa-trash"></i>
    </div>
</template>

<script>
    export default {
        name: "DeleteButton",

        data() {
            return {}
        },

        methods: {
            deleteRecord() {
                Vue.swal.fire({
                    icon: 'warning',
                    title: 'Delete record?',
                    text: 'This cannot be undone.',
                    confirmButtonText: 'Yes, Delete record.',
                    confirmButtonColor: 'green',
                    showCancelButton: 'true'
                }).then((result) => {
                    if (result.value) {
                        this.$emit('clicked')
                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>