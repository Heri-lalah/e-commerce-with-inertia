<template>
    <div class="bg-white px-16 py-14 rounded-md text-center">
        <h1 class="text-xl mb-4 font-bold text-slate-500">Do you Want Delete</h1>
        <button class="bg-red-500 px-4 py-2 rounded-md text-md text-white">Cancle</button>
        <button class="bg-indigo-500 px-7 py-2 ml-2 rounded-md text-md text-white font-semibold">Ok</button>
    </div>
</template>
<script setup>
    const none = defineProps(['class']);
</script>