<script setup lang="ts">
import { Head, Link } from "@inertiajs/vue3";
import { defineProps, PropType } from "vue";
import CampaignData = App.Data.CampaignData;
import Header from "@/Pages/Website/Header.vue";
const appName = import.meta.env.VITE_APP_NAME;
const props = defineProps<{
    canLogin?: boolean;
    canRegister?: boolean;
    laravelVersion: string;
    phpVersion: string;
    campaigns: Object;
    causes: Array<App.Data.CauseData>;
    urgent_priority: Array<CampaignData>;
    high_priority: Array<CampaignData>;
    medium_priority: Array<CampaignData>;
    low_priority: Array<CampaignData>;
}>();

setTimeout(() => {
    const preloader = document.getElementById("preloader");
    if (preloader) {
        preloader.style.display = "none";
    }
}, 1000);
</script>

<template>
    <Head title="Welcome" />

    <Header/>
    <div id="preloader"
         class="fixed inset-0 flex items-center justify-center z-40 w-full bg-emerald-200/95 backdrop-blur-xl">
        <div class="animate-spin rounded-full h-32 w-32 border-t-8 border-b border-emerald-600 "></div>
        <div class="absolute">
            <svg class="w-24 h-24 fill-emerald-950 " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="M19.86 8.09c0 .15 0 .3-.01.44-1.53-.57-3.33-.22-4.53.86a4.43 4.43 0 00-2.98-1.14c-2.46 0-4.46 2.01-4.46 4.49 0 2.83 1.42 4.9 2.78 6.24-.11-.01-.2-.03-.28-.06C7.79 18.03 2 14.35 2 8.09 2 5.33 4.22 3.1 6.96 3.1c1.63 0 3.07.78 3.97 1.99A4.957 4.957 0 0114.9 3.1c2.74 0 4.96 2.23 4.96 4.99z" opacity=".4"></path>
                <path d="M18 9.59c-1.07 0-2.04.52-2.64 1.32-.6-.8-1.56-1.32-2.64-1.32-1.82 0-3.3 1.48-3.3 3.32 0 .71.11 1.36.31 1.96.94 2.97 3.83 4.74 5.26 5.23.2.07.53.07.74 0 1.43-.49 4.32-2.26 5.26-5.23.2-.61.31-1.26.31-1.96 0-1.84-1.48-3.32-3.3-3.32z"></path>
            </svg>
        </div>
    </div>
    <div
        class="sm:flex sm:justify-center sm:items-center bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white"
    >
        <div class="p-6 lg:p-8 max-w-screen-2xl">
            <div class="mx-2 sm:px-4 md:px-8 w-full space-y-8">
                <div>
                    <div class="flex flex-row justify-between">
                        <h5
                            class="font-black font-['Roboto'] text-start self-start p-2"
                        >
                            — Campanhas de prioridade urgente
                        </h5>
                        <h6
                            class="font-black font-['Roboto'] hover:text-blue-500 hover:bg-white p-2 hover:rounded-md inline-flex items-center px-4"
                        >
                            Ver todas
                            <svg
                                class="w-3 h-3 ml-2 -mr-1"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
                        </h6>
                    </div>
                    <div
                        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-6 lg:gap-8 my-8"
                    >
                        <article
                            v-for="campaign in urgent_priority"
                            :key="campaign.id"
                            class="!w-full rounded-3xl rounded-b-xl bg-white dark:bg-gray-700 dark:border-gray-700 transition-transform duration-300 transform-gpu hover:scale-105 hover:shadow-none hover:shadow-gray-400"
                        >
                            <header class="rounded-t-xl">
                                <img
                                    v-if="!campaign.media?.type"
                                    class="col-span-1 sm:col-span-3 h-72 sm:h-40 md:h-64 object-cover rounded-t-xl w-full"
                                    src="https://placehold.co/600x400"
                                />
                                <img
                                    v-else-if="campaign.media.type === 'image'"
                                    class="col-span-1 sm:col-span-3 h-72 sm:h-40 md:h-64 object-cover rounded-t-xl w-full"
                                    :src="campaign.media.url"
                                />
                                <video
                                    v-else-if="campaign.media.type === 'video'"
                                    class="col-span-1 sm:col-span-3 h-72 sm:h-40 md:h-64 object-cover rounded-t-xl w-full"
                                    :src="campaign.media.url"
                                    controls
                                ></video>
                            </header>

                            <div
                                class="w-full p-4 pb-6 text-gray-500 grid justify-items-stretch col-span-3"
                            >
                                <div class="flex justify-between">
                                    <h1
                                        class="text-lg font-['Lato'] font-semibold line-clamp-2 py-1 uppercase first-letter:uppercase"
                                    >
                                        {{ campaign.title }}
                                    </h1>
                                </div>
                                <div
                                    class="line-clamp-2 pb-2 text-sm"
                                    v-html="campaign.description"
                                ></div>

                                <div
                                    class="flex mb-1 font-normal text-sm text-gray-700 dark:text-gray-400 line-clamp-1"
                                    itemprop="address"
                                    itemscope
                                    itemtype="https://schema.org/PostalAddress"
                                >
                                    <svg
                                        class="text-gray-400"
                                        width="20"
                                        height="20"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                    >
                                        <circle
                                            cx="12"
                                            cy="10"
                                            r="3"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        ></circle>
                                        <path
                                            d="M12 2C7.58172 2 4 5.58172 4 10C4 11.8919 4.40209 13.1304 5.5 14.5L12 22L18.5 14.5C19.5979 13.1304 20 11.8919 20 10C20 5.58172 16.4183 2 12 2Z"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        ></path>
                                    </svg>
                                    <p class="line-clamp-1">
                                        &nbsp;
                                        {{ campaign?.district?.name }}
                                    </p>
                                </div>
                                <div class="flex gap-2 mt-2 font-black">
                                    <div
                                        class="flex text-center font-['Roboto'] text-gray-50 bg-blue-600 rounded-sm p-1 px-2"
                                    >
                                        <small class="font-black"
                                            >Meta:&nbsp;{{
                                                campaign.goalAmount ?? 0
                                            }}
                                        </small>
                                    </div>

                                    <div
                                        class="flex text-center font-['Roboto'] text-gray-50 bg-green-600 rounded-sm p-1 px-2"
                                    >
                                        <small class="font-black"
                                            >Total:&nbsp;{{
                                                campaign.goalAmount ?? 0
                                            }}
                                        </small>
                                    </div>
                                    <div
                                        :class="{
                                            'bg-red-600':
                                                campaign.status === 'SUSPENSA',
                                            'bg-yellow-600':
                                                campaign.status === 'PENDENTE',
                                            'bg-green-600':
                                                campaign.status === 'COMPLETA',
                                            'bg-gray-600':
                                                campaign.status === 'ACTIVA',
                                        }"
                                        class="flex text-center font-['Roboto'] text-gray-50 rounded-sm p-1 px-2"
                                    >
                                        <small class="font-black">
                                            Status: {{ campaign.status }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
                <div>
                    <h5
                        class="font-black font-['Roboto'] text-start self-start"
                    >
                        — Campanhas de prioridade alta
                    </h5>
                    <div
                        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-6 lg:gap-8 my-8"
                    >
                        <article
                            v-for="campaign in high_priority"
                            :key="campaign.id"
                            class="!w-full rounded-3xl rounded-b-xl bg-white dark:bg-gray-700 dark:border-gray-700 transition-transform duration-300 transform-gpu hover:scale-105 hover:shadow-none hover:shadow-gray-400"
                        >
                            <header class="rounded-t-xl">
                                <img
                                    v-if="!campaign.media?.type"
                                    class="col-span-1 sm:col-span-3 h-72 sm:h-40 md:h-64 object-cover rounded-t-xl w-full"
                                    src="https://placehold.co/600x400"
                                />
                                <img
                                    v-else-if="campaign.media.type === 'image'"
                                    class="col-span-1 sm:col-span-3 h-72 sm:h-40 md:h-64 object-cover rounded-t-xl w-full"
                                    :src="campaign.media.url"
                                />
                                <video
                                    v-else-if="campaign.media.type === 'video'"
                                    class="col-span-1 sm:col-span-3 h-72 sm:h-40 md:h-64 object-cover rounded-t-xl w-full"
                                    :src="campaign.media.url"
                                    controls
                                ></video>
                            </header>

                            <div
                                class="w-full p-4 pb-6 text-gray-500 grid justify-items-stretch col-span-3"
                            >
                                <div class="flex justify-between">
                                    <h1
                                        class="text-lg font-['Lato'] font-semibold line-clamp-2 py-1 uppercase first-letter:uppercase"
                                    >
                                        {{ campaign.title }}
                                    </h1>
                                </div>
                                <div
                                    class="line-clamp-2 pb-2 text-sm"
                                    v-html="campaign.description"
                                ></div>

                                <div
                                    class="flex mb-1 font-normal text-sm text-gray-700 dark:text-gray-400 line-clamp-1"
                                    itemprop="address"
                                    itemscope
                                    itemtype="https://schema.org/PostalAddress"
                                >
                                    <svg
                                        class="text-gray-400"
                                        width="20"
                                        height="20"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                    >
                                        <circle
                                            cx="12"
                                            cy="10"
                                            r="3"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        ></circle>
                                        <path
                                            d="M12 2C7.58172 2 4 5.58172 4 10C4 11.8919 4.40209 13.1304 5.5 14.5L12 22L18.5 14.5C19.5979 13.1304 20 11.8919 20 10C20 5.58172 16.4183 2 12 2Z"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        ></path>
                                    </svg>
                                    <p class="line-clamp-1">
                                        &nbsp;
                                        {{ campaign?.district?.name }}
                                    </p>
                                </div>
                                <div class="flex gap-2 mt-2 font-black">
                                    <div
                                        class="flex text-center font-['Roboto'] text-gray-50 bg-blue-600 rounded-sm p-1 px-2"
                                    >
                                        <small class="font-black"
                                            >Meta:&nbsp;{{
                                                campaign.goalAmount ?? 0
                                            }}
                                        </small>
                                    </div>

                                    <div
                                        class="flex text-center font-['Roboto'] text-gray-50 bg-green-600 rounded-sm p-1 px-2"
                                    >
                                        <small class="font-black"
                                            >Total:&nbsp;{{
                                                campaign.goalAmount ?? 0
                                            }}
                                        </small>
                                    </div>
                                    <div
                                        :class="{
                                            'bg-red-600':
                                                campaign.status === 'SUSPENSA',
                                            'bg-yellow-600':
                                                campaign.status === 'PENDENTE',
                                            'bg-green-600':
                                                campaign.status === 'COMPLETA',
                                            'bg-gray-600':
                                                campaign.status === 'ACTIVA',
                                        }"
                                        class="flex text-center font-['Roboto'] text-gray-50 rounded-sm p-1 px-2"
                                    >
                                        <small class="font-black">
                                            Status: {{ campaign.status }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
                <div>
                    <h5
                        class="font-black font-['Roboto'] text-start self-start"
                    >
                        — Campanhas de prioridade média
                    </h5>
                    <div
                        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-6 lg:gap-8 my-8"
                    >
                        <article
                            v-for="campaign in medium_priority"
                            :key="campaign.id"
                            class="!w-full rounded-3xl rounded-b-xl bg-white dark:bg-gray-700 dark:border-gray-700 transition-transform duration-300 transform-gpu hover:scale-105 hover:shadow-none hover:shadow-gray-400"
                        >
                            <header class="rounded-t-xl">
                                <img
                                    v-if="!campaign.media?.type"
                                    class="col-span-1 sm:col-span-3 h-72 sm:h-40 md:h-64 object-cover rounded-t-xl w-full"
                                    src="https://placehold.co/600x400"
                                />
                                <img
                                    v-else-if="campaign.media.type === 'image'"
                                    class="col-span-1 sm:col-span-3 h-72 sm:h-40 md:h-64 object-cover rounded-t-xl w-full"
                                    :src="campaign.media.url"
                                />
                                <video
                                    v-else-if="campaign.media.type === 'video'"
                                    class="col-span-1 sm:col-span-3 h-72 sm:h-40 md:h-64 object-cover rounded-t-xl w-full"
                                    :src="campaign.media.url"
                                    controls
                                ></video>
                            </header>

                            <div
                                class="w-full p-4 pb-6 text-gray-500 grid justify-items-stretch col-span-3"
                            >
                                <div class="flex justify-between">
                                    <h1
                                        class="text-lg font-['Lato'] font-semibold line-clamp-2 py-1 uppercase first-letter:uppercase"
                                    >
                                        {{ campaign.title }}
                                    </h1>
                                </div>
                                <div
                                    class="line-clamp-2 pb-2 text-sm"
                                    v-html="campaign.description"
                                ></div>

                                <div
                                    class="flex mb-1 font-normal text-sm text-gray-700 dark:text-gray-400 line-clamp-1"
                                    itemprop="address"
                                    itemscope
                                    itemtype="https://schema.org/PostalAddress"
                                >
                                    <svg
                                        class="text-gray-400"
                                        width="20"
                                        height="20"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                    >
                                        <circle
                                            cx="12"
                                            cy="10"
                                            r="3"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        ></circle>
                                        <path
                                            d="M12 2C7.58172 2 4 5.58172 4 10C4 11.8919 4.40209 13.1304 5.5 14.5L12 22L18.5 14.5C19.5979 13.1304 20 11.8919 20 10C20 5.58172 16.4183 2 12 2Z"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        ></path>
                                    </svg>
                                    <p class="line-clamp-1">
                                        &nbsp;
                                        {{ campaign?.district?.name }}
                                    </p>
                                </div>
                                <div class="flex gap-2 mt-2 font-black">
                                    <div
                                        class="flex text-center font-['Roboto'] text-gray-50 bg-blue-600 rounded-sm p-1 px-2"
                                    >
                                        <small class="font-black"
                                            >Meta:&nbsp;{{
                                                campaign.goalAmount ?? 0
                                            }}
                                        </small>
                                    </div>

                                    <div
                                        class="flex text-center font-['Roboto'] text-gray-50 bg-green-600 rounded-sm p-1 px-2"
                                    >
                                        <small class="font-black"
                                            >Total:&nbsp;{{
                                                campaign.goalAmount ?? 0
                                            }}
                                        </small>
                                    </div>
                                    <div
                                        :class="{
                                            'bg-red-600':
                                                campaign.status === 'SUSPENSA',
                                            'bg-yellow-600':
                                                campaign.status === 'PENDENTE',
                                            'bg-green-600':
                                                campaign.status === 'COMPLETA',
                                            'bg-gray-600':
                                                campaign.status === 'ACTIVA',
                                        }"
                                        class="flex text-center font-['Roboto'] text-gray-50 rounded-sm p-1 px-2"
                                    >
                                        <small class="font-black">
                                            Status: {{ campaign.status }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
                <div>
                    <h5
                        class="font-black font-['Roboto'] text-start self-start"
                    >
                        — Campanhas de prioridade baixa
                    </h5>
                    <div
                        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-6 lg:gap-8 my-8"
                    >
                        <article
                            v-for="campaign in low_priority"
                            :key="campaign.id"
                            class="!w-full rounded-3xl rounded-b-xl bg-white dark:bg-gray-700 dark:border-gray-700 transition-transform duration-300 transform-gpu hover:scale-105 hover:shadow-none hover:shadow-gray-400"
                        >
                            <header class="rounded-t-xl">
                                <img
                                    v-if="!campaign.media?.type"
                                    class="col-span-1 sm:col-span-3 h-72 sm:h-40 md:h-64 object-cover rounded-t-xl w-full"
                                    src="https://placehold.co/600x400"
                                />
                                <img
                                    v-else-if="campaign.media.type === 'image'"
                                    class="col-span-1 sm:col-span-3 h-72 sm:h-40 md:h-64 object-cover rounded-t-xl w-full"
                                    :src="campaign.media.url"
                                />
                                <video
                                    v-else-if="campaign.media.type === 'video'"
                                    class="col-span-1 sm:col-span-3 h-72 sm:h-40 md:h-64 object-cover rounded-t-xl w-full"
                                    :src="campaign.media.url"
                                    controls
                                ></video>
                            </header>

                            <div
                                class="w-full p-4 pb-6 text-gray-500 grid justify-items-stretch col-span-3"
                            >
                                <div class="flex justify-between">
                                    <h1
                                        class="text-lg font-['Lato'] font-semibold line-clamp-2 py-1 uppercase first-letter:uppercase"
                                    >
                                        {{ campaign.title }}
                                    </h1>
                                </div>
                                <div
                                    class="line-clamp-2 pb-2 text-sm"
                                    v-html="campaign.description"
                                ></div>

                                <div
                                    class="flex mb-1 font-normal text-sm text-gray-700 dark:text-gray-400 line-clamp-1"
                                    itemprop="address"
                                    itemscope
                                    itemtype="https://schema.org/PostalAddress"
                                >
                                    <svg
                                        class="text-gray-400"
                                        width="20"
                                        height="20"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                    >
                                        <circle
                                            cx="12"
                                            cy="10"
                                            r="3"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        ></circle>
                                        <path
                                            d="M12 2C7.58172 2 4 5.58172 4 10C4 11.8919 4.40209 13.1304 5.5 14.5L12 22L18.5 14.5C19.5979 13.1304 20 11.8919 20 10C20 5.58172 16.4183 2 12 2Z"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        ></path>
                                    </svg>
                                    <p class="line-clamp-1">
                                        &nbsp;
                                        {{ campaign?.district?.name }}
                                    </p>
                                </div>
                                <div class="flex gap-2 mt-2 font-black">
                                    <div
                                        class="flex text-center font-['Roboto'] text-gray-50 bg-blue-600 rounded-sm p-1 px-2"
                                    >
                                        <small class="font-black"
                                            >Meta:&nbsp;{{
                                                campaign.goalAmount ?? 0
                                            }}
                                        </small>
                                    </div>

                                    <div
                                        class="flex text-center font-['Roboto'] text-gray-50 bg-green-600 rounded-sm p-1 px-2"
                                    >
                                        <small class="font-black"
                                            >Total:&nbsp;{{
                                                campaign.goalAmount ?? 0
                                            }}
                                        </small>
                                    </div>
                                    <div
                                        :class="{
                                            'bg-red-600':
                                                campaign.status === 'SUSPENSA',
                                            'bg-yellow-600':
                                                campaign.status === 'PENDENTE',
                                            'bg-green-600':
                                                campaign.status === 'COMPLETA',
                                            'bg-gray-600':
                                                campaign.status === 'ACTIVA',
                                        }"
                                        class="flex text-center font-['Roboto'] text-gray-50 rounded-sm p-1 px-2"
                                    >
                                        <small class="font-black">
                                            Status: {{ campaign.status }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
            <div
                class="flex justify-center mt-16 px-6 sm:items-center sm:justify-between"
            >
                <div
                    class="text-center text-sm text-gray-500 dark:text-gray-400 sm:text-start"
                >
                    <div class="flex items-center gap-4">
                        <a
                            href="https://github.com/sponsors/taylorotwell"
                            class="group inline-flex items-center hover:text-gray-700 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                class="-mt-px me-1 w-5 h-5 stroke-gray-400 dark:stroke-gray-600 group-hover:stroke-gray-600 dark:group-hover:stroke-gray-400"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"
                                />
                            </svg>
                            Sponsor
                        </a>
                    </div>
                </div>

                <div
                    class="ms-4 text-center text-sm text-gray-500 dark:text-gray-400 sm:text-end sm:ms-0"
                >
                    {{ appName }} {{ new Date().getFullYear() }} all rights
                    reserved.
                </div>
            </div>
        </div>
    </div>
</template>
