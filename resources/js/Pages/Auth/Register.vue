<template>
    <Head title="Register"/>

    <div class="max-w-xl mx-auto">
        <jet-validation-errors class="mb-4"/>

        <form @submit.prevent="submit">
            <div>
                <jet-label for="name" value="Name"/>
                <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" autofocus
                           autocomplete="name"/>
            </div>

            <div class="mt-4">
                <jet-label for="display_name" value="Display Name"/>
                <jet-input id="display_name" type="text" class="mt-1 block w-full" v-model="form.display_name"/>
            </div>

            <div class="mt-4">
                <jet-label for="email" value="Email"/>
                <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email"/>
            </div>

            <div class="mt-4">
                <jet-label for="password" value="Password"/>
                <jet-input id="password" type="password" class="mt-1 block w-full" v-model="form.password"
                           autocomplete="new-password"/>
            </div>

            <div class="flex items-center justify-between mt-4">
                <x-link :href="route('login')" class="underline">
                    Already registered?
                </x-link>

                <jet-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </jet-button>
            </div>
        </form>
    </div>
</template>

<script>
import {defineComponent} from 'vue'
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue'
import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue'
import JetButton from '@/Jetstream/Button.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetCheckbox from '@/Jetstream/Checkbox.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'
import {Head, Link} from '@inertiajs/inertia-vue3';

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

    data() {
        return {
            form: this.$inertia.form({
                name: '',
                display_name: '',
                email: '',
                password: '',
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('register'), {
                onFinish: () => this.form.reset('password', 'password_confirmation'),
            })
        }
    }
})
</script>
