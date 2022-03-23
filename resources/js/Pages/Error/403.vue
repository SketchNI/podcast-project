<template>
    <main class="min-h-screen bg-cover bg-top sm:bg-top flex justify-around items-center"
          style="background-image: url('/403.jpg')">
        <div class="max-w-7xl text-center content-center">
            <div class="bg-black p-24 rounded-lg bg-opacity-70">
                <p class="font-semibold text-red-500 uppercase tracking-wide">403 error</p>
                <h1 class="mt-2 text-4xl font-extrabold text-white tracking-tight sm:text-5xl">
                    Uh oh! Seems like you can't do that.
                </h1>
                <p class="mt-2 text-lg font-medium text-zinc-300">
                    {{ message }}
                </p>
                <div class="mt-6">
                    <x-link href="#" @click.prevent="goBack()" class="underline text-lg">
                        Go back home
                    </x-link>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
import { defineComponent } from 'vue'

export default defineComponent({
    name: "403",

    props: ['message'],

    methods: {
        goBack() {
            history.back();
        }
    }
});
</script>

<style scoped>

</style>
