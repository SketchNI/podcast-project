<template>
    <x-head>
        <title>Admin Dashboard</title>
        <meta property="og:url" :content="$page.props.currentUrl">
        <meta property="og:title" :content="`Admin Dashboard - ${$page.props.appName} Podcast`">
    </x-head>
    <portal to="heading"><h1 class="page-heading">Admin Dashboard</h1></portal>

    <div class="flex flex-col space-y-6">
        <div class="flex items-start space-x-4">
            <div class="stats-board">
                <span><user-icon class="w-24 h-24 text-zinc-500 dark:text-zinc-900"/></span>
                <div>
                    <h1>{{ users }}</h1>
                    <h2>Users</h2>
                </div>
            </div>

            <div class="stats-board">
                <span><music-note-icon class="w-24 h-24 text-zinc-500 dark:text-zinc-900"/></span>
                <div>
                    <h1>{{ episodes }}</h1>
                    <h2>Episodes</h2>
                </div>
            </div>

            <div class="stats-board">
                <span><document-text-icon class="w-24 h-24 text-zinc-500 dark:text-zinc-900"/></span>
                <div>
                    <h1>{{ pages }}</h1>
                    <h2>Pages</h2>
                </div>
            </div>

            <div class="stats-board">
                <span><speakerphone-icon class="w-24 h-24 text-zinc-500 dark:text-zinc-900"/></span>
                <div>
                    <h1>{{ listens }}</h1>
                    <h2>Listens</h2>
                </div>
            </div>
        </div>

        <div class="flex items-start space-x-4">
            <div class="bg-zinc-900 px-3 py-4 rounded-lg w-full">

            </div>
        </div>
    </div>
</template>

<script>
import { ref, defineComponent } from 'vue'
import { UserIcon, MusicNoteIcon, DocumentTextIcon, SpeakerphoneIcon } from '@heroicons/vue/solid'

export default defineComponent({
    name: "Index",

    props: ['users', 'episodes', 'pages', 'listens'],

    setup() {
        return {
            names: ['Users', 'Visitors', 'Misc'],
            values: [
                [1934, 324983, 48],
                [9334, 3983, 485],
                [93442, 33, 148]
            ]
        }
    },

    components: {
        UserIcon,
        MusicNoteIcon,
        DocumentTextIcon,
        SpeakerphoneIcon,
    }
});
</script>

<style scoped>
.stats-board {
    @apply w-1/4 border border-zinc-400 dark:border-zinc-900 bg-zinc-200 dark:bg-zinc-700;
    @apply px-3 py-4 rounded-lg flex items-center;
}

.stats-board h2 {
    @apply font-thin text-4xl dark:text-zinc-500 text-zinc-400;
}

.stats-board h1 {
    @apply font-bold text-6xl dark:text-zinc-200 text-zinc-700;
}
</style>
