<script setup>
    import useProduct from '@/Composables/Products';
    import { onMounted, ref } from 'vue';
    const { getCount } = useProduct();
    import emitter from 'tiny-emitter/instance'
    emitter.on('cartCountUpdated', (count) => cartCount.value = count)

    const cartCount=ref(0)
    onMounted(async() => {
        cartCount.value = await getCount();
    });
</script>
<template>
    <div class="relative space-x-8 sm:ml-10 sm:flex mr-10">
        <i class="fa fa-cart-plus text-2xl"></i>
        <span class="absolute -top-2 -left-5 text-white bg-red-500 text-center rounded-full w-5 h-5 text-2xl text-light-100 flex justify-center items-center">
            <span class="text-xs">{{cartCount}}</span>
        </span>
    </div>
</template>
