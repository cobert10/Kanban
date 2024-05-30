<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CreateBoard from '@/Pages/Boards/Board/Create.vue';
import { Head, Link } from '@inertiajs/vue3'

const props = defineProps ({
    boards:Array,
});
</script>

<template>
    <Head title="Boards" />
    <AuthenticatedLayout>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grid lg:grid-cols-4 sm:grid-cols-3 xs:grid-cols-2 gap-4 p-4 mt-4 mx-10">
            <CreateBoard></CreateBoard>
            <Link
                v-for="board in boards"
                :key="board.id"
                class="h-48 bg-sky-700 bg-opacity-90 hover:bg-opacity-100 col-span-1 items-center rounded-md p-2 text-white text-xl tracking-tight"
                :href="route('boards.show', {board: board})">
                {{ board.name }}
            </Link>
        </div>
    </AuthenticatedLayout>
</template>
