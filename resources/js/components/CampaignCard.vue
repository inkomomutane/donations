<script setup lang="ts">
import Header from "@/Pages/Website/Header.vue";
import {PropType} from "vue";
import {Link} from "@inertiajs/vue3";
import {currencyFormatter, numberMoneyFormat} from "@/helprs";

defineProps({
    campaign : {
        type: Object as PropType<App.Data.CampaignData>,
        required: true
    }
})



const emit = defineEmits(['donate']);
const emitDonateEvent = () => {
    emit('donate');
};

const percentageOfGoal  = (goal : number|null, current : number|null ) => {
    if(!current ) return '0%';
    goal =  goal ??  0 ;
   let percentage =  ((current * 100)/goal);
    percentage = (percentage > 100) ? 100 : percentage ;
   return `${Number(percentage).toFixed(0)}%`;
}



</script>

<template>
    <article
        class="!w-full rounded-3xl rounded-b-xl bg-white dark:bg-gray-700 dark:border-gray-700 transition-transform duration-300 transform-gpu hover:scale-105 hover:shadow-none hover:shadow-gray-400"
    >
        <Link :href="route('campaign.view',{
            campaign: campaign.id
        })">
        <header class="rounded-t-xl">
            <img
                v-if="!campaign.media?.type"
                class="col-span-1 sm:col-span-3 h-72 sm:h-40 md:h-64 object-cover rounded-t-xl w-full"
                src="https://placehold.co/600x400"
             alt=""/>
            <img
                v-else-if="campaign.media.type === 'image'"
                class="col-span-1 sm:col-span-3 h-72 sm:h-40 md:h-64 object-cover rounded-t-xl w-full"
                :src="campaign.media.url"
             alt=""/>
            <video
                v-else-if="campaign.media.type === 'video'"
                class="col-span-1 sm:col-span-3 h-72 sm:h-40 md:h-64 object-cover rounded-t-xl w-full"
                :src="campaign.media.url"
                controls
            ></video>
        </header>
        </Link>

        <div
            class="w-full p-4 pb-5 text-emerald-950 grid justify-items-stretch col-span-3"
        >
            <div class="flex justify-between">
                <h1
                    class="text-lg font-['Lexend_Deca'] font-semibold line-clamp-1 py-1  first-letter:uppercase"
                >
                    {{ campaign.title }}
                </h1>
            </div>
            <div class="w-full bg-emerald-100 rounded-full h-2.5 mb-2 dark:bg-gray-700 inline-flex items-center">
                <div class="bg-green-600 h-2.5 rounded-full rounded-r-none dark:bg-green-500  " :style="`width: ${percentageOfGoal(campaign.goalAmount ,campaign.currentAmount )}`" ></div>

                <div class="rounded-full p-2 w-1 -ml-1 bg-green-300  "></div>
            </div>
            <div class="grid grid-cols-2 gap-2 my-2 ">
                <div>
                    <div
                        class="flex items-center justify-start text-center font-['Roboto'] font-medium   rounded-sm  gap-x-1 "
                    >
                        <strong class="font-black text-green-500"
                        >Arrecadado:&nbsp;
                        </strong>
                        <span class="text-lg">
                        {{


                            numberMoneyFormat(campaign.currentAmount ?? 0)
                        }}
                        </span>
                    </div>
                    <div
                        class="flex items-center justify-start text-center font-['Roboto'] font-medium   rounded-sm  gap-x-1 "
                    >
                        <strong class="font-black text-red-500"
                        >Meta:&nbsp;
                        </strong>
                        <span class="text-lg">
                            {{
                                numberMoneyFormat(campaign.goalAmount ?? 0)
                            }}
                        </span>
                    </div>
                </div>
                <div class="flex items-center justify-end font-bold font-['Lexend_Deca'] text-emerald-900 text-3xl pr-4 ">
                    {{ percentageOfGoal(campaign.goalAmount ,campaign.currentAmount ) }}
                </div>
            </div>
            <button @click="emitDonateEvent" class="mt-2 p-1.5 bg-emerald-800 hover:bg-emerald-700 text-white text-sm rounded inline-flex items-center font-['Lexend_Deca']  justify-center gap-x-2 font-black ">
                <svg class="w-8 h-8 fill-emerald-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M19.86 8.09c0 .15 0 .3-.01.44-1.53-.57-3.33-.22-4.53.86a4.43 4.43 0 00-2.98-1.14c-2.46 0-4.46 2.01-4.46 4.49 0 2.83 1.42 4.9 2.78 6.24-.11-.01-.2-.03-.28-.06C7.79 18.03 2 14.35 2 8.09 2 5.33 4.22 3.1 6.96 3.1c1.63 0 3.07.78 3.97 1.99A4.957 4.957 0 0114.9 3.1c2.74 0 4.96 2.23 4.96 4.99z" opacity=".4"></path><path d="M18 9.59c-1.07 0-2.04.52-2.64 1.32-.6-.8-1.56-1.32-2.64-1.32-1.82 0-3.3 1.48-3.3 3.32 0 .71.11 1.36.31 1.96.94 2.97 3.83 4.74 5.26 5.23.2.07.53.07.74 0 1.43-.49 4.32-2.26 5.26-5.23.2-.61.31-1.26.31-1.96 0-1.84-1.48-3.32-3.3-3.32z"></path></svg>
                Fazer uma doação </button>
        </div>
    </article>
</template>
