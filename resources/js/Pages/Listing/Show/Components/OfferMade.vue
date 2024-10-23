<template>
    <Box>
        <template #header>Offer Made</template>

        <Price :price="props.offer.amount" class="text-3xl" />

        <section class="mt-2 flex flex-col md:flex-row justify-between text-gray-500">
            <div>Offer Made</div>
            <div class="font-medium"> {{ offerMadeOn }} </div>
        </section>
    </Box>
</template>

<script setup lang="ts">
import { computed } from 'vue';
import Price from '@/Components/Price.vue';
import Box from '@/Components/UI/Box.vue';

const props = defineProps({
    offer: Object
})

const offerMadeOn = computed(
    () => new Date(props.offer.created_at).toDateString(),
)
</script>