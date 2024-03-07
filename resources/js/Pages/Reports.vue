<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head} from "@inertiajs/vue3";
import { PropType,  watch} from "vue";
import { FlasherResponse } from "@flasher/flasher";
import Flasher, {numberMoneyFormat} from "@/helprs";
import dashboardCard from '@images/nepano.jpg'

const props = defineProps({
    messages: Object as PropType<FlasherResponse>,
    causesCount: Number,
    campaignsCount: Number,
    totalRaised: Number,
    totalToRaise: Number,
    activeCampaigns: Number,

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
</script>

<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
        <template v-slot:content>
            <div class="mx-auto">
                <!-- Start coding here 0 -->
                <div class="grid grid-cols-1 sm:grid-cols-2  xl:grid-cols-3 2xl:grid-cols-4 gap-6">
                    <!-- Start Card List -->
                    <div class="relative w-full h-52 bg-cover bg-center group rounded-lg overflow-hidden mt-4 shadow-lg transition duration-300 ease-in-out"
                         :style="`background-image: url(${dashboardCard});`">
                        <div class="absolute inset-0 bg-black bg-opacity-50 transition duration-300 ease-in-out"></div>
                        <div class="relative w-full h-full px-4 sm:px-6 lg:px-4 flex items-center">
                            <div class="px-4 font-['Anta']">
                                <div class="text-white flex space-x-2 items-center">
                                    <div class="bg-white rounded-md p-2 flex items-center">

                                    </div>
                                    <h1 class="text-2xl">Total arrecadado</h1>
                                </div>
                                <h3 class="text-white text-4xl mt-2 font-bold">
                                    {{ numberMoneyFormat(totalRaised ?? 0) + ' MZN' }}
                                </h3>

                            </div>
                        </div>
                    </div>
                    <div class="relative w-full h-52 bg-cover bg-center group rounded-lg overflow-hidden mt-4 shadow-lg transition duration-300 ease-in-out"
                         :style="`background-image: url(${dashboardCard});`">
                        <div class="absolute inset-0 bg-black bg-opacity-50 transition duration-300 ease-in-out"></div>
                        <div class="relative w-full h-full px-4 sm:px-6 lg:px-4 flex items-center">
                            <div class="px-4 font-['Anta']">
                                <div class="text-white flex space-x-2 items-center">
                                    <div class="bg-white rounded-md p-2 flex items-center">
                                    </div>
                                    <h1 class="text-2xl">Por arrecadar</h1>
                                </div>
                                <h3 class="text-white text-4xl mt-2 font-bold">
                                   {{ numberMoneyFormat(totalToRaise ?? 0) + ' MZN' }}
                                </h3>

                            </div>
                        </div>
                    </div>
                    <div class="relative w-full h-52 bg-cover bg-center group rounded-lg overflow-hidden mt-4 shadow-lg transition duration-300 ease-in-out"
                         :style="`background-image: url(${dashboardCard});`">
                        <div class="absolute inset-0 bg-black bg-opacity-50 transition duration-300 ease-in-out"></div>
                        <div class="relative w-full h-full px-4 sm:px-6 lg:px-4 flex items-center">
                            <div class="px-4 font-['Anta']">
                                <div class="text-white flex space-x-2 items-center">
                                    <div class="bg-white rounded-md p-2 flex items-center">

                                    </div>
                                    <h1 class="text-2xl">Campanhas Activas</h1>
                                </div>
                                <h3 class="text-white text-4xl mt-2 font-bold">
                                    {{ activeCampaigns }}
                                </h3>

                            </div>
                        </div>
                    </div>
                    <div class="relative w-full h-52 bg-cover bg-center group rounded-lg overflow-hidden mt-4 shadow-lg transition duration-300 ease-in-out"
                         :style="`background-image: url(${dashboardCard});`">
                        <div class="absolute inset-0 bg-black bg-opacity-50 transition duration-300 ease-in-out"></div>
                        <div class="relative w-full h-full px-4 sm:px-6 lg:px-4 flex items-center">
                            <div class="px-4 font-['Anta']">
                                <div class="text-white flex space-x-2 items-center">
                                    <div class="bg-white rounded-md p-2 flex items-center">

                                    </div>
                                    <h1 class="text-2xl">Total de campanhas</h1>
                                </div>
                                <h3 class="text-white text-4xl mt-2 font-bold">
                                    {{ campaignsCount }}
                                </h3>

                            </div>
                        </div>
                    </div>
                    <div class="relative w-full h-52 bg-cover bg-center group rounded-lg overflow-hidden mt-4 shadow-lg transition duration-300 ease-in-out"
                         :style="`background-image: url(${dashboardCard});`">
                        <div class="absolute inset-0 bg-black bg-opacity-50 transition duration-300 ease-in-out"></div>
                        <div class="relative w-full h-full px-4 sm:px-6 lg:px-4 flex items-center">
                            <div class="px-4 font-['Anta']">
                                <div class="text-white flex space-x-2 items-center">
                                    <div class="bg-white rounded-md p-2 flex items-center">

                                    </div>
                                    <h1 class="text-2xl">Causas abraçadas</h1>
                                </div>
                                <h3 class="text-white text-4xl mt-2 font-bold">
                                   {{causesCount}}
                                </h3>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </template>
    </AuthenticatedLayout>
</template>
