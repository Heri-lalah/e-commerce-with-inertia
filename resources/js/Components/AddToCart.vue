<template>
    <div>
        <div class="flex items-center justify-between py-4">
            <button
                class="bg-indigo-500 text-white p-2 rounded"
                @click.prevent="addToCart"
            >
            Ajouter au panier
            </button>
        </div>
    </div>
</template>
    
<script setup>
import { Inertia } from '@inertiajs/inertia';

const addToCart = async() => {
    await axios.get('/sanctum/csrf-cookie');
    await axios.get('/api/user')
    .catch(err => console.log(err))
}
</script>
    