<template>
    <form @submit.prevent="update">
        <div class="grid grid-cols-6 gap-4">
            <div class="col-span-2">
                <label class="label" for="beds">Beds</label>
                <input class="input" type="text" v-model.number="form.beds" id="">
                <div class="input-error" v-if="form.errors.beds">
                    {{ form.errors.beds }}
                </div>
            </div>

            <div class="col-span-2">
                <label class="label" for="baths">baths</label>
                <input class="input" type="text" v-model.number="form.baths" id="">
                <div class="input-error" v-if="form.errors.baths">
                    {{ form.errors.baths }}
                </div>
            </div>

            <div class="col-span-2">
                <label class="label" for="area">Area</label>
                <input class="input" type="text" v-model.number="form.area" id="">
                <div class="input-error" v-if="form.errors.area">
                    {{ form.errors.area }}
                </div>
            </div>

            <div class="col-span-4">
                <label class="label" for="city">City</label>
                <input class="input" type="text" v-model.trim="form.city" id="">
                <div class="input-error" v-if="form.errors.city">
                    {{ form.errors.city }}
                </div>
            </div>

            <div class="col-span-2">
                <label class="label" for="code">Code</label>
                <input class="input" type="text" v-model.number="form.code" id="">
                <div class="input-error" v-if="form.errors.code">
                    {{ form.errors.code }}
                </div>
            </div>

            <div class="col-span-4">
                <label class="label" for="street">Street</label>
                <input class="input" type="text" v-model="form.street" id="">
                <div class="input-error" v-if="form.errors.street">
                    {{ form.errors.street }}
                </div>
            </div>

            <div class="col-span-2">
                <label class="label" for="steet_nr">Street Number</label>
                <input class="input" type="text" v-model="form.street_nr" id="">
                <div class="input-error" v-if="form.errors.street_nr">
                    {{ form.errors.street_nr }}
                </div>
            </div>

            <div class="col-span-6">
                <label class="label" for="price">Price</label>
                <input class="input" type="text" v-model.number="form.price" id="">
                <div class="input-error" v-if="form.errors.price">
                    {{ form.errors.price }}
                </div>
            </div>

            <div>
                <button class="btn-primary" type="submit">Update</button>
            </div>
        </div>
    </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    listing: Object
})

const form = useForm({
    beds: props.listing.beds,
    baths: props.listing.baths,
    area: props.listing.area,
    city: props.listing.city,
    code: props.listing.code,
    street: props.listing.street,
    street_nr: props.listing.street_nr,
    price: props.listing.price
})

const update = () => form.put(route('listing.update', {listing: props.listing.id}));

// const update = () => form.put(`/listing/${props.listing.id}`);
</script>

<style scoped>

label {
    margin-right: 2em;
}
div {
    padding: 2px;
}
</style>