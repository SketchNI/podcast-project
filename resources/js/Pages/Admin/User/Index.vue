<template>
    <x-head>
        <title>User Manager / Admin Dashboard</title>
        <meta property="og:url" :content="$page.props.currentUrl">
        <meta property="og:title" :content="`User Manager / Admin Dashboard - ${$page.props.appName} Podcast`">
    </x-head>
    <portal to="heading"><h1 class="page-heading">User Manager / Admin Dashboard</h1></portal>

    <div class="w-full flex flex-col space-y-6">
        <x-table :headers="['ID', 'Name', 'Email', 'Edit#sr-only']" :paginator="users">
            <template #content>
                <tr v-for="user in users.data" :key="user.email">
                    <td>{{ user.id }}</td>
                    <td>
                        {{ user.name }}
                        <p class="lg:hidden">{{ user.email }}</p>
                    </td>
                    <td class="hidden lg:table-cell">{{ user.email }}</td>
                    <td>
                        <x-link :href="route('admin.users.edit', { user: user })">
                            Edit <span class="sr-only">, {{ user.name }}</span>
                        </x-link>
                    </td>
                </tr>
            </template>
        </x-table>
    </div>
</template>

<script>
import { ref, defineComponent } from 'vue'
import { UserIcon, MusicNoteIcon, DocumentTextIcon, SpeakerphoneIcon } from '@heroicons/vue/solid'
import XTable from '@/Components/Table';
import XButton from '@/Jetstream/Button';

export default defineComponent({
    name: "Index",

    props: ['users'],

    components: {
        XTable,
        XButton,
        UserIcon,
        MusicNoteIcon,
        DocumentTextIcon,
        SpeakerphoneIcon,
    }
});
</script>

<style scoped>
td {
    @apply whitespace-nowrap py-2 pl-2 pr-1 text-base flex-row-reverse font-medium text-zinc-200 sm:pl-4;
}
td > p {
    @apply table-cell lg:hidden text-sm text-zinc-400;
}
</style>
