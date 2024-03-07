<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";
import CreateCampaign from "@/Pages/Campaign/CreateCampaign.vue";
import { onMounted, PropType, ref, watch } from "vue";
import { FlasherResponse } from "@flasher/flasher";
import Flasher from "@/helprs";

const props = defineProps({
    causes: {
        type: Array<App.Data.CauseData>,
        required: true,
    },
    districts: {
        type: Array<App.Data.DistrictData>,
        required: true,
    },
    priorities: {
        type: Array,
        required: true,
    },
    statuses: {
        type: Array,
        required: true,
    },
    campaigns: {
        type: Object,
    },
    messages: Object as PropType<FlasherResponse>,
});

watch(
    () => props.messages,
    (value) => {
        value?.envelopes.forEach((element) => {
            Flasher.flash(
                element.notification.type,
                element.notification.message,
            );
        });
    },
    {
        deep: true,
        immediate: true,
    },
);
const links = ref(props.campaigns.links);
watch(
    () => props.campaigns.links,
    (value) => {
        links.value = value;
    },
);
const campaignSearch = ref("");
const searchProgress = ref(false);
watch(
    () => campaignSearch,
    (value) => {
        router.visit(
            route("dashboard", {
                search: value.value,
            }),
            {
                only: ["search", "campaigns"],
                preserveScroll: true,
                preserveState: true,
                onStart: (event) => {
                    searchProgress.value = true;
                },
                onProgress: (event) => {
                    searchProgress.value = true;
                },
                onFinish: (event) => {
                    console.log("searched");
                    searchProgress.value = false;
                },
            },
        );
    },
    {
        deep: true,
    },
);
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
                        <CreateCampaign
                            :causes="causes"
                            :districts="districts"
                            :priorities="priorities"
                            :statuses="statuses"
                        />
                    </div>
                </div>
                <div>
                    <main
                        class="py-6 px-4 sm:p-6 md:py-10 md:px-8 grid grid-cols-3 gap-8"
                    >
                        <div class="w-full col-span-3">
                            <input
                                name="campaign"
                                type="text"
                                v-model="campaignSearch"
                                class="h-14 w-full pr-8 pl-5 rounded z-0 focus:outline-none shadow-2xl bg-emerald-50 border-2 border-emerald-900 text-emerald-900 focus:ring-2 focus:ring-emerald-600 focus:border-transparent"
                                placeholder="Pesquisar campanha..."
                            />
                        </div>
                        <Link
                            :href="
                                route('campaign.edit', {
                                    campaign: campaign.id,
                                })
                            "
                            v-for="campaign in campaigns.data"
                        >
                            <article
                                class="!w-full rounded-3xl rounded-b-xl bg-white dark:bg-gray-700 dark:border-gray-700 transition-transform duration-300 transform-gpu hover:scale-105 hover:shadow-none hover:shadow-gray-400"
                            >
                                <header class="rounded-t-xl">
                                    <img
                                        v-if="campaign.media?.type === null"
                                        class="col-span-1 sm:col-span-3 h-72 sm:h-40 md:h-64 object-cover rounded-t-xl w-full"
                                        src="https://placehold.co/600x400"
                                    />
                                    <img
                                        v-else-if="
                                            campaign.media.type === 'image'
                                        "
                                        class="col-span-1 sm:col-span-3 h-72 sm:h-40 md:h-64 object-cover rounded-t-xl w-full"
                                        :src="campaign.media.url"
                                    />
                                    <video
                                        v-else-if="
                                            campaign.media.type === 'video'
                                        "
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
                                                    campaign.status ===
                                                    'SUSPENSA',
                                                'bg-yellow-600':
                                                    campaign.status ===
                                                    'PENDENTE',
                                                'bg-green-600':
                                                    campaign.status ===
                                                    'COMPLETA',
                                                'bg-gray-600':
                                                    campaign.status ===
                                                    'ACTIVA',
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
                        </Link>
                    </main>
                </div>
                <nav
                    class="sm:rounded my-1 flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"
                    aria-label="Table navigation"
                >
                    <span
                        class="text-sm font-normal text-emerald-500 dark:text-emerald-400"
                    >
                        Mostrando
                        <span
                            class="font-semibold text-emerald-900 dark:text-white"
                            >{{
                                `${campaigns.meta.from ?? 0}-${
                                    campaigns.meta.to ?? 0
                                }`
                            }}</span
                        >
                        de
                        <span
                            class="font-semibold text-emerald-900 dark:text-white"
                        >
                            {{ campaigns.meta.total }}</span
                        >
                    </span>
                    <ul class="inline-flex items-stretch -space-x-px">
                        <li
                            v-if="links[0].active"
                            class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-emerald-500 bg-white border border-emerald-300 hover:bg-emerald-100 hover:text-emerald-700 dark:bg-emerald-800 dark:border-emerald-700 dark:text-emerald-400 dark:hover:bg-emerald-700 dark:hover:text-white"
                        >
                            <Link
                                href=""
                                class="flex rounded-l-lg items-center justify-center h-full py-1.5 px-3 ml-0 text-emerald-500 bg-white border border-emerald-300 hover:bg-emerald-100 hover:text-emerald-700 dark:bg-emerald-800 dark:border-emerald-700 dark:text-emerald-400 dark:hover:bg-emerald-700 dark:hover:text-white"
                                >&laquo; Anterior
                            </Link>
                        </li>
                        <li v-else>
                            <Link
                                class="flex rounded-l-lg items-center justify-center h-full py-1.5 px-3 ml-0 text-emerald-500 bg-white border border-emerald-300 hover:bg-emerald-100 hover:text-emerald-700 dark:bg-emerald-800 dark:border-emerald-700 dark:text-emerald-400 dark:hover:bg-emerald-700 dark:hover:text-white"
                                :href="links[0].url ?? ''"
                                >&laquo; Anterior
                            </Link>
                        </li>
                        <li
                            v-for="link in links.slice(1, -1)"
                            :key="link.label"
                        >
                            <Link
                                class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-emerald-500 bg-white border border-emerald-300 hover:bg-emerald-100 hover:text-emerald-700 dark:bg-emerald-800 dark:border-emerald-700 dark:text-emerald-400 dark:hover:bg-emerald-700 dark:hover:text-white"
                                v-if="!link.active"
                                :href="link.url ?? ''"
                                >{{ link.label }}
                            </Link>
                            <span
                                class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-emerald-500 border border-emerald-300 dark:bg-emerald-800 dark:border-emerald-700 dark:text-emerald-400 dark:hover:bg-emerald-700 dark:hover:text-white"
                                v-else
                                :class="`${
                                    link.active
                                        ? 'bg-emerald-700 dark:bg-slate-600 text-white dark:text-slate-100'
                                        : ''
                                }`"
                                >{{ link.label }}</span
                            >
                        </li>
                        <li
                            v-if="links.slice(-1)[0].active"
                            class="disabled flex items-center justify-center h-full py-1.5 px-3 ml-0 text-emerald-500 bg-white rounded-r-lg border border-emerald-300 hover:bg-emerald-100 hover:text-emerald-700 dark:bg-emerald-800 dark:border-emerald-700 dark:text-emerald-400 dark:hover:bg-emerald-700 dark:hover:text-white"
                        >
                            <span
                                class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-emerald-500 bg-white rounded-r-lg border border-emerald-300 hover:bg-emerald-100 hover:text-emerald-700 dark:bg-emerald-800 dark:border-emerald-700 dark:text-emerald-400 dark:hover:bg-emerald-700 dark:hover:text-white"
                                >Próximo &raquo;</span
                            >
                        </li>
                        <li
                            v-else
                            class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-emerald-500 bg-white rounded-r-lg border border-emerald-300 hover:bg-emerald-100 hover:text-emerald-700 dark:bg-emerald-800 dark:border-emerald-700 dark:text-emerald-400 dark:hover:bg-emerald-700 dark:hover:text-white"
                        >
                            <Link :href="links.slice(-1)[0].url ?? ''"
                                >Próximo &raquo;</Link
                            >
                        </li>
                    </ul>
                </nav>
            </div>
        </template>
    </AuthenticatedLayout>
</template>
