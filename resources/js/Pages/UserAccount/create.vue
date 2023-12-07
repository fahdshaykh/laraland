<template>
    <form @submit.prevent="register">
        <div class="w-1/2 mx-auto">
            <div>
                <label for="name" class="label">Your Name</label>
                <input type="name" id="name" class="input" v-model="form.name" />
                <div class="input-error" v-if="form.errors.name"> {{ form.errors.name }} </div>
            </div>

            <div>
                <label for="email" class="label">E-mail</label>
                <input type="email" id="email" class="input" v-model="form.email" />
                <div class="input-error" v-if="form.errors.email"> {{ form.errors.email }} </div>
            </div>

            <div class="mt-4">
                <label for="password" class="label">Password</label>
                <input type="password" id="password" class="input" v-model="form.password" />
                <div class="input-error" v-if="form.errors.password"> {{ form.errors.password }} </div>
            </div>
            <div class="mt-4">
                <label for="password" class="label">Confirm Password</label>
                <input type="password" id="password" class="input" v-model="form.password_confirmation" />
            </div>

            <div class="mt-4">
                <button class="btn-primary w-full">Register</button>

                <div class="mt-2 text-center">
                    <Link :href="route('login')">Already have account? Click here</Link>
                </div>
            </div>
        </div>
    </form>
</template>

<script setup>
import { router, useForm, Link } from '@inertiajs/vue3';

const form = useForm({
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
})

const register = () => form.post(route('user-account.store'))
</script>