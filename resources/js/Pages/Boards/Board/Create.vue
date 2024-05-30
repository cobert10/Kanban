<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const isShowingForm = ref(false)
const inputNameRef = ref()
const form = useForm({
    name : ''
})

async function showForm(){
    isShowingForm.value=true
    await nextTick
    inputNameRef.value.focus()
}

function onSubmit(){
    form.post(route('boards.store'),{
        onSuccess: () => {
            isShowingForm.value=false;
            form.reset();
        }
    });
}
</script>

<template>
    <button 
        @click="showForm()"
        v-if="!isShowingForm"
        class="h-48 bg-gray-300 bg-opacity-50 hover:bg-opacity-100 col-span-1 flex flex-col justify-center items-center rounded-md">
        <span>Create new board</span>  
    </button>
    <div
        v-if="isShowingForm"
        class="h-48 bg-gray-300 bg-opacity-50 hover:bg-opacity-100 col-span-1 flex flex-col rounded-md p-2">
        <form @submit.prevent="onSubmit()">
            <input 
                id="name"
                v-model="form.name"
                ref="inputNameRef"
                v-if="isShowingForm" 
                class="border-gray-300 focus:ring-0 rounded-md h-20 mb-2 flex-start w-full"
                type="text" 
                placeholder="Enter board name..">

            <p v-if="form.errors.name" class="text-red-600 mb-2 text-sm">{{ form.errors.name }}</p>
            
            <div class="grid grid-cols-2 w-full ">
                <button class="col-span-1 bg-sky-700 text-white p-2 rounded-md">
                    Create</button>
                <button
                    class="col-span-1 text-rose-600"
                    @click="isShowingForm=false">Cancel
                </button> 
            </div>
        </form>
    </div>
</template>