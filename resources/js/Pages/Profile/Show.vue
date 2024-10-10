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
        <h2 class=" text-2xl text-gray-800 leading-tight text-center font-semibold px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">Profile</h2>
        
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

            <div class="w-full flex justify-center">

                <a :href="route('user.show', $page.props.auth.user.id)" class="inline-flex items-center mx-4 mt-8 px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Back to app</a>
            </div>
        </div>
    </div>
</template>