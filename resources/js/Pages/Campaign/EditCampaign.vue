<script setup lang="ts">
import ImageUploader from "@components/ImageUploader.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm,Link } from "@inertiajs/vue3";
import { PropType } from "vue";
import { vMaska } from "maska";

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
    campaign: {
        type: Object as PropType<App.Data.CampaignData>,
        required: true,
    },
});

const form = useForm({
    title: props.campaign.title,
    description: props.campaign.description,
    content: props.campaign.content,
    goal_amount: props.campaign?.goalAmount,
    current_amount: props.campaign?.currentAmount,
    start_date: props.campaign?.startDate,
    end_date: props.campaign?.endDate,
    status: props.campaign?.status,
    priority: props.campaign?.priority,
    district_id: props.campaign?.district.id,
    cause_id: props.campaign?.cause.id,
    images: [],
});

const updateCampaign = () => {
    form.post(route("campaign.update", { campaign: props.campaign.id }));
};
const removeCampaign = () => {
    form.delete(route("campaign.destroy", { campaign: props.campaign.id }));
};
</script>

<template>
    <AuthenticatedLayout>
        <template v-slot:content>
            <div class="mx-auto px-16">
                <div class="flex  mb-5 justify-end">
                   <Link :href="route('campaign.transactions',{
                          campaign: campaign.id
                   })" class="flex items-center  text-sm  gap-2 bg-emerald-900 text-white font-black p-2 px-4 rounded hover:bg-emerald-700">
                       <svg class="w-6 h-6" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M39 6H9C7.34315 6 6 7.34315 6 9V39C6 40.6569 7.34315 42 9 42H39C40.6569 42 42 40.6569 42 39V9C42 7.34315 40.6569 6 39 6Z" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M21 31L26 35L34 25" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M14 15H34" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M14 23L22 23" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                       <span class="uppercase">
                        Transações
                    </span>
                   </Link>
                </div>
                 <div class="px-6 py-6 lg:p-14 bg-white">

                    <div class="flex flex-row justify-between">
                        <div class="basis-1/4">
                            <h3
                                class="mb-4 text-xl font-medium text-gray-900 dark:text-white"
                            >
                                Editar campanha
                            </h3>
                        </div>
                        <div
                            class="basis-1/4 grid grid-cols-2 gap-2 font-black font-['Roboto']"
                        >
                            <button
                                @click="updateCampaign"
                                class="w-full text-white bg-slate-700 hover:bg-slate-800 focus:ring-4 focus:outline-none focus:ring-slate-300 font-medium rounded text-sm px-5 py-2.5 text-center dark:bg-slate-600 dark:hover:bg-slate-700 dark:focus:ring-slate-800"
                            >
                                Actualizar
                            </button>
                            <button
                                @click="removeCampaign"
                                class="w-full text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-slate-300 font-medium rounded text-sm px-5 py-2.5 text-center dark:bg-slate-600 dark:hover:bg-slate-700 dark:focus:ring-slate-800"
                            >
                                Excluir
                            </button>
                        </div>
                    </div>
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
                            <span
                                class="text-medium text-red-500 font-semibold"
                                >{{ form.errors.title }}</span
                            >
                        </div>
                        <div class="col-span-2">
                            <ImageUploader
                                @update:images="
                                    (files: any) => (form.images = files)
                                "
                                :multiple="false"
                                :disabledUpload="true"
                                :disabledCancel="true"
                                mediaType="image/*,video/*"
                                labelText="Carregar media (Video,Imagem)"
                            />
                            <span
                                class="text-medium text-red-500 font-semibold"
                                >{{ form.errors.images }}</span
                            >

                            <div
                                v-if="campaign.media && form.images.length == 0"
                                class="rounded border border-dashed border-green-300 bg-green-100 dark:bg-green-800 flex flex-wrap p-0 my-4 gap-0 w-full"
                            >
                                <div class="flex items-center space-x-4 w-full">
                                    <div class="flex-shrink-0">
                                        <img
                                            v-if="
                                                campaign.media.type === 'image'
                                            "
                                            role="presentation"
                                            :src="campaign.media.url"
                                            width="100"
                                            height="50"
                                            class="shadow-2 h-16 object-cover"
                                        />
                                        <video
                                            v-else-if="
                                                campaign.media.type === 'video'
                                            "
                                            role="presentation"
                                            :src="campaign.media.url"
                                            controls
                                            width="100"
                                            height="50"
                                            class="shadow-2 h-16 object-cover"
                                        ></video>
                                    </div>
                                    <div class="flex-1 hidden sm:block sm:w-64">
                                        <p
                                            class="text-sm font-medium text-justify text-gray-900 truncate dark:text-white"
                                        >
                                            {{ campaign.title }}
                                        </p>
                                    </div>

                                    <div class="flex-1 w-12"></div>
                                    <div
                                        class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white px-8"
                                    >
                                        <div role="status">
                                            <svg
                                                class="fillCurrent text-green-500 dark:text-green-50"
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="24"
                                                height="24"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                            >
                                                <path
                                                    class="fill-green-400 dark:fill-green-50"
                                                    opacity="0.5"
                                                    d="M12.8956 13.4982L10.7949 11.2651C10.2697 10.7068 9.38251 10.7068 8.85731 11.2651C8.37559 11.7772 8.37559 12.5757 8.85731 13.0878L12.7499 17.2257C13.1448 17.6455 13.8118 17.6455 14.2066 17.2257L21.1427 9.85252C21.6244 9.34044 21.6244 8.54191 21.1427 8.02984C20.6175 7.47154 19.7303 7.47154 19.2051 8.02984L14.061 13.4982C13.7451 13.834 13.2115 13.834 12.8956 13.4982Z"
                                                />
                                                <path
                                                    class="fill-green-500 dark:fill-green-50"
                                                    d="M7.89557 13.4982L5.79487 11.2651C5.26967 10.7068 4.38251 10.7068 3.85731 11.2651C3.37559 11.7772 3.37559 12.5757 3.85731 13.0878L7.74989 17.2257C8.14476 17.6455 8.81176 17.6455 9.20663 17.2257L16.1427 9.85252C16.6244 9.34044 16.6244 8.54191 16.1427 8.02984C15.6175 7.47154 14.7303 7.47154 14.2051 8.02984L9.06096 13.4982C8.74506 13.834 8.21146 13.834 7.89557 13.4982Z"
                                                />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                        placeholder: 'Descrição da campanha',
                                    }"
                                ></quill-editor>
                            </div>
                            <span
                                class="text-medium text-red-500 font-semibold"
                                >{{ form.errors.description }}</span
                            >
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
                            <span
                                class="text-medium text-red-500 font-semibold"
                                >{{ form.errors.goal_amount }}</span
                            >
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
                            <span
                                class="text-medium text-red-500 font-semibold"
                                >{{ form.errors.current_amount }}</span
                            >
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
                            <span
                                class="text-medium text-red-500 font-semibold"
                                >{{ form.errors.start_date }}</span
                            >
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
                            <span
                                class="text-medium text-red-500 font-semibold"
                                >{{ form.errors.end_date }}</span
                            >
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
                            <span
                                class="text-medium text-red-500 font-semibold"
                                >{{ form.errors.status }}</span
                            >
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
                            <span
                                class="text-medium text-red-500 font-semibold"
                                >{{ form.errors.priority }}</span
                            >
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
                                :reduce="(e: any) => e.id"
                                placeholder="Causa da campanha"
                            ></v-select>
                            <span
                                class="text-medium text-red-500 font-semibold"
                                >{{ form.errors.cause_id }}</span
                            >
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
                                :reduce="(e: any) => e.id"
                                placeholder="Distrito"
                            ></v-select>
                            <span
                                class="text-medium text-red-500 font-semibold"
                                >{{ form.errors.district_id }}</span
                            >
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </AuthenticatedLayout>
</template>
