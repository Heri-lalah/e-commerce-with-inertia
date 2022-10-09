<script setup>
    import AppLayout from '../../Layouts/AppLayout.vue';
    import Header from '@/Layouts/partials/Header.vue';
    import ProductList from '@/Pages/Products/ProductList.vue'
    const props = defineProps({
        products : {
            type : Object,
            required : true
        }
    })
</script>

<template>
  <AppLayout title="Products">
    <Header>
        <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Liste des produits
                </h2>
        </template>
    </Header>

    <div class="py-2">
      <ProductList :products="props.products"/>
    </div>
  </AppLayout>
</template>