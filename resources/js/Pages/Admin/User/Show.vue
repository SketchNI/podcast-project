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
                    Edit User
                </template>

                <template #description>
                    Update this users details and profile.
                </template>

                <template #form>
                    <!-- Name -->
                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="name" value="Name"/>
                        <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" autocomplete="name"/>
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
                        <jet-textarea rows="4" class="mt-2 block w-full" v-model="form.bio" placeholder="Tell us about you..."/>
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
import { ref, defineComponent } from 'vue'
import { UserIcon, MusicNoteIcon, DocumentTextIcon, SpeakerphoneIcon } from '@heroicons/vue/solid'
import XTable from '@/Components/Table';
import XButton from '@/Jetstream/Button';
import JetInput from '@/Jetstream/Input';
import JetLabel from '@/Jetstream/Label';
import JetTextarea from '@/Jetstream/Textarea';
import JetInputError from '@/Jetstream/InputError';
import JetFormSection from '@/Jetstream/FormSection';
import JetActionMessage from '@/Jetstream/ActionMessage';
import JetPrefixedInput from '@/Jetstream/PrefixedInput';

export default defineComponent({
    name: "Show",

    props: ['user'],

    components: {
        XTable,
        XButton,
        UserIcon,
        JetInput,
        JetLabel,
        JetTextarea,
        MusicNoteIcon,
        JetInputError,
        JetFormSection,
        JetActionMessage,
        JetPrefixedInput,
        DocumentTextIcon,
        SpeakerphoneIcon,
    },

    methods: {
        updateProfile() {
            this.form.put(route('admin.users.edit', { user: this.user }), {
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
</style>
