<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import CreateCampaign from "@/Pages/Campaign/CreateCampaign.vue";

const props =  defineProps({
    causes : {
        type : Array<App.Data.CauseData>,
        required : true
    },
    districts : {
        type : Array<App.Data.DistrictData>,
        required : true
    },
    priorities : {
        type : Array,
        required : true
    },
    statuses : {
        type : Array,
        required : true
    },
    campaigns : {
        type : Object
    }
})
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
                    <CreateCampaign :causes="causes" :districts="districts" :priorities="priorities" :statuses="statuses" />
                </div>
            </div>
            <div>
                <main class="py-6 px-4 sm:p-6 md:py-10 md:px-8 grid grid-cols-4 gap-8" >
                    <article v-for="campaign in campaigns.data"
                        class="!w-full rounded-3xl bg-white dark:bg-gray-700  dark:border-gray-700 transition-transform duration-300 transform-gpu hover:scale-105 hover:shadow-none hover:shadow-gray-400">

                        <header class="rounded-3xl">

                                <img class="col-span-1 sm:col-span-3  h-72 sm:h-40 md:h-64 object-cover rounded-3xl w-full rounded-b-md"
                                     src="https://placehold.co/600x400"
                                    >
                        </header>

                        <div class="w-full p-4 pb-6 font-['Jost'] text-gray-500 grid justify-items-stretch col-span-3">
                            <div class="flex justify-between">
                                <h1 class="text-lg font-semibold line-clamp-1 normal-case py-1 first-letter:uppercase">
                                    {{ campaign.title }}
                                </h1>
                            </div>

                            <div class="flex mb-1 font-normal text-sm text-gray-700 dark:text-gray-400 line-clamp-1"
                                 itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
                                <svg class="text-gray-400" width="20" height="20"
                                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                     stroke="currentColor">
                                    <circle cx="12" cy="10" r="3" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></circle>
                                    <path
                                        d="M12 2C7.58172 2 4 5.58172 4 10C4 11.8919 4.40209 13.1304 5.5 14.5L12 22L18.5 14.5C19.5979 13.1304 20 11.8919 20 10C20 5.58172 16.4183 2 12 2Z"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>
                                <p class="line-clamp-1">
                                    &nbsp;
                                    {{ campaign?.district?.name }}
                                </p>

                            </div>
                            <div class="grid grid-cols-3 gap-8 mt-2">


                                <div class="my-2 flex text-gray-500 col-span-2">
                                    &nbsp; <strong>58</strong>
                                </div>
                            </div>

                        </div>
                    </article>
                </main>
            </div>
        </div>
        </template>
    </AuthenticatedLayout>
</template>
