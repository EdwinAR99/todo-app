<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Calendar from './Calendar.vue';
</script>

<template>
    <div>
        <div class="p-6 lg:p-8 bg-white border-b border-gray-200 flex items-center">
    <ApplicationLogo class="block h-12 w-auto" />
    <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-4">
        Calendario
    </h2>
</div>

        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1">
            <Calendar />
        </div>
    </div>
</template>
