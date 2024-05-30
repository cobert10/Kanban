<script setup>
import Draggable from 'vuedraggable';
import { ref } from 'vue'
const animals = ref(['dog', 'cat', 'mouse'])

</script>


<template>
   <Draggable
      v-model="animals"
      tag="ul"
      item-key="id">

      <template #item="{element: animal}">
         <li>{{ animal }}</li>
      </template>
   </Draggable>
</template>