<template>
    <x-head>
        <title>Home</title>
    </x-head>

    <mobile-nav :navigation="navigation"/>

    <div class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0">
        <desktop-nav :navigation="navigation"/>
    </div>
    <div class="md:pl-64 flex flex-col flex-1">
        <main class="flex-1">
            <top-media-player />

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
    HomeIcon,
    MenuIcon,
    DocumentTextIcon,
    XIcon,
    MusicNoteIcon,
} from '@heroicons/vue/outline'
import MobileNav from "@/Layouts/Partial/MobileNav";
import DesktopNav from "@/Layouts/Partial/DesktopNav";
import { Inertia } from "@inertiajs/inertia";
import TopMediaPlayer from "@/Components/TopMediaPlayer";

export default {
    components: {
        DesktopNav,
        MobileNav,
        Dialog,
        DialogOverlay,
        TransitionChild,
        TransitionRoot,
        MenuIcon,
        XIcon,
        TopMediaPlayer,
    },

    data() {
        return {
            navigation: [
                { name: 'Home', href: window.route('home'), icon: HomeIcon, current: window.route().current('home') },
                {
                    name: 'Episodes',
                    href: window.route('episodes'),
                    icon: MusicNoteIcon,
                    current: window.route().current('episodes')
                },
                {
                    name: 'About',
                    href: window.route('page', { slug: 'about' }),
                    icon: DocumentTextIcon,
                    current: window.route().current('page', { slug: 'about' })
                },
            ],
        }
    },

    created() {
        Inertia.on('navigate', () => {
            this.navigation = [
                { name: 'Home', href: window.route('home'), icon: HomeIcon, current: window.route().current('home') },
                {
                    name: 'Episodes',
                    href: window.route('episodes'),
                    icon: MusicNoteIcon,
                    current: window.route().current('episodes')
                },
                {
                    name: 'About',
                    href: window.route('page', { slug: 'about' }),
                    icon: DocumentTextIcon,
                    current: window.route().current('page', { slug: 'about' })
                },
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
