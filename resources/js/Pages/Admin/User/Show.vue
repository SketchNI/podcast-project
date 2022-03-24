<template>
    <x-head>
        <title>User Editor / Admin Dashboard</title>
        <meta property="og:url" :content="$page.props.currentUrl">
        <meta property="og:title" :content="`User Editor / Admin Dashboard - ${$page.props.appName} Podcast`">
    </x-head>
    <portal to="heading"><h1 class="page-heading">User Editor</h1></portal>

    <div class="w-full flex flex-col space-y-6">
        <div class="">
            <jet-form-section @submitted="updateProfile">
                <template #title>
                    Edit Role
                </template>

                <template #description>
                    Update this users role.
                </template>

                <template #form>
                    <!-- Name -->
                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="role" value="Role"/>
                        <div class="relative">
                            <Listbox v-model="form.role">
                                <ListboxButton class="list-button">
                                    {{ form.role.name }}
                                </ListboxButton>
                                <ListboxOptions class="list-items">
                                    <ListboxOption
                                        v-for="role in roles" :key="role" :value="role" v-slot="{ active, selected }"
                                        :class="`${form.role.id === role.id ? 'active' : ''} list-item`">
                                        <span class="w-6">
                                            <CheckIcon v-if="form.role.id === role.id ? 'active' : ''" class="w-4 h-4"/>
                                        </span>
                                        <span>{{ role.name }}</span>
                                    </ListboxOption>
                                </ListboxOptions>
                            </Listbox>
                        </div>
                        <jet-input-error :message="form.errors.role" class="mt-2"/>
                    </div>


                </template>

                <template #actions>
                    <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                        Saved.
                    </jet-action-message>

                    <x-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Save
                    </x-button>
                </template>
            </jet-form-section>
        </div>
        <div class="">
            <jet-form-section @submitted="updateProfile">
                <template #title>
                    Edit User
                </template>

                <template #description>
                    Update this users details and profile.
                </template>

                <template #form>
                    <!-- Name -->
                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="name" value="Name"/>
                        <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name"
                                   autocomplete="name"/>
                        <jet-input-error :message="form.errors.name" class="mt-2"/>
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="display_name" value="Display Name"/>
                        <jet-input id="display_name" type="text" class="mt-1 block w-full" v-model="form.display_name"/>
                        <jet-input-error :message="form.errors.display_name" class="mt-2"/>
                    </div>

                    <!-- Email -->
                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="email" value="Email"/>
                        <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email"/>
                        <jet-input-error :message="form.errors.email" class="mt-2"/>
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="bio" value="Bio"/>
                        <jet-textarea rows="4" class="mt-2 block w-full" v-model="form.bio"
                                      placeholder="Tell us about you..."/>
                        <jet-input-error :message="form.errors.bio" class="mt-2"/>
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="twitter" value="Twitter Handle"/>

                        <div class="flex items-stretch mt-2">
                            <span class="prefix"> twitter.com/ </span>
                            <jet-prefixed-input id="twitter" type="text" v-model="form.twitter"/>
                        </div>
                        <jet-input-error :message="form.errors.twitter" class="mt-2"/>
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="goodreads" value="GoodReads URL"/>

                        <div class="flex items-stretch mt-2">
                            <span class="prefix"> goodreads.com/ </span>
                            <jet-prefixed-input id="goodreads" type="text" v-model="form.goodreads"/>
                        </div>
                        <jet-input-error :message="form.errors.goodreads" class="mt-2"/>
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="discord" value="Discord Server URL"/>

                        <div class="flex items-stretch mt-2">
                            <span class="prefix"> discord.gg/ </span>
                            <jet-prefixed-input id="discord" type="text" v-model="form.discord"/>
                        </div>
                        <jet-input-error :message="form.errors.discord" class="mt-2"/>
                    </div>
                </template>

                <template #actions>
                    <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                        Saved.
                    </jet-action-message>

                    <x-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Save
                    </x-button>
                </template>
            </jet-form-section>
        </div>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
import { UserIcon, MusicNoteIcon, DocumentTextIcon, SpeakerphoneIcon, CheckIcon } from '@heroicons/vue/solid'
import { Listbox, ListboxButton, ListboxOption, ListboxOptions } from '@headlessui/vue';
import XTable from '@/Components/Table';
import XButton from '@/Jetstream/Button';
import JetInput from '@/Jetstream/Input';
import JetLabel from '@/Jetstream/Label';
import JetTextarea from '@/Jetstream/Textarea';
import JetInputError from '@/Jetstream/InputError';
import JetFormSection from '@/Jetstream/FormSection';
import JetActionMessage from '@/Jetstream/ActionMessage';
import JetPrefixedInput from '@/Jetstream/PrefixedInput';
import Checkbox from "@/Jetstream/Checkbox";

export default defineComponent({
    name: "Show",

    props: ['user', 'roles'],

    components: {
        XTable,
        Listbox,
        XButton,
        UserIcon,
        JetInput,
        JetLabel,
        CheckIcon,
        JetTextarea,
        ListboxOption,
        ListboxButton,
        MusicNoteIcon,
        JetInputError,
        ListboxOptions,
        JetFormSection,
        JetActionMessage,
        JetPrefixedInput,
        DocumentTextIcon,
        SpeakerphoneIcon,
    },

    methods: {
        updateProfile() {
            this.form.put(window.route('admin.users.edit', { user: this.user }), {
                preserveScroll: true,
            });
        },
    },

    data() {
        return {
            form: this.$inertia.form({
                _method: 'PUT',
                name: this.user.name,
                email: this.user.email,
                display_name: this.user.display_name,
                photo: null,
                role: this.user.roles[0],
                bio: this.user.profile.bio,
                discord: this.user.profile.discord,
                twitter: this.user.profile.twitter,
                goodreads: this.user.profile.goodreads,
            }),
        }
    }
});
</script>

<style scoped>
.prefix {
    @apply inline-flex w-32 justify-end items-center px-4 rounded-l-md border border-r-0 sm:text-sm;
    @apply border-zinc-300 bg-zinc-50 text-zinc-500;
    @apply dark:border-zinc-900 dark:bg-zinc-900 cursor-pointer dark:text-zinc-200;
}

.list-button {
    @apply border-zinc-500 mt-2 dark:border-zinc-700 dark:bg-zinc-700 focus:border-transparent;
    @apply focus:ring focus:ring-purple-300 focus:ring-opacity-75 active:ring-purple-300 dark:text-zinc-200;
    @apply rounded-md shadow-sm dark:placeholder-zinc-400 py-2 px-3 block w-full text-left;
}

.list-button[aria-expanded="true"] {
    @apply ring-purple-300 ring-opacity-75 ring;
}

.list-items {
    @apply bg-white w-full z-10 mt-1 py-1 text-base max-h-60 ring-1 ring-black ring-opacity-5 overflow-y-auto absolute;
    @apply focus:outline-none sm:text-sm dark:bg-zinc-700 dark:border-zinc-700 shadow-md;
    @apply rounded-lg;
}

.list-item {
    @apply flex px-4 py-2 cursor-default select-none items-center text-zinc-800 dark:text-zinc-300;
    @apply hover:bg-zinc-200 dark:hover:bg-zinc-900 hover:cursor-pointer;
}
</style>
