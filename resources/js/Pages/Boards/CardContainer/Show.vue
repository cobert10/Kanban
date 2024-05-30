<script setup>
import CreateCardItem from '@/Pages/Boards/Card/Create.vue'
import {useForm} from '@inertiajs/vue3';
import {ref, nextTick, watch} from 'vue'
import EditCard from '@/Pages/Boards/Card/Edit.vue';
import Draggable from 'vuedraggable';
import draggable from 'vuedraggable';
import { router } from '@inertiajs/vue3'
import { EllipsisHorizontalIcon } from '@heroicons/vue/24/solid';
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue';


const isEditingForm = ref(false);
const IsCardEditing = ref(false);
const cardHeader = ref();
const inputHeader = ref();

const props = defineProps({
    card_container:Object,
    board:Object,
    card:Object
});


const form = useForm({
    'name': props.card_container.name
});

const cards = ref(props.card_container.cards);

watch(
    () => props.card_container.cards, 
    (loadCards) => cards.value = loadCards
);

async function editTitle(){
    isEditingForm.value = true
    await nextTick()
    inputHeader.value.select()
}

function onSubmit(){
    isEditingForm.value = false
    form.put(route('card_container_header.update', {card_container: props.card_container.id}))
}

function onChange(e){
    let item = e.moved || e.added;
    // console.log(item)
    if (!item) return;
    
    // console.log(item.newIndex);
    let currentIndex = item.newIndex;

    // console.log(cards.value);
    let prevCard = cards.value[currentIndex - 1];
    let card = cards.value[currentIndex];
    let nextCard = cards.value[currentIndex + 1];
    let position = card.position;
 
    if (prevCard && nextCard) {
        position = (parseFloat(prevCard.position) + parseFloat(nextCard.position))/2;
    }
    else if(prevCard){
        position = parseFloat(prevCard.position) + (parseFloat(prevCard.position)/2);
    }

    else if(nextCard){
        position =  parseFloat(nextCard.position)/2;
    }
    
    
    router.put(route('card.move', {card: card.id}), {
        position: position,
        card_container_id: props.card_container.id
    });
}

function deleteContainer(){
    router.delete(route('card_container.delete', {card_container: props.card_container.id}))
}

function dragStart(e, card){
    e.dataTransfer.setData("card_id", card.id)
}
</script>

<template>
    <div class="flex flex-col min-w-60 max-w-60 bg-gray-200 h-fit rounded-md p-2 mr-2">
        <!-- card header -->
        <div class="flex flex-row justify-between">
            <form 
                @focusout="onSubmit()"
                @submit.prevent="onSubmit()"
                v-show="isEditingForm">
                <input 
                    ref="inputHeader"
                    v-model="form.name" 
                    type="text"
                    class="font-bold text-sm border-0 rounded-md p-1 ml-[-2px] m-2"/>
            </form>
        <h2 @click="editTitle()"
            ref="cardHeader"
            :class="[isEditingForm? 'absolute -left-[1000rem]':'']"
            class="font-bold text-sm m-2 hover:bg-gray-500 hover:text-white w-fit rounded-md p-1 ml-[-2px]">{{ card_container.name }}
            <span v-if="card_container.cards.length">({{ card_container.cards.length }})</span>
        </h2>
        
        <Menu as="span" class="flex items-center m-2 p-1 hover:bg-gray-500 hover:text-white rounded-md relative z-10">
            <MenuButton>
                <EllipsisHorizontalIcon class="w-4 h-4 rounded-md"></EllipsisHorizontalIcon>
            </MenuButton>
            <transition
                enter-active-class="transition transform duration-100 ease-out"
                enter-from-class="opacity-0 scale-90"
                enter-to-class="opacity-100 scale-100"
                leave-active-class="transition transform duration-100 ease-in"
                leave-from-class="opacity-100 scale-100"
                leave-to-class="opacity-0 scale-90">
                <MenuItems class="mt-2 focus:outline-none absolute right-0 top-5 bg-white overflow-hidden rounded-md shadow-lg border w-40">
                <MenuItem v-slot="{active}">
                    <a @click="deleteContainer()" :class="{'bg-gray-100': active}" class="block px-4 py-2 text-sm text-gray-700 text-red-600">Delete Container</a>
                </MenuItem>
                <MenuItem v-slot="{active}">
                    <a href="#" :class="{'bg-gray-100': active}" class="block px-4 py-2 text-sm text-gray-700 ">Edit Container</a>
                </MenuItem>
                </MenuItems>
            </transition>
        </Menu>

    </div>
        <!-- card body -->
        <div class="flex flex-col overflow-hidden mb-4 overflow-y-auto custom-scrollbar">
            <draggable 
                @change="onChange"
                v-model="cards" 
                group="cards"
                item-key="id"
                drag-class="drag"
                ghost-class="ghost"
                class="max-h-[25.8rem]">
                <template #item="{element: card}">
                    <div                      
                        :id="card"
                        :key="card"
                        @dragstart="dragStart($event, card)">
                        <EditCard :card="card"/>
                    </div>
                </template>
            </draggable>
        </div>

        <!-- card footer -->
        <CreateCardItem 
            :board="board"
            :card_container="card_container">
        </CreateCardItem>
    </div>
</template>

<style scoped>
.ghost > div > div {
    visibility:hidden;
}
</style>