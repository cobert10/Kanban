<script setup>
import LoginForm from '@/Pages/Auth/Login.vue';
import RegisterForm from '@/Pages/Auth/Register.vue'
import { ref } from 'vue'

const activeIndex = ref(1);
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-sky-700">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg" >
            <div class="flex justify-center mb-10" >
                <div class="border-b-2 rounded-sm border-gray-100 items-center px-10 login"
                    @click="activeIndex=1" 
                    :class="[activeIndex===1 ? 'border-sky-700' : '']">
                    <button>Sign-in</button>
                </div>
                
                <div class="border-b-2 border-gray-200 items-center px-10 register"
                    @click="activeIndex=2" 
                    :class="[activeIndex===2 ? 'border-sky-700' : '']">
                    <button>Sign-up</button>
                </div>
            </div>
                
            <div class="flex items-center justify-center mb-5">
                <LoginForm 
                    v-if="activeIndex==1">
                </LoginForm>
                
                <RegisterForm 
                    v-if="activeIndex==2">
                </RegisterForm>
            </div>
        </div>
    </div>
    
</template>