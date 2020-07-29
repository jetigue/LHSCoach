<template>
    <div class="absolute inline z-10 -mt-12" style="margin-left: -4.5rem">
        <div class="bg-black shadow-xl text-white text-xs rounded p-2">
            <slot></slot>
        </div>
        <svg class="absolute text-black h-2 w-full left-0 top-full"
             x="0px"
             y="0px"
             viewBox="0 0 255 255"
             xml:space="preserve">
            <polygon class="fill-current" points="0,0 127.5,127.5 255,0"/>
        </svg>
    </div>
</template>

<script>
    export default {
        name: "CreateButtonTooltip"
    }
</script>



