<template>
    <x-head>
        <title>Home</title>
    </x-head>

    <admin-mobile-nav :navigation="navigation"/>

    <div class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0">
        <admin-desktop-nav :navigation="navigation"/>
    </div>
    <div class="md:pl-64 flex flex-col flex-1">
        <main class="flex-1">
            <div class="py-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                    <portal-target name="heading"/>

                    <div class="py-6">
                        <slot/>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
import { Dialog, DialogOverlay, TransitionChild, TransitionRoot } from '@headlessui/vue'
import {
    XIcon,
    HomeIcon,
    MenuIcon,
    UsersIcon,
    TerminalIcon,
    MusicNoteIcon,
    DocumentTextIcon,
} from '@heroicons/vue/outline'
import AdminMobileNav from "@/Layouts/Partial/AdminMobileNav";
import AdminDesktopNav from "@/Layouts/Partial/AdminDesktopNav";
import { Inertia } from "@inertiajs/inertia";
import TopMediaPlayer from "@/Components/TopMediaPlayer";

export default {
    name: "AdminLayout",

    components: {
        XIcon,
        Dialog,
        MenuIcon,
        TerminalIcon,
        DialogOverlay,
        AdminMobileNav,
        TransitionRoot,
        TopMediaPlayer,
        AdminDesktopNav,
        TransitionChild,
    },

    data() {
        return {
            navigation: [
                {
                    name: 'Dashboard',
                    href: window.route('admin.index'),
                    icon: HomeIcon,
                    current: window.route().current('admin.index')
                },
                {
                    name: 'Episode Manager',
                    href: window.route('admin.episodes.index'),
                    icon: MusicNoteIcon,
                    current: window.route().current('admin.episodes.index')
                },
                {
                    name: 'User Manager',
                    href: window.route('admin.users.index'),
                    icon: UsersIcon,
                    current: window.route().current('admin.users.index')
                },
                {
                    name: 'Page Manager',
                    href: window.route('admin.pages.index'),
                    icon: DocumentTextIcon,
                    current: window.route().current('admin.pages.index')
                },
            ],
        }
    },

    created() {
        Inertia.on('navigate', () => {
            this.navigation = [
                {
                    name: 'Dashboard',
                    href: window.route('admin.index'),
                    icon: HomeIcon,
                    current: window.route().current('admin.index')
                },
                {
                    name: 'User Manager',
                    href: window.route('admin.users.index'),
                    icon: UsersIcon,
                    current: window.route().current('admin.users.index')
                },
                {
                    name: 'Episode Manager',
                    href: window.route('admin.episodes.index'),
                    icon: MusicNoteIcon,
                    current: window.route().current('admin.episodes.index')
                },
                {
                    name: 'Page Manager',
                    href: window.route('admin.pages.index'),
                    icon: DocumentTextIcon,
                    current: window.route().current('admin.pages.index'),
                }
            ]
        });
    },

    methods: {
        logout() {
            this.$inertia.post(window.route('logout'));
        },
    }
};
</script>
