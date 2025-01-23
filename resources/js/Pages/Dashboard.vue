<script setup lang="ts">
import AuthenticatedLayout from '@/Pages/AuthenticatedLayout.vue';
import { Head,Link } from '@inertiajs/vue3';
import { defineProps, Ref, ref, watch } from "vue";

const props = defineProps<{
  rules: string[];
}>();



</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout :rules="rules">
        <p>Coucou</p>
    </AuthenticatedLayout>

   
</template>
