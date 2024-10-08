<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";

import { Provinces } from "@/types/index";
import { ref, watch, PropType } from "vue";
import Flasher from "@/helprs";
import { FlasherResponse } from "@flasher/flasher";
import CreateProvince from "./CreateProvince.vue";
import EditProvince from "./EditProvince.vue";
import DeleteProvince from "./DeleteProvince.vue";

const props = defineProps({
    provinces: {
        type: Object as PropType<Provinces>,
        required: true,
    },
    search: String,
    messages: Object as PropType<FlasherResponse>,
});

const links = ref(props.provinces.links);

const editingProvinceTrigger = ref(false);
const editingProvince = ref<App.Data.ProvinceData | null>(null);

const deletingProvinceTrigger = ref(false);
const deletingProvince = ref<App.Data.ProvinceData | null>(null);

const searchTerm = ref("");

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
);

watch(
    () => props.provinces.links,
    (value) => {
        links.value = value;
    },
);

watch(searchTerm, (value) => {
    router.visit(
        route("province.all", {
            search: value ?? "",
        }),
        {
            only: ["provinces"],
            replace: false,
            preserveState: true,
        },
    );
});

function openEditProvinceModal(province: App.Data.ProvinceData) {
    editingProvince.value = province;
    editingProvinceTrigger.value = true;
}

function closeEditProvinceModal() {
    editingProvince.value = null;
    editingProvinceTrigger.value = false;
}

function openDeleteProvinceModal(province: App.Data.ProvinceData) {
    deletingProvince.value = province;
    deletingProvinceTrigger.value = true;
}

function closeDeleteProvinceModal() {
    deletingProvince.value = null;
    deletingProvinceTrigger.value = false;
}
</script>

<template>
    <Head title="Províncias" />
    <AuthenticatedLayout>
        <template v-slot:content>
            <div class="mx-auto max-w-screen">
                <!-- Start coding here -->
                <div
                    class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4"
                >
                    <div class="w-full md:w-1/2"></div>
                    <div
                        class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0"
                    >
                        <CreateProvince />
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 shadow-md sm:rounded">
                    <div class="overflow-x-auto">
                        <table
                            class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
                        >
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                            >
                                <tr>
                                    <th scope="col" class="px-4 py-3">
                                        <div class="flex items-center">Id</div>
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        <div class="flex items-center">
                                            Nome da província
                                        </div>
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        Editar
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        Excluir
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    class="border-b dark:border-gray-700"
                                    v-for="province in provinces.data"
                                    :key="province.id as number"
                                >
                                    <th
                                        scope="row"
                                        class="px-4 py-3 font-medium whitespace-nowrap dark:text-white uppercase"
                                    >
                                        {{ province.id }}
                                    </th>

                                    <td class="px-4 py-3">
                                        {{ province.name }}
                                    </td>

                                    <td class="px-4 py-3 w-32">
                                        <button
                                            type="button"
                                            @click="
                                                openEditProvinceModal(province)
                                            "
                                            class="flex items-center justify-center text-white bg-slate-700 hover:bg-slate-800 focus:ring-4 focus:ring-slate-300 font-medium rounded text-sm px-4 py-2 dark:bg-slate-600 dark:hover:bg-slate-700 focus:outline-none dark:focus:ring-slate-800"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="24"
                                                height="24"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                            >
                                                <path
                                                    class="fill-current text-gray-100"
                                                    opacity="0.3"
                                                    fill-rule="evenodd"
                                                    clip-rule="evenodd"
                                                    d="M2 4.63158C2 3.1782 3.1782 2 4.63158 2H13.47C14.0155 2 14.278 2.66919 13.8778 3.04006L12.4556 4.35821C11.9009 4.87228 11.1726 5.15789 10.4163 5.15789H7.1579C6.05333 5.15789 5.15789 6.05333 5.15789 7.1579V16.8421C5.15789 17.9467 6.05333 18.8421 7.1579 18.8421H16.8421C17.9467 18.8421 18.8421 17.9467 18.8421 16.8421V13.7518C18.8421 12.927 19.1817 12.1387 19.7809 11.572L20.9878 10.4308C21.3703 10.0691 22 10.3403 22 10.8668V19.3684C22 20.8218 20.8218 22 19.3684 22H4.63158C3.1782 22 2 20.8218 2 19.3684V4.63158Z"
                                                    fill="black"
                                                />
                                                <path
                                                    class="fill-current text-gray-100"
                                                    d="M10.9256 11.1882C10.5351 10.7977 10.5351 10.1645 10.9256 9.77397L18.0669 2.6327C18.8479 1.85165 20.1143 1.85165 20.8953 2.6327L21.3665 3.10391C22.1476 3.88496 22.1476 5.15129 21.3665 5.93234L14.2252 13.0736C13.8347 13.4641 13.2016 13.4641 12.811 13.0736L10.9256 11.1882Z"
                                                    fill="black"
                                                />
                                                <path
                                                    class="fill-current text-gray-100"
                                                    d="M8.82343 12.0064L8.08852 14.3348C7.8655 15.0414 8.46151 15.7366 9.19388 15.6242L11.8974 15.2092C12.4642 15.1222 12.6916 14.4278 12.2861 14.0223L9.98595 11.7221C9.61452 11.3507 8.98154 11.5055 8.82343 12.0064Z"
                                                    fill="black"
                                                />
                                            </svg>
                                        </button>
                                    </td>
                                    <td class="px-4 py-3 justify-end w-32">
                                        <button
                                            type="button"
                                            @click="
                                                openDeleteProvinceModal(
                                                    province,
                                                )
                                            "
                                            class="flex items-center justify-center text-white bg-red-500 hover:bg-red-700 focus:ring-4 focus:ring-slate-300 font-medium rounded text-sm px-4 py-2 dark:bg-slate-600 dark:hover:bg-slate-700 focus:outline-none dark:focus:ring-slate-800"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="24"
                                                height="24"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                            >
                                                <path
                                                    class="fill-current text-gray-100"
                                                    d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
                                                />
                                                <path
                                                    class="fill-current text-gray-100"
                                                    opacity="0.5"
                                                    d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
                                                />
                                                <path
                                                    class="fill-current text-gray-100"
                                                    opacity="0.5"
                                                    d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
                                                />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                            >
                                <tr>
                                    <th scope="col" class="px-4 py-3">
                                        <div class="flex items-center">Id</div>
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        <div class="flex items-center">
                                            Nome da província
                                        </div>
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        Editar
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        Excluir
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <nav
                    class="sm:rounded my-1 flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"
                    aria-label="Table navigation"
                >
                    <span
                        class="text-sm font-normal text-gray-500 dark:text-gray-400"
                    >
                        Showing
                        <span
                            class="font-semibold text-gray-900 dark:text-white"
                            >{{
                                `${provinces.meta.from ?? 0}-${
                                    provinces.meta.to ?? 0
                                }`
                            }}</span
                        >
                        of
                        <span
                            class="font-semibold text-gray-900 dark:text-white"
                        >
                            {{ provinces.meta.total }}</span
                        >
                    </span>
                    <ul class="inline-flex items-stretch -space-x-px">
                        <li
                            v-if="links[0].active"
                            class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                        >
                            <Link
                                href=""
                                class="flex rounded-l-lg items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                                >&laquo; Previous</Link
                            >
                        </li>
                        <li v-else>
                            <Link
                                class="flex rounded-l-lg items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                                :href="links[0].url ?? ''"
                                >&laquo; Previous</Link
                            >
                        </li>
                        <li
                            v-for="link in links.slice(1, -1)"
                            :key="link.label"
                        >
                            <Link
                                class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                                v-if="!link.active"
                                :href="link.url ?? ''"
                                >{{ link.label }}
                            </Link>
                            <span
                                class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                                v-else
                                :class="`${
                                    link.active
                                        ? 'bg-gray-700 dark:bg-slate-600 text-white dark:text-slate-100'
                                        : ''
                                }`"
                                >{{ link.label }}</span
                            >
                        </li>
                        <li
                            v-if="links.slice(-1)[0].active"
                            class="disabled flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                        >
                            <span
                                class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                                >Next &raquo;</span
                            >
                        </li>
                        <li
                            v-else
                            class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                        >
                            <Link :href="links.slice(-1)[0].url ?? ''"
                                >Next &raquo;</Link
                            >
                        </li>
                    </ul>
                </nav>
            </div>
            <EditProvince
                v-if="editingProvince"
                :province="editingProvince"
                :openModal="editingProvinceTrigger"
                :close="closeEditProvinceModal"
            />
            <DeleteProvince
                v-if="deletingProvince"
                :province="deletingProvince"
                :openModal="deletingProvinceTrigger"
                :close="closeDeleteProvinceModal"
            />
        </template>
    </AuthenticatedLayout>
</template>
