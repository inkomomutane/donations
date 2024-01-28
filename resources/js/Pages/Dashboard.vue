<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import CreateCampaign from "@/Pages/Campaign/CreateCampaign.vue";
</script>

<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
        <template v-slot:content>
        <div class="mx-auto">
            <!-- Start coding here 0 -->
            <div
                class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4"
            >
                <div class="w-full md:w-1/2"></div>
                <div
                    class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0"
                >
                    <CreateCampaign />
                </div>
            </div>
        </div>
        </template>
    </AuthenticatedLayout>
</template>
