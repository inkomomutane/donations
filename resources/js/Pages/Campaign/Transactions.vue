<script setup lang="ts">
import {PropType, ref, watch} from "vue";
import CampaignData = App.Data.CampaignData;
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Link} from "@inertiajs/vue3";
import TransactionData = App.Data.TransactionData;
import {currencyFormatter, numberMoneyFormat} from "../../helprs";


const props = defineProps({
    campaign:{
        type: Object as PropType<CampaignData>,
        required: true
    },
    search: String,
})
const searchTerm = ref("");
const transactions = ref(props.campaign.transactions);

watch(searchTerm, (value) => {
    transactions.value = props.campaign.transactions.filter((transaction : TransactionData ) => {
       return (transaction.name.toLowerCase().includes(value.toLowerCase())
         || transaction.transactionId.toLowerCase().includes(value.toLowerCase())
            || transaction.paymentMethod.toLowerCase().includes(value.toLowerCase())
       );
    });
});

const downloadExcelTransactions = () => {
    window.open(route('campaign.download', {campaign: props.campaign.id}));
}

</script>

<template>
    <AuthenticatedLayout>
        <template v-slot:content>
            <div class="mx-auto max-w-screen-xl">
                <!-- Start coding here -->
                <div
                    class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded overflow-hidden"
                >
                    <div
                        class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4"
                    >
                        <div class="w-full md:w-1/2">
                            <form class="flex items-center">
                                <label for="simple-search" class="sr-only"
                                >Pesquisar</label
                                >
                                <div class="relative w-full">
                                    <div
                                        class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"
                                    >
                                        <svg
                                            aria-hidden="true"
                                            class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                            fill="currentColor"
                                            viewbox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                    </div>
                                    <input
                                        type="text"
                                        id="simple-search"
                                        v-model="searchTerm"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-slate-500 focus:border-slate-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-slate-500 dark:focus:border-slate-500"
                                        placeholder="Pesquisar..."
                                    />
                                </div>
                            </form>
                        </div>
                        <div
                            class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0"
                        >
                            <button @click="downloadExcelTransactions" class="bg-slate-600 p-2 px-4 text-white rounded">
                                <span>Baixar</span>
                            </button>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table
                            class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
                        >
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                            >
                            <tr>
                                <th scope="col" class="px-4 py-3">
                                    <div class="flex items-center">Transação</div>
                                </th>
                                <th scope="col" class="px-4 py-3">
                                    <div class="flex items-center">
                                        Nome do dador/doador
                                    </div>
                                </th>
                                <th scope="col" class="px-4 py-3">
                                    <div class="flex items-center">
                                       Metodo de pagamento
                                    </div>
                                </th>
                                <th scope="col" class="px-4 py-3">
                                    Montante
                                </th>
                                <th scope="col" class="px-4 py-3">
                                    Data
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr
                                class="border-b dark:border-gray-700"
                                v-for="(transaction, index) in transactions"
                                :key="transaction.id ?? index"
                            >
                                <th
                                    scope="row"
                                    class="px-4 py-3 font-black text-gray-600 whitespace-nowrap  dark:text-white uppercase"
                                >
                                    {{ transaction.transactionId }}
                                </th>

                                <td class="px-4 py-3">
                                    {{ transaction.name }}
                                </td>

                                <td class="px-4 py-3">
                                   <span class="bg-blue-600 px-3 p-1 text-white font-black">
                                        {{ transaction.paymentMethod }}
                                   </span>
                                </td>
                                <td class="px-4 py-3">
                                    {{ currencyFormatter(transaction.amount) }}
                                </td>
                                <td class="px-4 py-3 uppercase font-bold">
                                    {{ transaction.createdAt }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </template>
    </AuthenticatedLayout>
</template>
