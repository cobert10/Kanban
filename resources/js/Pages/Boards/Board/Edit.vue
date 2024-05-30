<script setup>
import { useForm, router } from '@inertiajs/vue3';
import { ref, nextTick, watch } from 'vue';
import { TrashIcon } from '@heroicons/vue/24/outline'
import draggable from 'vuedraggable';

const props = defineProps({
    board:Object
})

const form = useForm({
    name: props.board.name
});

const isEditingForm = ref(false)
const titleInput = ref()
const titleHeader = ref()
const trashZone = ref()

const cards = ref()

async function editTitle(){
    isEditingForm.value = true
    await nextTick()
    titleHeader.value.select()
}

function onSubmit(){
    isEditingForm.value = false
    form.put(route('boards.update', {board: props.board.id}), {
        onError: () => form.reset()
    })
}

function dragOver(e){
    e.preventDefault();
    setActive(true);
}

function dragLeave(e){
    setActive(false)
}

async function drop(e) {
    var card_id = e.dataTransfer.getData("card_id");
    var card_container_id = e.dataTransfer.getData("card_container_id");

    await nextTick();
    setActive(false)

    if(card_id){
        router.delete(route('card.delete', {card: card_id}))
    }
    else if(card_container_id){
        router.delete(route('card_container.delete', {card_container: card_container_id}))
    }
}

function setActive($isActive){
    if($isActive){
        trashZone.value.style.border="2px solid red";
        trashZone.value.style.color="white";
        trashZone.value.style.backgroundColor="red";
    }
    else{
        trashZone.value.style.border="2px solid gray";
        trashZone.value.style.color="black";
        trashZone.value.style.backgroundColor="white";
    }
}
</script>

<template>
    <div class="my-4 flex justify-between">
        <form
            @focusout="onSubmit()"
            @submit.prevent="onSubmit()"
            v-show="isEditingForm">
            <input
                class="text-2xl tight-tracking font-semibold rounded-md p-2 border-0"
                v-model="form.name"
                placeholder="Board name"
                ref="titleHeader"/>
        </form>
        <h1 @click="editTitle()"
            :class="[isEditingForm? 'absolute -left-[1000rem]':'']"
            ref="titleInput" 
            class="text-2xl font-semibold text-black tight-tracking rounded-md hover:bg-gray-400 w-fit p-2 hover:text-white">{{ form.name }}
        </h1>
        
        <div class="border-2 border-gray-300 items-center flex justify-center p-1 px-2 rounded-md" 
            ref="trashZone"
            @drop="drop"
            @dragover="dragOver"
            @dragleave="dragLeave">
            <span><TrashIcon class="w-4 h-4 "></TrashIcon></span>
            <span ref="trashZone">Drag card or container here</span>
            <span><TrashIcon class="w-4 h-4 "></TrashIcon></span>
        </div>
    </div>
</template>

