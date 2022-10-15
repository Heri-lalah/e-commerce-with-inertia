<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Header from '@/Layouts/partials/Header.vue';
import { onMounted, ref, reactive } from 'vue';
import useProduct from '@/Composables/Products';
import DeleteCartConfirmation from '@/Components/DeleteCartConfirmation.vue';

import emitter from 'tiny-emitter/instance'



const {
        products,
        getCartContent,
        formated_price,
        increaseQuantity,
        decreaseQuantity,
        destroyProduct,
        getCount,
        getOrderTotal,
    } = useProduct();
const cartList = ref(0);
const cartTotal =ref(0);
const tva = ref(0);
const cartTotalTtc = ref(0)

const props = defineProps({
    filter : Object,
    dafault : () => ({})
});

//const cartCount=ref(0)
emitter.on('quantityUpdated', (count)=> count = 1);

onMounted(async() => {
    cartList.value = await getCartContent();
    let response = await getOrderTotal()
    cartTotal.value = response.cartTotal;
    tva.value = response.tva;
    cartTotalTtc.value = response.cartTotalTtc;
});


const decrease = async(id) => {
    await decreaseQuantity(id);
    emitter.emit('cartCountUpdated', await getCount());
    cartList.value = await getCartContent();
    let response = await getOrderTotal()
    cartTotal.value = response.cartTotal;
    tva.value = response.tva;
    cartTotalTtc.value = response.cartTotalTtc;
}

const increase = async(id) => {
    await increaseQuantity(id)
    emitter.emit('cartCountUpdated', await getCount());
    cartList.value = await getCartContent();
    let response = await getOrderTotal()
    cartTotal.value = response.cartTotal;
    tva.value = response.tva;
    cartTotalTtc.value = response.cartTotalTtc;
}

const destroy = async(id) => {
    await destroyProduct(id)
    cartList.value = await getCartContent();
    let response = await getOrderTotal()
    cartTotal.value = response.cartTotal;
    tva.value = response.tva;
    cartTotalTtc.value = response.cartTotalTtc;
}

</script>
<template>
 <AppLayout title="ShoppingCart">
    <Header>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Récapitulatif de votre panier
            </h2>
        </template>
    </Header>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex justify-center">
                    <div class="flex flex-col w-full p-8 text-gray-800 bg-white pin-r pin-y md:w-4/5 lg:w-4/5">
                        <div class="flex-1">
                            <table class="w-full text-sm lg:text-base" cellspacing="0">
                                <thead>
                                    <tr class="h-12 uppercase">
                                        <th class="hidden md:table-cell"></th>
                                        <th class="text-left">Produit</th>
                                        <th class="text-center">
                                            <span class="lg:hidden" title="Quantity">Qté</span>
                                            <span class="hidden lg:inline">Quantité</span>
                                        </th>
                                        <th class="hidden text-right md:table-cell">Prix U.</th>
                                        <th class="text-center md:text-right">
                                            <span class="lg:hidden" title="prixHT">Prix HT</span>
                                            <span class="hidden lg:inline">Prix total H.T</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="product in cartList" :key="product.id">
                                        <td class="hidden pb-4 md:table-cell">
                                            <a href="#">
                                                <img :src="product.attributes.image" class="w-20 rounded" :alt="(product.name).substring(0,10)">
                                            </a>
                                        </td>
                                        <td class="w-60">
                                            <a href="#">
                                                <p class="mb-2 md:ml-4" >{{product.name}}</p>
                                                <button @click.prevent="destroy(product.id)" class="text-gray-700 md:ml-4 text-red-500">
                                                    <small><i class="fa fa-trash text-xl px-2"></i>supprimer</small>
                                                </button>
                                            </a>
                                        </td>
                                        <td class="justify-center  md:flex mt-6">
                                            <div class="sm:w-20 md:w-40 lg:w-50 h-10 sm:text-right">
                                                <div class="relative flex flex-row w-full h-8">
                                                    <button @click.prevent="decrease(product.id)"><i class="fa fa-minus text-xs rounded-full lg:mx-2 text-white p-1 bg-red-500"></i></button>
                                                    <input readonly :value="product.quantity" class="w-full font-semibold text-center text-gray-700 bg-gray-200 outline-none focus:outline-none hover:text-black focus:text-black" />
                                                    <button @click.prevent="increase(product.id)"><i class="fa fa-plus text-xs rounded-full lg:mx-2 text-white p-1 bg-green-500"></i></button>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="hidden text-right md:table-cell">
                                            <span class="text-sm lg:text-base font-medium">
                                                {{ formated_price(product.price) }}
                                            </span>
                                        </td>
                                        <td class="text-right">
                                            <span class="text-sm lg:text-base font-medium">
                                                {{ formated_price(product.price * product.quantity) }}
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr class="pb-6 mt-6">
                            <div class="my-4 mt-6 -mx-2 lg:flex">
                                <div class="lg:px-2 lg:w-1/2">
                                </div>
                                <div class="lg:px-2 lg:w-1/2">
                                    <div class="p-4 bg-gray-100 rounded-full">
                                        <h1 class="ml-2 font-bold uppercase">Order Details</h1>
                                    </div>
                                    <div class="p-4">
                                        <div class="flex justify-between border-b">
                                            <div class="lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-center text-gray-800">
                                                Total
                                            </div>
                                            <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900">
                                                {{formated_price(cartTotal)}}
                                            </div>
                                        </div>
                                        <div class="flex justify-between pt-4 border-b">
                                            <div class="lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-center text-gray-800">
                                                Tax
                                            </div>
                                            <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900">
                                                {{formated_price(tva)}}
                                            </div>
                                        </div>
                                        <div class="flex justify-between pt-4 border-b">
                                            <div class="lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-center text-gray-800">
                                                Total
                                            </div>
                                            <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900">
                                                {{formated_price(cartTotalTtc)}}
                                            </div>
                                        </div>
                                        <a href="#">
                                            <button class="flex justify-center w-full px-10 py-3 mt-6 font-medium text-white uppercase bg-gray-800 rounded-full shadow item-center hover:bg-gray-700 focus:shadow-outline focus:outline-none">
                                                <svg aria-hidden="true" data-prefix="far" data-icon="credit-card" class="w-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M527.9 32H48.1C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48.1 48h479.8c26.6 0 48.1-21.5 48.1-48V80c0-26.5-21.5-48-48.1-48zM54.1 80h467.8c3.3 0 6 2.7 6 6v42H48.1V86c0-3.3 2.7-6 6-6zm467.8 352H54.1c-3.3 0-6-2.7-6-6V256h479.8v170c0 3.3-2.7 6-6 6zM192 332v40c0 6.6-5.4 12-12 12h-72c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h72c6.6 0 12 5.4 12 12zm192 0v40c0 6.6-5.4 12-12 12H236c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h136c6.6 0 12 5.4 12 12z"/></svg>
                                                <span class="ml-2 mt-5px">Procceed to checkout</span>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </AppLayout>
</template>
