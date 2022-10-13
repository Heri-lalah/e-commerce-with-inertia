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
import useProduct from '@/Composables/Products';
import emitter from 'tiny-emitter/instance'
import { createToaster } from "@meforma/vue-toaster";

const productId = defineProps(['productId']);
const { add } = useProduct();
const toaster = createToaster({
    position : 'bottom',
    duration : 1000
});
const addToCart = async() => {
    await axios.get('/sanctum/csrf-cookie');
    await axios.get('/api/user')
    .then(async(res)=> {
        let cartCount = await add(productId);
        emitter.emit('cartCountUpdated', cartCount);
        toaster.success(`produit ajouté avec succés`);
    })

    .catch(async() => {
        toaster.error(`Merci de connecter pour ajouter un produit`);
    })
}
</script>
