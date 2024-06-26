<script setup>
import SectionBorder from "@/Components/SectionBorder.vue";
import { useUser } from "@/Composables/user";
import AppLayout from "@/Layouts/AppLayout.vue";
import SetPasswordForm from "./Partials/SetPasswordForm.vue";
import TwoFactorAuthenticationForm from "./Partials/TwoFactorAuthenticationForm.vue";
import UpdatePasswordForm from "./Partials/UpdatePasswordForm.vue";
import UpdateProfileInformationForm from "./Partials/UpdateProfileInformationForm.vue";

const user = useUser();
defineProps({
    confirmsTwoFactorAuthentication: Boolean,
    sessions: Array,
});
</script>

<template>
    <AppLayout title="Profile">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Profile
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div v-if="$page.props.jetstream.canUpdateProfileInformation">
                    <UpdateProfileInformationForm :user="user" />

                    <SectionBorder />
                </div>

                <div
                    v-if="
                        $page.props.jetstream.canUpdatePassword &&
                        $page.props.socialstream.hasPassword
                    "
                >
                    <UpdatePasswordForm class="mt-10 sm:mt-0" />

                    <SectionBorder />
                </div>

                <div v-else>
                    <SetPasswordForm class="mt-10 sm:mt-0" />

                    <SectionBorder />
                </div>

                <div
                    v-if="
                        $page.props.jetstream
                            .canManageTwoFactorAuthentication &&
                        $page.props.socialstream.hasPassword
                    "
                >
                    <TwoFactorAuthenticationForm
                        :requires-confirmation="confirmsTwoFactorAuthentication"
                        class="mt-10 sm:mt-0"
                    />

                    <SectionBorder />
                </div>

                <div v-if="$page.props.socialstream.show">
                    <ConnectedAccountsForm class="mt-10 sm:mt-0" />
                </div>

                <div v-if="$page.props.socialstream.hasPassword">
                    <SectionBorder />

                    <LogoutOtherBrowserSessionsForm
                        :sessions="sessions"
                        class="mt-10 sm:mt-0"
                    />
                </div>

                <template
                    v-if="
                        $page.props.jetstream.hasAccountDeletionFeatures &&
                        $page.props.socialstream.hasPassword
                    "
                >
                    <SectionBorder />

                    <DeleteUserForm class="mt-10 sm:mt-0" />
                </template>
            </div>
        </div>
    </AppLayout>
</template>
@/Composables/user
