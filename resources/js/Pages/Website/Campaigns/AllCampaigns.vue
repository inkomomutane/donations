<script setup lang="ts">
import { Head, Link, router, useForm } from "@inertiajs/vue3";
import { defineProps, PropType, ref, watch } from "vue";
import CampaignData = App.Data.CampaignData;
import CampaignCard from "@components/CampaignCard.vue";
import Modal from "@components/Modal.vue";
import { FlasherResponse } from "@flasher/flasher";
import Flasher from "@/helprs";
import Footer from "@/Pages/Website/Footer.vue";
import Navbar from "@/Pages/Website/Navbar.vue";
import CampaignCardpreloader from "@components/CampaignCardpreloader.vue";
const props = defineProps({
    campaigns: Object,
    causes: Array<App.Data.CauseData>,
    messages: Object as PropType<FlasherResponse>,
    search: String,
});

setTimeout(() => {
    const preloader = document.getElementById("preloader");
    if (preloader) {
        preloader.style.display = "none";
    }
}, 0);

const fireDonation = ref(false);
const campaignToDonate = ref<CampaignData | null>(null);
const openDonationModal = (campaign: CampaignData) => {
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
    form.post(
        route("campaign.donate", {
            campaign: campaignToDonate?.value?.id ?? "",
        }),
        {
            preserveScroll: true,
            onSuccess: () => {
                form.reset();
                closeDonationModal();
            },
            onFinish: () => form.reset(),
        },
    );
};
watch(
    () => props.messages,
    (value) => {
        value?.envelopes.forEach((element: any) => {
            Flasher.flash(
                element.notification.type,
                element.notification.message,
            );
        });
    },
);

const links = ref(props.campaigns.links);
watch(
    () => props.campaigns.links,
    (value) => {
        links.value = value;
    },
);

window.addEventListener("scroll", function () {
    if (
        document.getElementById("default-nav") &&
        document.getElementById("default-section")
    ) {
        let navbar = document.getElementById("default-nav");
        let section = document.getElementById("default-section");
        let sticky = section?.offsetTop ?? 0;
        if (window.scrollY >= sticky) {
            navbar?.classList.add(
                "fixed",
                "top-0",
                "w-full",
                "z-50",
                "transition",
                "duration-500",
                "ease-in-out",
                "bg-white",
                "shadow-2xl",
                "shadow-emerald-50",
            );
        } else {
            navbar?.classList.remove(
                "fixed",
                "top-0",
                "w-full",
                "z-50",
                "transition",
                "duration-500",
                "ease-in-out",
                "bg-white",
                "shadow-2xl",
                "shadow-emerald-50",
            );
        }
    }
});

const campaignSearch = ref(props.search ?? "");
const searchProgress = ref(false);
watch(
    () => campaignSearch,
    (value) => {
        router.visit(
            route("web.campaigns", {
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
    <Head title="Campanhas" />
    <Navbar className="sticky top-0  z-10" />
    <div class="bg-emerald-950 py-2 block">
        <div class="max-w-screen-2xl px-8 md:mx-auto overflow-x-autor">
            <ul
                class="inline-flex -mb-px text-white font-['Lato'] items-center overflow-scroll overflow-x-scroll"
            >
                <li class="me-2" v-for="cause in causes">
                    <Link
                        :href="
                            route('web.campaigns', {
                                cause: cause.id,
                            })
                        "
                        class="inline-block p-2 rounded px-4 font-['Anta']"
                        :class="{
                            'bg-emerald-900 font-black ': route().current(
                                'web.campaigns',
                                { cause: cause.id },
                            ),
                            'hover:bg-emerald-900': !route().current(
                                'web.campaigns',
                                { cause: cause.id },
                            ),
                        }"
                    >
                        {{ cause.title }}
                    </Link>
                </li>
            </ul>
        </div>
    </div>

    <section
        id="default-section"
        class="bg-gradient-to-b from-emerald-50 via-gary-200 to-emerald-100 md:pt-8 min-h-[50vh]"
    >
        <div
            class="max-w-screen-2xl mx-auto p-6 lg:p-8 sm:px-4 md:px-8 w-full space-y-8"
        >
            <div class="w-full">
                <input
                    name="campaign"
                    type="text"
                    v-model="campaignSearch"
                    class="h-14 w-full pr-8 pl-5 rounded z-0 focus:outline-none shadow-2xl bg-emerald-50 border-2 border-emerald-900 text-emerald-900 focus:ring-2 focus:ring-emerald-600 focus:border-transparent"
                    placeholder="Pesquisar campanha..."
                />
            </div>
            <div>
                <div
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-6 lg:gap-8 my-8"
                >
                    <CampaignCard
                        @donate="openDonationModal(campaign)"
                        v-for="campaign in campaigns.data"
                        :key="campaign.id"
                        :campaign="campaign"
                    />
                </div>
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
                    <li v-for="link in links.slice(1, -1)" :key="link.label">
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
    </section>
    <Footer />
    <Modal :show="fireDonation" @close="closeDonationModal">
        <div class="relative bg-white rounded shadow dark:bg-emerald-700">
            <button
                type="button"
                class="absolute top-3 right-2.5 text-emerald-400 bg-transparent hover:bg-emerald-200 hover:text-emerald-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-emerald-800 dark:hover:text-white"
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
                    Fazer uma doação para: <br />
                    <span
                        class="text-emerald-900 dark:text-white font-bold font-['Lexend_Deca']"
                        >{{ campaignToDonate?.title }}</span
                    >
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
                            class="bg-emerald-50 border border-emerald-300 text-emerald-900 text-sm rounded focus:ring-emerald-500 focus:border-slate-500 block w-full p-2.5 dark:bg-emerald-600 dark:border-emerald-500 dark:placeholder-emerald-400 dark:text-white"
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
                            class="bg-emerald-50 border border-emerald-300 text-emerald-900 text-sm rounded focus:ring-emerald-500 focus:border-slate-500 block w-full p-2.5 dark:bg-emerald-600 dark:border-emerald-500 dark:placeholder-emerald-400 dark:text-white"
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
                            class="bg-emerald-50 border border-emerald-300 text-emerald-900 text-sm rounded focus:ring-emerald-500 focus:border-slate-500 block w-full p-2.5 dark:bg-emerald-600 dark:border-emerald-500 dark:placeholder-emerald-400 dark:text-white"
                            placeholder="Valor a doar"
                        />
                        <span class="text-medium text-red-500 font-semibold">{{
                            form.errors.amount
                        }}</span>
                    </div>

                    <button
                        @click="makeADonation()"
                        :disabled="form.processing"
                        class="flex items-center gap-x-4 justify-center font-['Lexend_Deca'] font-bold w-full text-white bg-emerald-700 hover:bg-emerald-800 focus:ring-4 focus:outline-none focus:ring-slate-300 rounded text-sm px-5 py-2.5 text-center dark:bg-slate-600 dark:hover:bg-slate-700 dark:focus:ring-slate-800"
                        :class="{
                            'bg-emerald-950  hover:bg-emerald-950 cursor-not-allowed text-emerald-800':
                                form.processing,
                        }"
                    >
                        <div v-if="form.processing" role="status">
                            <svg
                                aria-hidden="true"
                                class="inline w-5 h-5 text-emerald-50 animate-spin fill-green-500"
                                viewBox="0 0 100 101"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor"
                                />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill"
                                />
                            </svg>
                            <span class="sr-only">Loading...</span>
                        </div>
                        Finalizar doação
                    </button>
                </div>
            </div>
        </div>
    </Modal>
</template>
