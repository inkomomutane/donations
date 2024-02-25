<script setup lang="ts">
import {Head, Link, useForm} from "@inertiajs/vue3";
import {defineProps, PropType, ref} from "vue";
import CampaignData = App.Data.CampaignData;
import Header from "@/Pages/Website/Header.vue";
import CampaignCard from "@components/CampaignCard.vue";
import Modal from "@components/Modal.vue";
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
}, 0);

const fireDonation = ref(false);
const campaignToDonate = ref<CampaignData | null>(null);
const openDonationModal = (campaign : CampaignData) => {
    fireDonation.value = true;
    campaignToDonate.value = campaign;
};

const closeDonationModal = () => {
    fireDonation.value = false;
};

const form = useForm({
    name: "",
    amount: 0,
    phone: null,
});

const makeADonation = () => {
    form.post(route("campaign.donate",{
        campaign: campaignToDonate?.value?.id ?? ''
    }), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            closeDonationModal();
        },
        onFinish: () => form.reset(),
    });
};
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
    <section class=" bg-slate-100 md:pt-8  ">
        <div class="max-w-screen-2xl mx-auto p-6 lg:p-8  sm:px-4 md:px-8 w-full space-y-8 ">
            <div>
                <div class="flex flex-row justify-center">
                    <h5 class=" bg-gradient-to-r from-teal-600 to-emerald-800 text-3xl rounded-md my-4 w-fit lg:rounded-tl-3xl lg:rounded-br-3xl font-['Black_Ravens'] tracking-widest font-light px-3 text-white">
                        — Campanhas de prioridade alta.
                    </h5>

                </div>
                <div
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-6 lg:gap-8 my-8"
                >
                    <CampaignCard @donate="openDonationModal(campaign)"  v-for="campaign in high_priority" :key="campaign.id" :campaign="campaign"/>
                </div>

                <div class="flex justify-end">
                    <a href="/" class="inline-flex items-center justify-center px-5 py-3 mr-3 text-center rounded-sm bg-gradient-to-r from-teal-600 to-emerald-600 font-black text-white font-['Lexend_Deca'] hover:bg-emerald-400 focus:ring-4 focus:ring-primary-300 aos-init aos-animate" data-aos="fade-down">
                        Ver todas campanhas
                        <svg class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></a>
                </div>
            </div>
        </div>
    </section>
    <section class=" bg-gradient-to-b from-slate-50 to-emerald-100 ">
        <div class="max-w-screen-2xl mx-auto p-6 lg:p-8  sm:px-4 md:px-8 w-full space-y-8 ">
            <div>
                <div class="flex flex-row justify-center">
                    <h5 class=" bg-gradient-to-r from-teal-600 to-emerald-800 text-3xl rounded-md my-4 w-fit lg:rounded-tl-3xl lg:rounded-br-3xl font-['Black_Ravens'] tracking-widest font-light px-3 text-white">
                        — Campanhas de prioridade média.
                    </h5>

                </div>
                <div
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-6 lg:gap-8 my-8"
                >
                    <CampaignCard @donate="openDonationModal(campaign)" v-for="campaign in medium_priority" :key="campaign.id" :campaign="campaign"/>
                </div>

                <div class="flex justify-end">
                    <a href="/" class="inline-flex items-center justify-center px-5 py-3 mr-3 text-center rounded-sm bg-gradient-to-r from-teal-600 to-emerald-600 font-black text-white font-['Lexend_Deca'] hover:bg-emerald-400 focus:ring-4 focus:ring-primary-300 aos-init aos-animate" data-aos="fade-down">
                        Ver todas campanhas
                        <svg class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></a>
                </div>
            </div>
        </div>
    </section>
    <section class=" bg-gradient-to-b from-emerald-50 to-slate-100 md:pt-8  ">
        <div class="max-w-screen-2xl mx-auto p-6 lg:p-8  sm:px-4 md:px-8 w-full space-y-8 ">
            <div>
                <div class="flex flex-row justify-center">
                    <h5 class=" bg-gradient-to-r from-teal-600 to-emerald-800 text-3xl rounded-md my-4 w-fit lg:rounded-tl-3xl lg:rounded-br-3xl font-['Black_Ravens'] tracking-widest font-light px-3 text-white">
                        — Campanhas de prioridade baixa.
                    </h5>

                </div>
                <div
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-6 lg:gap-8 my-8"
                >
                    <CampaignCard  @donate="openDonationModal(campaign)"  v-for="campaign in low_priority" :key="campaign.id" :campaign="campaign"/>
                </div>

                <div class="flex justify-end">
                    <a href="/" class="inline-flex items-center justify-center px-5 py-3 mr-3 text-center rounded-sm bg-gradient-to-r from-teal-600 to-emerald-600 font-black text-white font-['Lexend_Deca'] hover:bg-emerald-400 focus:ring-4 focus:ring-primary-300 aos-init aos-animate" data-aos="fade-down">
                        Ver todas campanhas
                        <svg class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></a>
                </div>
            </div>
        </div>
    </section>
    <div
        class="sm:flex sm:justify-center sm:items-center bg-dots-darker bg-center bg-emerald-950"
    >
        <div class="p-6 lg:p-8 max-w-screen-2xl">
            <div
                class="flex justify-center my-8 px-6 gap-x-4 sm:items-center sm:justify-between"
            >
                <div
                    class="text-center text-sm text-white dark:text-gray-400 sm:text-start"
                >
                    <div class="flex items-center gap-4">
                        <a
                            href="https://github.com/sponsors/taylorotwell"
                            class="group inline-flex gap-x-2 items-center hover:text-gray-700 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                        >
                            <svg class="w-8 h-8 fill-emerald-100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="M19.86 8.09c0 .15 0 .3-.01.44-1.53-.57-3.33-.22-4.53.86a4.43 4.43 0 00-2.98-1.14c-2.46 0-4.46 2.01-4.46 4.49 0 2.83 1.42 4.9 2.78 6.24-.11-.01-.2-.03-.28-.06C7.79 18.03 2 14.35 2 8.09 2 5.33 4.22 3.1 6.96 3.1c1.63 0 3.07.78 3.97 1.99A4.957 4.957 0 0114.9 3.1c2.74 0 4.96 2.23 4.96 4.99z" opacity=".4"></path>
                                <path d="M18 9.59c-1.07 0-2.04.52-2.64 1.32-.6-.8-1.56-1.32-2.64-1.32-1.82 0-3.3 1.48-3.3 3.32 0 .71.11 1.36.31 1.96.94 2.97 3.83 4.74 5.26 5.23.2.07.53.07.74 0 1.43-.49 4.32-2.26 5.26-5.23.2-.61.31-1.26.31-1.96 0-1.84-1.48-3.32-3.3-3.32z"></path>
                            </svg>

                        </a>
                    </div>
                </div>

                <div
                    class="ms-4 text-center text-sm text-white dark:text-gray-400 sm:text-end sm:ms-0"
                >
                    Copyright © <strong class="font-black font-['Lexend_Deca']"> {{ appName }}</strong> |  {{ new Date().getFullYear() }}.  Todos os direitos reservados.
                </div>
            </div>
        </div>
    </div>



    <Modal :show="fireDonation" @close="closeDonationModal">
        <div class="relative bg-white rounded shadow dark:bg-gray-700">
            <button
                type="button"
                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-emerald-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                @click="closeDonationModal"
            >
                <svg
                    aria-hidden="true"
                    class="w-5 h-5"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"
                    ></path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <h3
                    class="mb-4 text-xl font-medium text-emerald-900 dark:text-white"
                >
                   Fazer uma doação para: <br>
                    <span class="text-emerald-900 dark:text-white font-bold font-['Lexend_Deca']">{{ campaignToDonate?.title }}</span>
                </h3>
                <div class="space-y-6">
                    <div>
                        <label
                            for="name"
                            class="block mb-2 text-sm font-medium text-emerald-900 dark:text-white"
                        >Nome (anónimo)</label
                        >
                        <input
                            type="text"
                            name="name"
                            v-model="form.name"
                            id="name"
                            class="bg-gray-50 border border-gray-300 text-emerald-900 text-sm rounded focus:ring-emerald-500 focus:border-slate-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            placeholder="Nome do doador (opcional)"
                        />
                        <span class="text-medium text-red-500 font-semibold">{{
                                form.errors.name
                            }}</span>
                    </div>
                    <div>
                        <label
                            for="name"
                            class="block mb-2 text-sm font-medium text-emerald-900 dark:text-white"
                        >Contacto (MPESA)</label
                        >
                        <input
                            type="text"
                            name="name"
                            v-model="form.phone"
                            id="name"
                            class="bg-gray-50 border border-gray-300 text-emerald-900 text-sm rounded focus:ring-emerald-500 focus:border-slate-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            placeholder="Contacto (MPESA)"
                        />
                        <span class="text-medium text-red-500 font-semibold">{{
                                form.errors.phone
                            }}</span>
                    </div>
                    <div>
                        <label
                            for="amount"
                            class="block mb-2 text-sm font-medium text-emerald-900 dark:text-white"
                        >Valor a doar</label
                        >
                        <input
                            type="text"
                            name="name"
                            v-model="form.amount"
                            id="name"
                            class="bg-gray-50 border border-gray-300 text-emerald-900 text-sm rounded focus:ring-emerald-500 focus:border-slate-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            placeholder="Valor a doar"
                        />
                        <span class="text-medium text-red-500 font-semibold">{{
                                form.errors.amount
                            }}</span>
                    </div>


                    <button
                       @click="makeADonation()"
                        class="w-full text-white bg-emerald-700 hover:bg-emerald-800 focus:ring-4 focus:outline-none focus:ring-slate-300 font-medium rounded text-sm px-5 py-2.5 text-center dark:bg-slate-600 dark:hover:bg-slate-700 dark:focus:ring-slate-800"
                    >
                        Finalizar doação
                    </button>
                </div>
            </div>
        </div>
    </Modal>
</template>
