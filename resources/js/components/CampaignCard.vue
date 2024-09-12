<script setup lang="ts">
import Header from "@/Pages/Website/Header.vue";
import { PropType } from "vue";
import { currencyFormatter, numberMoneyFormat } from "@/helprs";

defineProps({
    campaign: {
        type: Object as PropType<App.Data.CampaignData>,
        required: true,
    },
});

const emit = defineEmits(["donate"]);
const emitDonateEvent = () => {
    emit("donate");
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
    <article
        class="!w-full rounded-3xl rounded-b-xl bg-white dark:bg-gray-700 dark:border-gray-700 transition-transform duration-300 transform-gpu hover:scale-105 hover:shadow-none hover:shadow-gray-400"
    >
        <a
            :href="
                route('campaign.view', {
                    campaign: campaign.id,
                })
            "
        >
            <header class="rounded-t-xl">
                <img
                    v-if="!campaign.media?.type"
                    class="col-span-1 sm:col-span-3 h-72 sm:h-40 md:h-64 object-cover rounded-t-xl w-full"
                    src="https://placehold.co/600x400"
                    alt=""
                />
                <img
                    v-else-if="campaign.media.type === 'image'"
                    class="col-span-1 sm:col-span-3 h-72 sm:h-40 md:h-64 object-cover rounded-t-xl w-full"
                    :src="campaign.media.url"
                    alt=""
                />
                <video
                    v-else-if="campaign.media.type === 'video'"
                    class="col-span-1 sm:col-span-3 h-72 sm:h-40 md:h-64 object-cover rounded-t-xl w-full"
                    :src="campaign.media.url"
                    controls
                ></video>
            </header>
        </a>

        <div
            class="w-full p-4 pb-5 text-emerald-950 grid justify-items-stretch col-span-3"
        >
            <div class="flex justify-between">
                <h1
                    class="text-lg font-['Lexend_Deca'] font-semibold line-clamp-1 py-1 first-letter:uppercase"
                >
                    {{ campaign.title }}
                </h1>
            </div>
            <div
                class="w-full bg-emerald-100 rounded-full h-2.5 mb-2 dark:bg-gray-700 inline-flex items-center"
            >
                <div
                    class="bg-green-600 h-2.5 rounded-full rounded-r-none dark:bg-green-500"
                    :style="`width: ${percentageOfGoal(
                        campaign.goalAmount,
                        campaign.currentAmount,
                    )}`"
                ></div>

                <div class="rounded-full p-2 w-1 -ml-1 bg-green-300"></div>
            </div>
            <div class="grid grid-cols-2 gap-2 my-2">
                <div>
                    <div
                        class="flex items-center justify-start text-center font-['Roboto'] font-medium rounded-sm gap-x-1"
                    >
                        <strong class="font-black text-green-500"
                            >Arrecadado:&nbsp;
                        </strong>
                        <span class="text-lg">
                            {{ numberMoneyFormat(campaign.currentAmount ?? 0) }}
                        </span>
                    </div>
                    <div
                        class="flex items-center justify-start text-center font-['Roboto'] font-medium rounded-sm gap-x-1"
                    >
                        <strong class="font-black text-red-500"
                            >Meta:&nbsp;
                        </strong>
                        <span class="text-lg">
                            {{ numberMoneyFormat(campaign.goalAmount ?? 0) }}
                        </span>
                    </div>

                </div>
                <div
                    class="flex items-center justify-end font-bold font-['Lexend_Deca'] text-emerald-900 text-3xl pr-4"
                >
                    {{
                        percentageOfGoal(
                            campaign.goalAmount,
                            campaign.currentAmount,
                        )
                    }}
                </div>
                <div class="col-span-2 inline-flex items-center justify-start text-center font-['Roboto'] font-medium rounded-sm gap-x-3">
                    <a :href="`https://twitter.com/share?text=${route('campaign.view', {campaign: campaign.id})}`" class="bg-emerald-50 p-2 hover:text-black hover:bg-black/10 duration-100  hover:scale-105">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" role="img" viewBox="0 0 24 24" fill="currentColor"><title>X</title><path d="M18.901 1.153h3.68l-8.04 9.19L24 22.846h-7.406l-5.8-7.584-6.638 7.584H.474l8.6-9.83L0 1.154h7.594l5.243 6.932ZM17.61 20.644h2.039L6.486 3.24H4.298Z"></path></svg>
                    </a>
                    <a :href="`https://www.facebook.com/sharer/sharer.php?u=${route('campaign.view', {campaign: campaign.id})}`" class="bg-emerald-50 p-2 hover:text-blue-600 hover:bg-blue-100 duration-100  hover:scale-105">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill="currentColor" fill-rule="evenodd" d="M18.8961111,0 L1.10388889,0 C0.494166667,0 0,0.494166667 0,1.10388889 L0,18.8963889 C0,19.5058333 0.494166667,20 1.10388889,20 L10.6825,20 L10.6825,12.255 L8.07611111,12.255 L8.07611111,9.23666667 L10.6825,9.23666667 L10.6825,7.01055556 C10.6825,4.42722222 12.2602778,3.02083333 14.5647222,3.02083333 C15.6686111,3.02083333 16.6172222,3.10277778 16.8938889,3.13972222 L16.8938889,5.83944444 L15.2955556,5.84027778 C14.0422222,5.84027778 13.7997222,6.43583333 13.7997222,7.30972222 L13.7997222,9.23694444 L16.7886111,9.23694444 L16.3994444,12.2552778 L13.7997222,12.2552778 L13.7997222,20 L18.8963889,20 C19.5058333,20 20,19.5058333 20,18.8961111 L20,1.10388889 C20,0.494166667 19.5058333,0 18.8961111,0 L18.8961111,0 Z"></path></svg>
                    </a>
                    <a :href="`https://wa.me/?text=${route('campaign.view', {campaign: campaign.id})}`"  class="bg-emerald-50 p-2 hover:text-green-600 hover:bg-green-100 duration-100  hover:scale-105">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M12.001 2C17.5238 2 22.001 6.47715 22.001 12C22.001 17.5228 17.5238 22 12.001 22C10.1671 22 8.44851 21.5064 6.97086 20.6447L2.00516 22L3.35712 17.0315C2.49494 15.5536 2.00098 13.8345 2.00098 12C2.00098 6.47715 6.47813 2 12.001 2ZM8.59339 7.30019L8.39232 7.30833C8.26293 7.31742 8.13607 7.34902 8.02057 7.40811C7.93392 7.45244 7.85348 7.51651 7.72709 7.63586C7.60774 7.74855 7.53857 7.84697 7.46569 7.94186C7.09599 8.4232 6.89729 9.01405 6.90098 9.62098C6.90299 10.1116 7.03043 10.5884 7.23169 11.0336C7.63982 11.9364 8.31288 12.8908 9.20194 13.7759C9.4155 13.9885 9.62473 14.2034 9.85034 14.402C10.9538 15.3736 12.2688 16.0742 13.6907 16.4482C13.6907 16.4482 14.2507 16.5342 14.2589 16.5347C14.4444 16.5447 14.6296 16.5313 14.8153 16.5218C15.1066 16.5068 15.391 16.428 15.6484 16.2909C15.8139 16.2028 15.8922 16.159 16.0311 16.0714C16.0311 16.0714 16.0737 16.0426 16.1559 15.9814C16.2909 15.8808 16.3743 15.81 16.4866 15.6934C16.5694 15.6074 16.6406 15.5058 16.6956 15.3913C16.7738 15.2281 16.8525 14.9166 16.8838 14.6579C16.9077 14.4603 16.9005 14.3523 16.8979 14.2854C16.8936 14.1778 16.8047 14.0671 16.7073 14.0201L16.1258 13.7587C16.1258 13.7587 15.2563 13.3803 14.7245 13.1377C14.6691 13.1124 14.6085 13.1007 14.5476 13.097C14.4142 13.0888 14.2647 13.1236 14.1696 13.2238C14.1646 13.2218 14.0984 13.279 13.3749 14.1555C13.335 14.2032 13.2415 14.3069 13.0798 14.2972C13.0554 14.2955 13.0311 14.292 13.0074 14.2858C12.9419 14.2685 12.8781 14.2457 12.8157 14.2193C12.692 14.1668 12.6486 14.1469 12.5641 14.1105C11.9868 13.8583 11.457 13.5209 10.9887 13.108C10.8631 12.9974 10.7463 12.8783 10.6259 12.7616C10.2057 12.3543 9.86169 11.9211 9.60577 11.4938C9.5918 11.4705 9.57027 11.4368 9.54708 11.3991C9.50521 11.331 9.45903 11.25 9.44455 11.1944C9.40738 11.0473 9.50599 10.9291 9.50599 10.9291C9.50599 10.9291 9.74939 10.663 9.86248 10.5183C9.97128 10.379 10.0652 10.2428 10.125 10.1457C10.2428 9.95633 10.2801 9.76062 10.2182 9.60963C9.93764 8.92565 9.64818 8.24536 9.34986 7.56894C9.29098 7.43545 9.11585 7.33846 8.95659 7.32007C8.90265 7.31384 8.84875 7.30758 8.79459 7.30402C8.66053 7.29748 8.5262 7.29892 8.39232 7.30833L8.59339 7.30019Z"></path></svg>
                    </a>
                </div>
            </div>
            <button
                @click="emitDonateEvent"
                class="mt-2 p-1.5 bg-emerald-800 hover:bg-emerald-700 text-white text-sm rounded inline-flex items-center font-['Lexend_Deca'] justify-center gap-x-2 font-black"
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
                Fazer uma doação
            </button>
        </div>
    </article>
</template>
