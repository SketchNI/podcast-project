<template>
    <div class="flex-1 flex flex-col min-h-0 border-r border-gray-200 dark:border-zinc-800 bg-white dark:bg-zinc-900">
        <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
            <div class="flex items-center flex-shrink-0 px-4">
                <header>
                    <img class="h-8 w-auto"
                         src="https://tailwindui.com/img/logos/workflow-logo-indigo-600-mark-gray-800-text.svg"
                         alt="Workflow"/>
                </header>
            </div>
            <nav role="navigation" aria-label="Main Navigation" class="mt-5 flex-1 px-2 bg-white dark:bg-zinc-900 space-y-1">
                <x-link v-for="item in navigation" :key="item.name" :href="item.href"
                   :class="[item.current ? 'active' : 'inactive', 'group flex items-center px-2 py-2 font-semibold rounded-md']">
                    <component :is="item.icon"
                               :class="[item.current ? 'active-icon' : 'inactive-icon', 'mr-3 flex-shrink-0 h-6 w-6']"
                               aria-hidden="true"/>
                    {{ item.name }}
                </x-link>

                <x-link :href="route('home')" class="inactive group link flex items-center px-2 py-2 font-semibold rounded-md">
                    <HomeIcon class="inactive-icon mr-4 flex-shrink-0 h-6 w-6" aria-hidden="true"/>
                    Main Site
                </x-link>
            </nav>
        </div>
        <nav v-if="$page.props.user !== null" role="navigation" aria-label="Navigate to users profile" class="flex-shrink-0 flex border-t border-gray-200 dark:border-zinc-700 p-4">
            <x-link :href="route('profile.show')" class="flex-shrink-0 w-full group block">
                <div class="flex items-center">
                    <div>
                        <img class="inline-block h-9 w-9 rounded-full"
                             :src="$page.props.user.profile_photo_url"
                             :alt="`${$page.props.user.display_name}'s Avatar`" />
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-700 dark:text-zinc-200 group-hover:text-gray-900 dark:group-hover:text-zinc-300">
                            {{  $page.props.user.display_name }}
                        </p>
                        <p class="text-xs font-medium text-gray-500 dark:text-zinc-400 group-hover:text-gray-700 dark:group-hover:text-zinc-500">
                            View profile
                        </p>
                    </div>
                </div>
            </x-link>
        </nav>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
import { Dialog, DialogOverlay, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { MenuIcon, XIcon, HomeIcon } from '@heroicons/vue/outline'

export default defineComponent({
    name: "DesktopNav",

    props: ['navigation'],

    components: {
        Dialog,
        DialogOverlay,
        TransitionChild,
        TransitionRoot,
        MenuIcon,
        XIcon,
        HomeIcon,
    },
});
</script>

<style scoped>
.active {
    @apply bg-purple-400 dark:bg-purple-600 text-zinc-900 dark:text-zinc-100;
}

.active-icon {
    @apply text-zinc-900 dark:text-zinc-100
}

.be-red {
    @apply text-red-600 dark:text-red-400 hover:bg-red-600 dark:hover:bg-red-400 dark:hover:text-white hover:text-white hover:bg-opacity-70 !important;
}

.inactive {
    @apply text-zinc-600 dark:text-zinc-200 dark:hover:bg-purple-500 dark:hover:bg-opacity-70 dark:hover:text-zinc-100;
    @apply hover:bg-purple-400 hover:bg-opacity-70 hover:text-zinc-900 dark:hover:text-zinc-100;
}

.inactive-icon {
    @apply text-zinc-900 dark:text-zinc-400 dark:group-hover:text-zinc-100 group-hover:text-zinc-900;
}
</style>
