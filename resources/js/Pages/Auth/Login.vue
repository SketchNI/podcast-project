<template>
    <x-head>
        <title>Sign In</title>
    </x-head>

    <div class="max-w-xl mx-auto">
        <jet-validation-errors class="mb-4"/>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <jet-label for="email" value="Email"/>
                <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" autofocus/>
            </div>

            <div class="mt-4">
                <jet-label for="password" value="Password"/>
                <jet-input id="password" type="password" class="mt-1 block w-full" v-model="form.password"
                           autocomplete="current-password"/>
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <jet-checkbox name="remember"
                                  class="accent-purple-600 border-0 dark:bg-zinc-600 dark:focus:ring-offset-zinc-800"
                                  v-model:checked="form.remember"/>
                    <span class="ml-2 text-zinc-700 dark:text-zinc-300">Remember me</span>
                </label>
            </div>

            <div class="flex items-center justify-between mt-4">
                <x-link :href="route('register')" class="underline">
                    Sign Up
                </x-link>

                <div>
                    <x-link v-if="canResetPassword" :href="route('password.request')" class="underline">
                        Forgot your password?
                    </x-link>

                    <jet-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Log in
                    </jet-button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue'
import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue'
import JetButton from '@/Jetstream/Button.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetCheckbox from '@/Jetstream/Checkbox.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';

export default defineComponent({
    components: {
        Head,
        JetAuthenticationCard,
        JetAuthenticationCardLogo,
        JetButton,
        JetInput,
        JetCheckbox,
        JetLabel,
        JetValidationErrors,
        Link,
    },

    props: {
        canResetPassword: Boolean,
        status: String
    },

    data() {
        return {
            form: this.$inertia.form({
                email: '',
                password: '',
                remember: false
            })
        }
    },

    methods: {
        submit() {
            this.form
                .transform(data => ({
                    ...data,
                    remember: this.form.remember ? 'on' : ''
                }))
                .post(this.route('login'), {
                    onFinish: () => this.form.reset('password'),
                })
        }
    }
})
</script>
