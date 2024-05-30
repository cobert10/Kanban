<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CreateCardContainer from '@/Pages/Boards/CardContainer/Create.vue';
import CardContainer from '@/Pages/Boards/CardContainer/Show.vue';
import EditBoardName from '@/Pages/Boards/Board/Edit.vue';


const props = defineProps({
    board:Object,
});


function dragStart(e, card_container){
    e.dataTransfer.setData("card_container_id", card_container.id);
}
</script>

<template>
    <AuthenticatedLayout>
        <EditBoardName :board="board"></EditBoardName>
        <div class="overflow-x-auto shadow-sm sm:rounded-lg flex flex-grow mb-2">
            <div v-for="card_container in props.board.card_containers">
                <CardContainer
                    :card_container="card_container"
                    :board="board">
                </CardContainer>
            </div>

            <!-- Getting error when saving the new position o -->
            <!-- <draggable
                v-model="board.card_containers"
                class="flex"
                drag-clsss="drag"
                ghost-class="ghost"
                @change="onChange"
                >
                <template #item="{element: card_container}">
                    <div @dragstart="dragStart($event, card_container)">
                        <CardContainer
                            :card_container="card_container"
                            :board="board">
                        </CardContainer>
                    </div>
                </template>
            </draggable> -->
            <CreateCardContainer :board="board"></CreateCardContainer>
        </div>
    </AuthenticatedLayout>
</template>