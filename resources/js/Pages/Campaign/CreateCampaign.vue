<script setup lang="ts">
import Modal from "@/components/Modal.vue";
import ImageUploader from "@components/ImageUploader.vue";
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";

import { vMaska } from "maska"

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
    }
})

const addCampaign = ref(false);
const titleInput = ref();
const addCampaignTrigger = () => {
    addCampaign.value = true;
};

const closeCreateCampaignModal = () => {
    addCampaign.value = false;
};

const form = useForm({
    title: "",
    description: "",
    content: "",
    goal_amount : null,
    current_amount : null,
    start_date : new Date(),
    end_date : null,
    status: 'ACTIVA',
    priority:'MEDIA',
    district_id : null,
    cause_id :null,
    images: []
});

const createCampaign = () => {
    form.post(route("campaign.store"), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            closeCreateCampaignModal();
        },
        onError: () => titleInput.value.focus(),
    });
};
</script>
<template>
    <button
        type="button"
        @click="addCampaignTrigger"
        class="flex items-center justify-center text-white bg-slate-700 hover:bg-slate-800 focus:ring-4 focus:ring-slate-300 font-medium rounded text-sm px-4 py-2 dark:bg-slate-600 dark:hover:bg-slate-700 focus:outline-none dark:focus:ring-slate-800"
    >
        <svg
            class="w-5 h-5"
            fill="currentColor"
            xmlns="http://www.w3.org/2000/svg"
            id="mdi-charity"
            viewBox="0 0 24 24"
        >
            <path
                d="M12.75,3.94C13.75,3.22 14.91,2.86 16.22,2.86C16.94,2.86 17.73,3.05 18.59,3.45C19.45,3.84 20.13,4.3 20.63,4.83C21.66,6.11 22.09,7.6 21.94,9.3C21.78,11 21.22,12.33 20.25,13.27L12.66,20.86C12.47,21.05 12.23,21.14 11.95,21.14C11.67,21.14 11.44,21.05 11.25,20.86C11.06,20.67 10.97,20.44 10.97,20.16C10.97,19.88 11.06,19.64 11.25,19.45L15.84,14.86C16.09,14.64 16.09,14.41 15.84,14.16C15.59,13.91 15.36,13.91 15.14,14.16L10.55,18.75C10.36,18.94 10.13,19.03 9.84,19.03C9.56,19.03 9.33,18.94 9.14,18.75C8.95,18.56 8.86,18.33 8.86,18.05C8.86,17.77 8.95,17.53 9.14,17.34L13.73,12.75C14,12.5 14,12.25 13.73,12C13.5,11.75 13.28,11.75 13.03,12L8.44,16.64C8.25,16.83 8,16.92 7.73,16.92C7.45,16.92 7.21,16.83 7,16.64C6.8,16.45 6.7,16.22 6.7,15.94C6.7,15.66 6.81,15.41 7.03,15.19L11.63,10.59C11.88,10.34 11.88,10.11 11.63,9.89C11.38,9.67 11.14,9.67 10.92,9.89L6.28,14.5C6.06,14.7 5.83,14.81 5.58,14.81C5.3,14.81 5.06,14.71 4.88,14.5C4.69,14.3 4.59,14.06 4.59,13.78C4.59,13.5 4.69,13.27 4.88,13.08C7.94,10 9.83,8.14 10.55,7.45L14.11,10.97C14.5,11.34 14.95,11.53 15.5,11.53C16.2,11.53 16.75,11.25 17.16,10.69C17.44,10.28 17.54,9.83 17.46,9.33C17.38,8.83 17.17,8.41 16.83,8.06L12.75,3.94M14.81,10.27L10.55,6L3.47,13.08C2.63,12.23 2.15,10.93 2.04,9.16C1.93,7.4 2.41,5.87 3.47,4.59C4.66,3.41 6.08,2.81 7.73,2.81C9.39,2.81 10.8,3.41 11.95,4.59L16.22,8.86C16.41,9.05 16.5,9.28 16.5,9.56C16.5,9.84 16.41,10.08 16.22,10.27C16.03,10.45 15.8,10.55 15.5,10.55C15.23,10.55 15,10.45 14.81,10.27V10.27Z"
            ></path>
        </svg>
        <span class="mx-4">Nova campanha</span>
    </button>

    <Modal max-width="4xl" :show="addCampaign" @close="closeCreateCampaignModal" >
        <div class="relative bg-white rounded shadow dark:bg-gray-700">
            <button
                type="button"
                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                @click="closeCreateCampaignModal"
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
                    class="mb-4 text-xl font-medium text-gray-900 dark:text-white"
                >
                    Nova campanha
                </h3>
                <div class="grid grid-cols-2 gap-6 gap-y-4">
                    <div class="col-span-2">
                        <label
                            for="name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Título da campanha</label
                        >
                        <input
                            type="text"
                            name="name"
                            v-model="form.title"
                            ref="titleInput"
                            id="title"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-slate-500 focus:border-slate-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            placeholder="Nome da campanha"
                        />
                        <span class="text-medium text-red-500 font-semibold">{{form.errors.title}}</span>
                    </div>
                    <div class="col-span-2">
                        <ImageUploader
                            @update:images="(files : any) => form.images = files"
                            :multiple="false"
                            :disabledUpload="true"
                            :disabledCancel="true"
                            mediaType="image/*,video/*"
                            labelText="Carregar media (Video,Imagem)"
                        />
                        <span class="text-medium text-red-500 font-semibold">{{form.errors.images}}</span>
                    </div>
                    <div class="col-span-2">
                        <label
                            for="name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Descrição da campanha</label
                        >
                        <div class="grow">
                            <quill-editor
                                contentType="html"
                                toolbar="minimal"
                                v-model:content="form.description"
                                theme="snow"
                                :options="{
                                placeholder : 'Descrição da campanha'
                            }"
                            ></quill-editor>
                        </div>
                        <span class="text-medium text-red-500 font-semibold">{{form.errors.description}}</span>
                    </div>
                    <div>
                        <label
                            for="name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Meta da campanha</label
                        >
                        <input
                            type="number"
                            name="goal_amount"
                            v-model="form.goal_amount"
                            v-maska
                            data-maska="0.99"
                            data-maska-tokens="0:\d:multiple|9:\d:optional"
                            ref="goalAmountInput"
                            id="goal_amount"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-slate-500 focus:border-slate-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            placeholder="Meta da campanha"
                        />
                        <span class="text-medium text-red-500 font-semibold">{{form.errors.goal_amount}}</span>
                    </div>
                    <div>
                        <label
                            for="name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Valor corrente</label
                        >
                        <input
                            type="number"
                            name="current_amount"
                            v-model="form.current_amount"
                            v-maska
                            data-maska="0.99"
                            data-maska-tokens="0:\d:multiple|9:\d:optional"

                            id="current_amount"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-slate-500 focus:border-slate-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            placeholder="Valor corrente"
                        />
                        <span class="text-medium text-red-500 font-semibold">{{form.errors.current_amount}}</span>
                    </div>
                    <div>
                        <label
                            for="name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Data de início</label
                        >
                        <VueDatePicker
                            :min-date="new Date()"
                            v-model="form.start_date"
                            :enable-time-picker="false"
                            auto-apply
                            :teleport="true"
                            format="dd/MM/yyyy"
                            :text-input="{
                                format: 'dd.MM.yyyy',
                            }"
                            class="relative"
                            placeholder="Data de início"
                        />
                        <span class="text-medium text-red-500 font-semibold">{{form.errors.start_date}}</span>
                    </div>
                    <div>
                        <label
                            for="name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Data do término</label
                        >
                        <VueDatePicker
                            :min-date="new Date()"
                            v-model="form.end_date"
                            :enable-time-picker="false"
                            auto-apply
                            :teleport="true"
                            format="dd/MM/yyyy"
                            :text-input="{
                                format: 'dd.MM.yyyy',
                            }"
                            class="relative"
                            placeholder="Data do término"
                        />
                        <span class="text-medium text-red-500 font-semibold">{{form.errors.end_date}}</span>
                    </div>
                    <div>
                        <label
                            for="name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Estado da campanha</label
                        >
                        <v-select
                            v-model="form.status"

                            :options="statuses"
                            placeholder="Estado da campanha"
                        ></v-select>
                        <span class="text-medium text-red-500 font-semibold">{{form.errors.status}}</span>
                    </div>
                    <div>
                        <label
                            for="priority"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Prioridade da campanha</label
                        >
                        <v-select
                            v-model="form.priority"

                            :options="priorities"
                            placeholder="Prioridade da campanha"
                        ></v-select>
                        <span class="text-medium text-red-500 font-semibold">{{form.errors.priority}}</span>
                    </div>
                    <div>
                        <label
                            for="cause"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Causa da campanha</label
                        >
                        <v-select
                            v-model="form.cause_id"
                            label="title"
                            :options="causes"
                            :reduce="(e) => e.id"
                            placeholder="Causa da campanha"
                        ></v-select>
                        <span class="text-medium text-red-500 font-semibold">{{form.errors.cause_id}}</span>
                    </div>
                    <div>
                        <label
                            for="priority"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Distrito</label
                        >
                        <v-select
                            v-model="form.district_id"
                            label="name"
                            :options="districts"
                            :reduce="(e) => e.id"
                            placeholder="Distrito"
                        ></v-select>
                        <span class="text-medium text-red-500 font-semibold">{{form.errors.district_id}}</span>
                    </div>


                    <button
                        @click="createCampaign"
                        class="col-span-2 w-full text-white bg-slate-700 hover:bg-slate-800 focus:ring-4 focus:outline-none focus:ring-slate-300 font-medium rounded text-sm px-5 py-2.5 text-center dark:bg-slate-600 dark:hover:bg-slate-700 dark:focus:ring-slate-800"
                    >
                        Salvar
                    </button>
                </div>
            </div>
        </div>
    </Modal>
</template>
