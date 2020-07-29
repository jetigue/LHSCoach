<template>
    <div class="px-1 text-red-900" @click="editRecord">
<!--        <span>Edit</span>-->
        <i class="fas fa-edit"></i>
    </div>
</template>

<script>
    export default {
        name: "EditButton",

        data() {
            return {}
        },

        methods: {
            editRecord() {
                this.$emit('clicked');
            }
        }
    }
</script>