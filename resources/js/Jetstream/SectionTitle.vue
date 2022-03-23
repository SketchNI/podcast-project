<template>
    <div class="md:col-span-1 flex justify-between">
        <div class="px-4 sm:px-0">
            <h2 class="text-lg font-medium text-zinc-900 dark:text-zinc-100">
                <slot name="title"></slot>
            </h2>

            <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">
                <slot name="description"></slot>
            </p>
        </div>

        <div class="px-4 sm:px-0">
            <slot name="aside"></slot>
        </div>
    </div>
</template>
