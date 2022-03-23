<template>
    <button :type="type" class="inline-flex items-center px-4 py-2 bg-white dark:bg-zinc-500 border border-zinc-300 dark:border-zinc-900 rounded-md font-semibold text-xs text-zinc-700 dark:text-zinc-100 uppercase tracking-widest shadow-sm dark:hover:bg-zinc-700 hover:text-zinc-500 dark:hover:text-zinc-300 focus:outline-none focus:border-purple-500 focus:ring focus:ring-purple-300 disabled:opacity-25 transition duration-100 ease-in">
        <slot></slot>
    </button>
</template>

<script>
    import { defineComponent } from 'vue'

    export default defineComponent({
        props: {
            type: {
                type: String,
                default: 'button',
            },
        }
    })
</script>
