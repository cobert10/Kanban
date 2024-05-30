<script setup>
import { nextTick, ref } from 'vue'
import { useForm } from '@inertiajs/vue3';
import { PlusIcon } from '@heroicons/vue/24/solid';

const isShowingForm = ref(false)
const inputNameRef = ref()

const props = defineProps({
    board: Object,
    card_container:Object
});

const form = useForm({
    name : '',
    board_id: props.board.id,
    card_container_id: props.card_container.id
})

async function showForm(){
    isShowingForm.value = true
    await nextTick();
    inputNameRef.value.focus();
}

function onSubmit(){
    isShowingForm.value = false
    form.post(route('card.store'), { 
        onSuccess: () => form.reset()
    });
    
}

</script>

<template>
    <form 
        v-if="isShowingForm"
        @submit.prevent="onSubmit()"
        @focusout="isShowingForm=false"
        class="bg-white flex rounded-md justify-between w-40">
        <input
            v-model="form.name"
            id="name"
            ref="inputNameRef"
            class="rounded-sm outline-none pl-2 text-black h-9 rounded-l-md" 
            type="input" 
            placeholder="Enter a card title..." >
        <button
            @mousedown="onSubmit()"
            class="hover:bg-gray-400 rounded-r-md group"
            type="submit">
            <PlusIcon class="w-4 h-4 mx-2 group-hover:text-white"></PlusIcon>
        </button>
    </form>
    <button 
        @click="showForm()"
        v-if="!isShowingForm"
        class="w-full flex justify-center items-center bg-gray-300 hover:text-white text-md hover:bg-gray-400 rounded-md py-2 text-sm ">Add card
    </button>
</template>

<style scoped>
.ghost > div> button {
    visibility:hidden;
}
</style>