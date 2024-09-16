<script setup>
import DeleteUserForm from '@/Pages/Profile/Partials/DeleteUserForm.vue';
import LogoutOtherBrowserSessionsForm from '@/Pages/Profile/Partials/LogoutOtherBrowserSessionsForm.vue';
import SectionBorder from '@/Components/SectionBorder.vue';
import UpdatePasswordForm from '@/Pages/Profile/Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from '@/Pages/Profile/Partials/UpdateProfileInformationForm.vue';

defineProps({
    confirmsTwoFactorAuthentication: Boolean,
    sessions: Array,
});
</script>

<template>
    <div>
        <!-- Direct header without a named slot -->
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Profile</h2>
        <a :href="route('user.show', $page.props.auth.user.id)">Back</a>
        <!-- Main container -->
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <!-- Conditional rendering: Update profile info -->
            <div v-if="$page.props.jetstream.canUpdateProfileInformation">
                <UpdateProfileInformationForm :user="$page.props.auth.user" />
                <SectionBorder />
            </div>

            <!-- Conditional rendering: Update password -->
            <div v-if="$page.props.jetstream.canUpdatePassword">
                <UpdatePasswordForm class="mt-10 sm:mt-0" />
                <SectionBorder />
            </div>

            <!-- Logout other sessions form -->
            <LogoutOtherBrowserSessionsForm :sessions="sessions" class="mt-10 sm:mt-0" />

            <!-- Account deletion (if available) -->
            <template v-if="$page.props.jetstream.hasAccountDeletionFeatures">
                <SectionBorder />
                <DeleteUserForm class="mt-10 sm:mt-0" />
            </template>
        </div>
    </div>
</template>