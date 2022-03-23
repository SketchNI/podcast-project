<template>
    <TransitionRoot as="template" :show="sidebarOpen">
        <Dialog as="div" class="fixed inset-0 flex z-40 md:hidden" @close="sidebarOpen = false">
        <TransitionChild as="template" enter="transition-opacity ease-linear duration-300" enter-from="opacity-0"
                         enter-to="opacity-100" leave="transition-opacity ease-linear duration-300" leave-from="opacity-100"
                         leave-to="opacity-0">
            <DialogOverlay class="fixed inset-0 bg-zinc-600 bg-opacity-75"/>
        </TransitionChild>
        <TransitionChild as="template" enter="transition ease-in-out duration-300 transform" enter-from="-translate-x-full"
                         enter-to="translate-x-0" leave="transition ease-in-out duration-300 transform"
                         leave-from="translate-x-0" leave-to="-translate-x-full">
            <div class="relative flex-1 flex flex-col max-w-xs w-full bg-white dark:bg-zinc-900">
                <TransitionChild as="template" enter="ease-in-out duration-300" enter-from="opacity-0"
                                 enter-to="opacity-100" leave="ease-in-out duration-300" leave-from="opacity-100"
                                 leave-to="opacity-0">
                    <div class="absolute top-0 right-0 -mr-12 pt-2">
                        <button type="button"
                                class="close-sidebar"
                                @click="sidebarOpen = false">
                            <span class="sr-only">Close sidebar</span>
                            <XIcon class="h-6 w-6 text-white" aria-hidden="true"/>
                        </button>
                    </div>
                </TransitionChild>
                <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
                    <div class="flex-shrink-0 flex items-center px-4">
                        <img class="h-8 w-auto"
                             src="https://tailwindui.com/img/logos/workflow-logo-indigo-600-mark-zinc-800-text.svg"
                             alt="Workflow"/>
                    </div>
                    <nav class="mt-5 px-2 space-y-1">
                        <x-link v-for="item in navigation" :key="item.name" :href="item.href"
                           :class="`${item.current ? 'active' : 'inactive'} group link`">
                            <component :is="item.icon"
                                       :class="`${item.current ? 'active-icon' : 'inactive-icon'} mr-4 flex-shrink-0 h-6 w-6`"
                                       aria-hidden="true"/>
                            {{ item.name }}
                        </x-link>

                        <x-link :href="route('home')" class="inactive group link">
                            <HomeIcon class="inactive-icon mr-4 flex-shrink-0 h-6 w-6" aria-hidden="true"/>
                            Main Site
                        </x-link>
                    </nav>
                </div>
                <div class="flex-shrink-0 flex border-t border-zinc-200 dark:border-zinc-700 p-4">
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
                </div>
            </div>
        </TransitionChild>
        <div class="flex-shrink-0 w-14">
            <!-- Force sidebar to shrink to fit close icon -->
        </div>
    </Dialog>
    </TransitionRoot>
    <div class="sticky top-0 z-10 md:hidden pl-1 pt-1 sm:pl-3 bg-zinc-100 dark:bg-zinc-900">
        <button type="button" class="-ml-0.5 -mt-0.5 h-12 w-12 inline-flex items-center justify-center rounded-md text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" @click="sidebarOpen = true">
            <span class="sr-only">Open sidebar</span>
            <MenuIcon class="h-6 w-6" aria-hidden="true" />
        </button>
    </div>
</template>

<script>
import { defineComponent, ref } from 'vue'
import { Dialog, DialogOverlay, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { MenuIcon, XIcon, HomeIcon } from '@heroicons/vue/outline'

export default defineComponent({
    name: "MobileNav",

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

    setup() {
        const sidebarOpen = ref(false)

        return {
            sidebarOpen,
        }
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

.inactive {
    @apply text-zinc-600 dark:text-zinc-200 dark:hover:bg-purple-500 dark:hover:bg-opacity-70 dark:hover:text-zinc-100;
    @apply hover:bg-purple-400 hover:bg-opacity-70 hover:text-zinc-900 dark:hover:text-zinc-100;
}

.inactive-icon {
    @apply text-zinc-900 dark:text-zinc-400 dark:group-hover:text-zinc-100 group-hover:text-zinc-900;
}

.link {
    @apply flex items-center px-2 py-2 text-base font-medium rounded-md;
}

.close-sidebar {
    @apply ml-1 flex items-center justify-center h-10 w-10 rounded-full;
    @apply focus:outline-none focus:ring-2 focus:ring-inset focus:ring-purple-500;
}
</style>
