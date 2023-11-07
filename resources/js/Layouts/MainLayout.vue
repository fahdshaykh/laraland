<template>
    <Link href="/listing ">Listing page</Link> &nbsp;
    <Link href="/listing/create">New Listing</Link>
    <!-- <div>The page with time {{ timer }}</div> -->
    <div v-if="flashSuccess" class="success">
        {{ flashSuccess }}
    </div>
    <slot></slot>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const page = usePage();
const flashSuccess = computed(() => page.props.flash.success)

// console.log(page.props);
// const x = ref(0);
// const y = computed(() => x.value + 2)
// setInterval(() => timer.value++, 1000);
</script>

<style scoped>
.success {
    background-color: green;
    color: white;
}
</style>