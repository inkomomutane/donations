<script setup lang="ts">
import Navbar from "@/Pages/Website/Navbar.vue";
import { camelize, computed, PropType, ref, watch } from "vue";
import CampaignData = App.Data.CampaignData;
import { Head, useForm } from "@inertiajs/vue3";
import Modal from "@components/Modal.vue";
import Flasher, { numberMoneyFormat } from "@/helprs";
import { FlasherResponse } from "@flasher/flasher";
import CampaignComment = App.Data.CampaignComment;
const props = defineProps({
    campaign: {
        type: Object as PropType<CampaignData>,
        required: true,
    },
    messages: Object as PropType<FlasherResponse>,
});
const appName = import.meta.env.VITE_APP_NAME;
const fireDonation = ref(false);
const campaignToDonate = ref<CampaignData | null>(null);
const openDonationModal = (campaign: CampaignData) => {
    fireDonation.value = true;
    campaignToDonate.value = campaign;
};

const countComments = computed(() => {
    return props.campaign.comments?.length ?? 0;
});
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

const formComment = useForm({
    name: "",
    comment: "",
});

const comment = () => {
    formComment.post(
        route("campaign.comment", {
            campaign: props.campaign.id ?? "",
        }),
        {
            preserveScroll: true,
            onSuccess: () => {
                formComment.reset();
            },
            onFinish: () => formComment.reset(),
        },
    );
};
const percentageOfGoal = (goal: number | null, current: number | null) => {
    if (!current) return "0%";
    goal = goal ?? 0;
    let percentage = (current * 100) / goal;
    percentage = percentage > 100 ? 100 : percentage;
    return `${Number(percentage).toFixed(0)}%`;
};
</script>
<template>
    <Head :title="campaign?.title ?? ''" />
    <Navbar className="sticky top-0 bg-white " />
    <section
        class="bg-gradient-to-b from-emerald-50/10 via-emerald-100 to-gray-100"
    >
        <div class="max-w-screen-lg mx-auto p-4 md:p-8 xl:p-16 h-full">
            <main
                class="dark:bg-gray-900 antialiased mx-auto shadow-2xl shadow-emerald-100"
                :class="{
                    'bg-emerald-200': campaign.status === 'COMPLETA',
                    'bg-white': campaign.status === 'ACTIVA',
                    'bg-red-100': campaign.status === 'SUSPENSA',
                    'bg-blue-100': campaign.status === 'PENDENTE',
                }"
            >
                <div class="flex justify-between mx-auto max-w-screen-xl">
                    <article
                        class="mx-auto w-full format format-sm sm:format-base lg:format-lg format-blue dark:format-invert"
                    >
                        <figure>
                            <img
                                v-if="!campaign.media?.type"
                                class="object-cover rounded-t-xl w-full max-h-[22rem] lg:max-h-[26rem] xl:max-h-[30rem]"
                                src="https://placehold.co/600x400"
                                alt=""
                            />
                            <img
                                v-else-if="campaign.media.type === 'image'"
                                class="object-cover rounded-t-xl w-full max-h-[22rem] lg:max-h-[26rem] xl:max-h-[30rem]"
                                :src="campaign.media.url"
                                alt=""
                            />
                            <video
                                v-else-if="campaign.media.type === 'video'"
                                class="object-cover rounded-t-xl w-full max-h-[22rem] lg:max-h-[26rem] xl:max-h-[30rem]"
                                :src="campaign.media.url"
                                controls
                            ></video>
                            <div
                                class="w-full bg-emerald-100 h-2.5 dark:bg-gray-700 flex items-center"
                            >
                                <div
                                    class="bg-green-600 h-2.5 rounded-r-none dark:bg-green-500"
                                    :style="`width: ${percentageOfGoal(
                                        campaign.goalAmount,
                                        campaign.currentAmount,
                                    )}`"
                                ></div>

                                <div
                                    class="rounded-full p-2 w-1 -ml-1 bg-green-300"
                                ></div>
                            </div>
                        </figure>

                        <div class="p-12 flex flex-col">
                            <header
                                class="not-format flex justify-between gap-x-4"
                            >
                                <div>
                                    <h1
                                        class="mb-4 text-xl font-extrabold font-['Lexend_Deca'] leading-tight text-emerald-900 lg:mb-6 lg:text-2xl dark:text-white"
                                    >
                                        {{ campaign?.title }}
                                    </h1>
                                </div>

                                <div>
                                    <button
                                        v-if="campaign.status !== 'COMPLETA'"
                                        @click="openDonationModal(campaign)"
                                        class="m-t p-1.5 px-3 h-fit !w-fit bg-emerald-800 hover:bg-emerald-700 text-white text-sm rounded inline-flex items-center font-['Lexend_Deca'] justify-center gap-x-2 font-black"
                                    >
                                        <svg
                                            class="w-8 h-8 fill-emerald-50"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24"
                                            fill="currentColor"
                                            aria-hidden="true"
                                        >
                                            <path
                                                d="M19.86 8.09c0 .15 0 .3-.01.44-1.53-.57-3.33-.22-4.53.86a4.43 4.43 0 00-2.98-1.14c-2.46 0-4.46 2.01-4.46 4.49 0 2.83 1.42 4.9 2.78 6.24-.11-.01-.2-.03-.28-.06C7.79 18.03 2 14.35 2 8.09 2 5.33 4.22 3.1 6.96 3.1c1.63 0 3.07.78 3.97 1.99A4.957 4.957 0 0114.9 3.1c2.74 0 4.96 2.23 4.96 4.99z"
                                                opacity=".4"
                                            ></path>
                                            <path
                                                d="M18 9.59c-1.07 0-2.04.52-2.64 1.32-.6-.8-1.56-1.32-2.64-1.32-1.82 0-3.3 1.48-3.3 3.32 0 .71.11 1.36.31 1.96.94 2.97 3.83 4.74 5.26 5.23.2.07.53.07.74 0 1.43-.49 4.32-2.26 5.26-5.23.2-.61.31-1.26.31-1.96 0-1.84-1.48-3.32-3.3-3.32z"
                                            ></path>
                                        </svg>
                                        Doar
                                    </button>
                                </div>
                            </header>
                            <div class="flex flex-auto gap-x-6 mb-4">
                                <span
                                    class="bg-gray-500 text-white font-['Lexend_Deca'] p-1 font-black py-1.5 rounded-sm px-3"
                                >
                                    <span class="font-normal text-emerald-50"
                                        >Causa</span
                                    >: {{ campaign.cause.title }}
                                </span>
                                <span
                                    class="bg-blue-600 text-white font-['Lexend_Deca'] p-1 font-black py-1.5 rounded-sm px-3"
                                >
                                    <span class="font-normal text-emerald-50"
                                        >Meta</span
                                    >:
                                    {{ numberMoneyFormat(campaign.goalAmount) }}
                                </span>
                                <span
                                    class="bg-green-500 text-white font-['Lexend_Deca'] p-1 font-black py-1.5 rounded-sm px-3"
                                >
                                    <span class="font-normal text-emerald-50"
                                        >Arrecadado</span
                                    >:
                                    {{
                                        numberMoneyFormat(
                                            campaign.currentAmount ?? 0,
                                        )
                                    }}
                                </span>
                            </div>
                            <div
                                class="prose !max-w-full"
                                v-html="campaign?.description"
                            ></div>
                            <section class="not-format my-5">
                                <div
                                    class="flex justify-between items-center mb-6"
                                >
                                    <h2
                                        class="text-lg lg:text-xl font-bold font-['Lexend_Deca'] text-emerald-900 dark:text-white"
                                    >
                                        Comentários : {{ countComments }}
                                    </h2>
                                </div>
                                <div class="mb-2 flex flex-col space-y-4">
                                    <div>
                                        <label for="name" class="sr-only"
                                            >Teu nome</label
                                        >
                                        <input
                                            id="name"
                                            v-model="formComment.name"
                                            class="py-2 px-4 mb-1 bg-white rounded-lg rounded-t-lg border-2 border-emerald-800 focus:border-0 ring-emerald-900 focus:ring focus:ring-emerald-900"
                                            placeholder="Teu nome"
                                        />
                                    </div>
                                    <div
                                        class="py-2 px-4 mb-1 bg-white rounded-lg rounded-t-lg border ring ring-emerald-900 border-emerald-200 flex flex-col"
                                    >
                                        <label for="comment" class="sr-only"
                                            >Teu comentário</label
                                        >
                                        <textarea
                                            id="comment"
                                            rows="6"
                                            v-model="formComment.comment"
                                            class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0"
                                            placeholder="Comentar.."
                                            required
                                        ></textarea>
                                    </div>
                                    <button
                                        type="button"
                                        @click="comment"
                                        class="inline-flex self-end items-center py-2.5 px-4 my-3 text-xs font-medium text-center text-white bg-emerald-700 rounded focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-emerald-800"
                                    >
                                        Enviar comentário
                                    </button>
                                </div>
                                <article
                                    v-for="(
                                        comment, index
                                    ) in campaign.comments as CampaignComment[]"
                                    :key="index"
                                    class="p-6 mb-4 text-base bg-white border-t border-gray-200 dark:border-gray-700 dark:bg-gray-900"
                                >
                                    <footer
                                        class="flex justify-between items-center mb-2"
                                    >
                                        <div class="flex items-center">
                                            <p
                                                class="inline-flex items-center mr-3 font-semibold font-['Lexend_Deca'] text-sm text-emerald-900 dark:text-white"
                                            >
                                                <img
                                                    class="mr-2 w-6 h-6 rounded-full"
                                                    src="https://placehold.co/100x100"
                                                    alt="Bonnie Green"
                                                />{{ comment.name }}
                                            </p>
                                            <p
                                                class="text-sm text-gray-600 dark:text-gray-400"
                                            >
                                                <time
                                                    pubdate
                                                    datetime="2022-03-12"
                                                    title="March 12th, 2022"
                                                    >{{
                                                        comment.createdAt
                                                    }}</time
                                                >
                                            </p>
                                        </div>
                                    </footer>
                                    <p>
                                        {{ comment.comment }}
                                    </p>
                                </article>
                            </section>
                        </div>
                    </article>
                </div>
            </main>
        </div>
    </section>
    <div
        class="sm:flex sm:justify-center sm:items-center bg-dots-darker bg-center bg-emerald-950"
    >
        <div class="p-6 lg:p-8 max-w-screen-xl">
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
                            <svg
                                class="w-8 h-8 fill-emerald-100"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="currentColor"
                                aria-hidden="true"
                            >
                                <path
                                    d="M19.86 8.09c0 .15 0 .3-.01.44-1.53-.57-3.33-.22-4.53.86a4.43 4.43 0 00-2.98-1.14c-2.46 0-4.46 2.01-4.46 4.49 0 2.83 1.42 4.9 2.78 6.24-.11-.01-.2-.03-.28-.06C7.79 18.03 2 14.35 2 8.09 2 5.33 4.22 3.1 6.96 3.1c1.63 0 3.07.78 3.97 1.99A4.957 4.957 0 0114.9 3.1c2.74 0 4.96 2.23 4.96 4.99z"
                                    opacity=".4"
                                ></path>
                                <path
                                    d="M18 9.59c-1.07 0-2.04.52-2.64 1.32-.6-.8-1.56-1.32-2.64-1.32-1.82 0-3.3 1.48-3.3 3.32 0 .71.11 1.36.31 1.96.94 2.97 3.83 4.74 5.26 5.23.2.07.53.07.74 0 1.43-.49 4.32-2.26 5.26-5.23.2-.61.31-1.26.31-1.96 0-1.84-1.48-3.32-3.3-3.32z"
                                ></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <div
                    class="ms-4 text-center text-sm text-white dark:text-gray-400 sm:text-end sm:ms-0"
                >
                    Copyright ©
                    <strong class="font-black font-['Lexend_Deca']">
                        {{ appName }}</strong
                    >
                    | {{ new Date().getFullYear() }}. Todos os direitos
                    reservados.
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
                        :disabled="form.processing"
                        class="flex items-center gap-x-4 justify-center font-['Lexend_Deca'] font-bold w-full text-white bg-emerald-700 hover:bg-emerald-800 focus:ring-4 focus:outline-none focus:ring-slate-300 rounded text-sm px-5 py-2.5 text-center dark:bg-slate-600 dark:hover:bg-slate-700 dark:focus:ring-slate-800"
                        :class="{
                            'bg-gray-950  hover:bg-gray-950 cursor-not-allowed text-emerald-800':
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
