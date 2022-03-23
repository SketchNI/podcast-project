<template>
    <x-head>
        <title>Episodes</title>
        <meta property="og:url" :content="$page.props.currentUrl">
        <meta property="og:title" :content="`Episodes - ${$page.props.appName} Podcast`">
    </x-head>
    <portal to="heading">
        <h1 class="page-heading">Episodes</h1>
    </portal>

    <div class="flex flex-col space-y-6">
        <div class="relative block w-full border-2 border-zinc-300 dark:border-zinc-600 border-dashed rounded-lg p-12 text-center hover:border-zinc-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            <MicrophoneIcon class="mx-auto w-24 h-24 text-zinc-600 dark:text-zinc-400" />
            <span class="mt-2 block font-medium text-zinc-900 dark:text-zinc-100"> There are no podcasts yet. 😭</span>
        </div>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
import { MicrophoneIcon } from '@heroicons/vue/outline'

export default defineComponent({
    name: "Episodes",

    props: ['episodes'],

    components: {
        MicrophoneIcon
    }
});
</script>

<style scoped>

</style>
