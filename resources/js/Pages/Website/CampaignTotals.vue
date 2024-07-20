<script setup lang="ts">
import { currencyFormatter } from "@/helprs";
defineProps({
    total_campaigns: Number,
    total_amount_raised: Number,
});
</script>

<template>
    <div id="default-section" class="bg-emerald-950 py-5 block">
        <div class="max-w-screen-xl mx-auto">
            <div
                class="grid grid-cols-3 justify-between items-center font-['Lexend_Deca']"
            >
                <div class="flex flex-col items-center space-x-2">
                    <h2
                        class="text-base md:text-xl text-yellow-200 font-black"
                    >
                        {{ total_campaigns }}
                    </h2>
                    <div
                        class="flex text-xs md:text-base text-center text-white font-yellow-100 max-w-[15rem] font-light mt-3"
                    >
                        Beneficiários ajudados a partir de campanhas realizadas.
                    </div>
                </div>
                <div class="flex flex-col items-center space-x-2">
                    <h2
                        class="text-base md:text-xl text-yellow-200 font-black"
                    >
                        {{ total_campaigns }}
                    </h2>
                    <div
                        class="flex text-xs md:text-base text-center text-white font-yellow-100 max-w-[15rem] font-light mt-3"
                    >
                        Campanhas realizadas com sucesso.
                    </div>
                </div>
                <div class="flex flex-col items-center space-x-2">
                    <h2
                        class="text-base md:text-xl text-yellow-200 font-black"
                    >
                        {{ currencyFormatter(total_amount_raised ?? 0, "MZN") }}
                    </h2>
                    <div
                        class="flex text-xs md:text-base text-center text-white font-yellow-100 max-w-[15rem] font-light mt-3"
                    >
                        Arrecadados nas campanhas realizadas.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
