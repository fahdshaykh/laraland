<template>
    <div v-for="listing in listings" :key="listing.id">
        <Link :href="route('listing.show', listing.id)">
            <div>
                <ListingAddress :listing="listing" />
            </div>
            <div>
                <Link :href="route('listing.edit', {listing: listing.id})">Edit</Link>
            </div>
            <div>
                <Link :href="route('listing.destroy', [listing.id])" method="Delete">Delete</Link>
            </div>
        </Link>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import ListingAddress from '@/Components/ListingAddress.vue'

defineProps({
    listings: Array
})
</script>