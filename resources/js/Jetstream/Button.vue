<template>
    <button :type="type" class="inline-flex items-center px-4 py-2 bg-purple-700 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-purple-600 focus:outline-none focus:border-purple-900 focus:ring focus:ring-purple-300 disabled:opacity-25 transition duration-150 ease-in">
        <slot></slot>
    </button>
</template>

<script>
    import { defineComponent } from 'vue'

    export default defineComponent({
        props: {
            type: {
                type: String,
                default: 'submit',
            },
        }
    })
</script>
