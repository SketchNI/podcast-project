<template>
    <textarea class="input" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input" />
</template>

<script>
    import { defineComponent } from 'vue'

    export default defineComponent({
        props: ['modelValue'],

        emits: ['update:modelValue'],

        methods: {
            focus() {
                this.$refs.input.focus()
            }
        }
    })
</script>

<style scoped>
.input {
    @apply border-gray-300 dark:border-zinc-700 dark:bg-zinc-700 focus:border-transparent;
    @apply focus:ring focus:ring-purple-300 focus:ring-opacity-75 dark:text-zinc-200;
    @apply rounded-md shadow-sm dark:placeholder-zinc-400;
}
</style>
