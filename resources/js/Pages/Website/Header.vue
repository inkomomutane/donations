<script setup lang="ts">
import {currencyFormatter} from "../../helprs";
import Hero from "./Hero.vue";
import CampaignTotals from "@/Pages/Website/CampaignTotals.vue";
import Navbar from "./Navbar.vue";
defineProps({
    total_campaigns: Number,
    total_amount_raised: Number,
})

window.addEventListener('scroll', function () {

    if(document.getElementById("default-nav") && document.getElementById("default-section")){
        let navbar = document.getElementById("default-nav");
        let section = document.getElementById("default-section");
        let sticky = section?.offsetTop ?? 0;
        if (window.scrollY >= sticky) {
            navbar?.classList.add(
                "fixed", "top-0", "w-full", "z-50", "transition", "duration-500", "ease-in-out","bg-white"

            )
        } else {
            navbar?.classList.remove("fixed", "top-0", "w-full", "z-50", "transition", "duration-500", "ease-in-out","bg-white");
        }
    }
});
</script>

<template>
    <Navbar/>
    <Hero/>
    <CampaignTotals :total_campaigns="total_campaigns" :total_amount_raised="total_amount_raised"/>
</template>
