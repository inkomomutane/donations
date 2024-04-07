<template>
    <img :src="logo" alt="Logo" :class="className" />
</template>
<script lang="ts" setup>
import logo from "@images/logo.png";
defineProps({
    className:{
        type: String,
        default: "w-10 h-auto fill-emerald-100"
    }
});
</script>
