<template>
    <x-head>
        <title>{{ page.title }}</title>
        <meta property="og:url" :content="$page.props.currentUrl">
        <meta property="og:title" :content="`${page.title} - ${$page.props.appName} Podcast`">
    </x-head>

    <portal to="heading"><h1 class="page-heading">{{ page.title }}</h1></portal>

    <div class="flex flex-col space-y-6">
        <article class="prose prose-yellow prose-lg" v-html="page.body" />
    </div>
</template>

<script>
import { defineComponent } from 'vue'
import Welcome from '@/Jetstream/Welcome.vue'

export default defineComponent({
    components: {
        Welcome,
    },

    props: ['page'],

    methods: {
        sendToPlayer(episode) {
            window.mitt.emit('play:episode', episode);
        }
    },

    setup() {
        return {
            medias: [
                {
                    uuid: '1',
                    slug: 'civil-war-guns-n-roses',
                    status: 'Published',
                    url: '/storage/files/01. Civil War.mp3',
                    title: `Civil War - Guns N' Roses`,
                    description: `Civil War is the first track off Guns N' Roses 4th studio album Use Your Illusion II
                which released in 1991.`,
                },
                {
                    uuid: '2',
                    slug: 'hotel-california-the-eagles',
                    status: 'Published',
                    url: '/storage/files/Hotel California.mp3',
                    title: `Hotel California - The Eagles`,
                    description: `Hotel California is a song by The Eagles`,
                }
            ]
        }
    }
})
</script>
