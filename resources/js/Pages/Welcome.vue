<script setup>
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import AppLayout from '@/Layouts/AppLayout.vue'
    import ProductList from '@/Pages/Products/ProductList.vue'
    defineProps({
        canLogin: Boolean,
        canRegister: Boolean,
        laravelVersion: String,
        phpVersion: String,
        products : {
            type : Object
        }
    });
</script>

<template>
    <Head title="Welcome" />
    <AppLayout>
        <div class="relative flex items-top justify-center min-h-screen bg-white-100 dark:bg-white-900 sm:items-center sm:pt-0">
            <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                <!-- <Link v-if="$page.props.user" :href="route('dashboard')" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</Link> -->

                <template v-if="!$page.props.user">
                    <Link :href="route('login')" class="text-sm text-gray-100 dark:text-gray-100 bg-indigo-500 text-white py-2 px-4 rounded">Log in</Link>

                    <Link v-if="canRegister" :href="route('register')" class="ml-4 text-sm text-gray-100 dark:text-gray-100 bg-indigo-500 text-white py-2 px-4 rounded">Register</Link>
                </template>
            </div>
            <div class="my-2">
              <ProductList :products="products"  />
            </div>
        </div>
    </AppLayout>
</template>
