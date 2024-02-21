<script setup lang="ts">
import { Head, Link } from "@inertiajs/vue3";
import Dashboard from "./Dashboard.vue";
import { Campaigns } from "@/types";
import { defineProps, PropType } from "vue";
import CampaignData = App.Data.CampaignData;
import Header from "@/Pages/Website/Header.vue";
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
</script>

<template>
    <Head title="Welcome" />

    <Header/>

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
                    Donations {{ new Date().getFullYear() }} all rights
                    reserved.
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
