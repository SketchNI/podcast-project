<template>
    <jet-form-section @submitted="updateBio">
        <template #title>
            Update About You
        </template>

        <template #description>
            Keep your About information up-to-date to help people find you on social media.
        </template>

        <template #form>
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="bio" value="Bio"/>
                <jet-textarea rows="4" class="mt-1 block w-full" v-model="form.bio" placeholder="Tell us about you..."/>
                <jet-input-error :message="form.errors.bio" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <jet-label for="twitter" value="Twitter Handle"/>

                <div class="flex items-stretch">
                    <span class="prefix"> twitter.com/ </span>
                    <jet-prefixed-input id="twitter" type="text" v-model="form.twitter"/>
                </div>
                <jet-input-error :message="form.errors.twitter" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <jet-label for="goodreads" value="GoodReads URL"/>

                <div class="flex items-stretch">
                    <span class="prefix"> goodreads.com/ </span>
                    <jet-prefixed-input id="goodreads" type="text" v-model="form.goodreads"/>
                </div>
                <jet-input-error :message="form.errors.goodreads" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <jet-label for="discord" value="Discord Server URL"/>

                <div class="flex items-stretch">
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

            <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </jet-button>
        </template>
    </jet-form-section>
</template>

<script>
import { defineComponent } from 'vue'
import JetActionMessage from '@/Jetstream/ActionMessage.vue'
import JetButton from '@/Jetstream/Button.vue'
import JetFormSection from '@/Jetstream/FormSection.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetTextarea from '@/Jetstream/Textarea.vue'
import JetInputError from '@/Jetstream/InputError.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetPrefixedInput from '@/Jetstream/PrefixedInput'

export default defineComponent({
    components: {
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        JetTextarea,
        JetPrefixedInput
    },

    props: ['user'],

    data() {
        return {
            form: this.$inertia.form({
                bio: this.user.profile.bio,
                twitter: this.user.profile.twitter,
                goodreads: this.user.profile.goodreads,
                discord: this.user.profile.discord,
            }),
        }
    },

    methods: {
        updateBio() {
            this.form.put(route('update.profile'), {
                preserveScroll: true,
            })
        },
    },
})
</script>

<style scoped>
.prefix {
    @apply inline-flex w-32 justify-end items-center px-4 rounded-l-md border border-r-0 sm:text-sm;
    @apply border-zinc-300 bg-zinc-50 text-zinc-500;
    @apply dark:border-zinc-900 dark:bg-zinc-900 cursor-pointer dark:text-zinc-200;
}
</style>
