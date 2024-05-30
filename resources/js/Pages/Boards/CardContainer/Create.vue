<script setup>
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue'
import { PlusIcon } from '@heroicons/vue/24/solid'

const props = defineProps({
    board: Object
});

const isShowingForm = ref(false)
const inputNameRef = ref()

const form = useForm({
    name: '',
    board_id: props.board.id
});

async function showForm(){
    isShowingForm.value = true
    await nextTick();
    inputNameRef.value.focus();
}

function onSubmit(){
    form.post(route('card_container.store'), {
        onSuccess: () => {
            form.reset()
            isShowingForm.value = false
        }
    })
}
</script>


<template>
    <div class="text-white ">
        <form 
            v-if="isShowingForm"
            @focusout="isShowingForm=false"
            @submit.prevent="onSubmit()"
            class="bg-gray-300 flex p-2 rounded-md h-[2.8rem] ">
            <input
                v-model="form.name"
                id="name"
                ref="inputNameRef"
                class="rounded-sm focus:ring-0 outline-none pl-2 text-black text-sm rounded-l-md w-[11rem] " 
                type="input" 
                placeholder="Enter a list name" >

            <button
                @mousedown="onSubmit()"
                class="hover:bg-gray-400 group rounded-r-md"
                type="submit">
                <PlusIcon class="w-4 h-4 m-2 text-black group-hover:text-white"></PlusIcon>
            </button>
        </form>
        <button
            @click="showForm()"
            v-if="!isShowingForm"
            class="bg-gray-300 text-black p-3 rounded-md w-56 flex justify-center hover:bg-gray-400 hover:text-white text-sm">Add card container
        </button>
    </div>
</template>