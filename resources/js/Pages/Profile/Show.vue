<template>
    <portal to="heading"><h1 class="page-heading">Profile</h1></portal>

    <div>
        <div class="">
            <div v-if="$page.props.permissions['user.self.update']">
                <update-profile-information-form :user="$page.props.user"/>

                <jet-section-border/>
            </div>

            <div v-if="$page.props.permissions['user.self.bio.update']">
                <update-bio-form :user="$page.props.user"/>

                <jet-section-border/>
            </div>

            <update-password-form class="mt-10 sm:mt-0"/>

            <jet-section-border/>

            <div>
                <two-factor-authentication-form class="mt-10 sm:mt-0"/>

                <jet-section-border/>
            </div>

            <logout-other-browser-sessions-form :sessions="sessions" class="mt-10 sm:mt-0"/>

            <template v-if="$page.props.permissions['user.self.delete']">
                <jet-section-border/>

                <delete-user-form class="mt-10 sm:mt-0"/>
            </template>
        </div>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import DeleteUserForm from '@/Pages/Profile/Partials/DeleteUserForm.vue'
import JetSectionBorder from '@/Jetstream/SectionBorder.vue'
import LogoutOtherBrowserSessionsForm from '@/Pages/Profile/Partials/LogoutOtherBrowserSessionsForm.vue'
import TwoFactorAuthenticationForm from '@/Pages/Profile/Partials/TwoFactorAuthenticationForm.vue'
import UpdatePasswordForm from '@/Pages/Profile/Partials/UpdatePasswordForm.vue'
import UpdateProfileInformationForm from '@/Pages/Profile/Partials/UpdateProfileInformationForm.vue'
import UpdateBioForm from "@/Pages/Profile/Partials/UpdateBioForm";

export default defineComponent({
    props: ['sessions'],

    components: {
        UpdateBioForm,
        AppLayout,
        DeleteUserForm,
        JetSectionBorder,
        LogoutOtherBrowserSessionsForm,
        TwoFactorAuthenticationForm,
        UpdatePasswordForm,
        UpdateProfileInformationForm,
    },
})
</script>
