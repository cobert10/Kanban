<script setup>
import { PencilIcon } from '@heroicons/vue/24/solid'
import { useForm } from '@inertiajs/vue3';
import { ref, nextTick } from 'vue'

const props = defineProps({
    card:Object
})

const IsCardEditing = ref(false)
const editCardRef = ref()

const form = useForm({
    'name': props.card.name,
})

function onSubmit(){
    IsCardEditing.value=false
    form.put(route('card.update', {card: props.card.id}),{
        onError: () => form.reset()
    });
}

async function cardEdit(){
    IsCardEditing.value=true;
    await nextTick();
    editCardRef.value.focus();
}

</script>


<template>
    <form
        v-show="IsCardEditing"
        @focusout="onSubmit()"
        @submit.prevent="onSubmit()"
        class="h-20 border-2 rounded-md p-1 my-1 mb-2 shadow flex flex-col flex-start"
        :class="[card.template_color? 'bg-' + card.template_color + '-300 hover:border-' + card.template_color + '-400' : 'bg-gray-300 hover:bg-gray-400']">
        <textarea
            class="text-sm focus:ring-0 border-0 bg-transparent p-0 h-full w-full no-scrollbar"
            ref="editCardRef"
            type="text"
            v-model="form.name"
            placeholder="Enter description/title">
        </textarea>
    </form>
    <div 
        v-if="!IsCardEditing"
        @click="cardEdit()" 
        class=" h-20 border-2 rounded-md p-1 my-1 mb-2 shadow group flex overflow-hidden relative"
        :class="[card.template_color? 'bg-' + card.template_color + '-300 hover:border-' + card.template_color + '-400' : 'bg-gray-300 hover:bg-gray-400']">
            <div class="text-sm w-11/12">{{ card.name }}</div>
           <PencilIcon class="w-2 h-2 text-black hidden group-hover:block absolute right-2 top-2"></PencilIcon>
    </div>

</template>
<style scoped>
.drag > div {
  transform: rotate(5deg);
}

.ghost > div > div{
    visibility:hidden;
}
</style>