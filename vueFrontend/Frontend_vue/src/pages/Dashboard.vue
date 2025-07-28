<template>
  <div class="max-w-xl mx-auto mt-20 p-6 bg-white rounded-xl shadow">
    <h2 class="text-2xl font-bold mb-4">Welcome</h2>
    <p class="mb-4">You're logged in!</p>
    <button class="bg-red-500 text-white px-4 py-2 rounded" @click="logout">Logout</button>
  </div>
</template>

<script setup>
import { useRouter } from 'vue-router';
import api from '../axios';

const router = useRouter();

const logout = () => {
  localStorage.removeItem('token');
  delete api.defaults.headers.common['Authorization'];
  router.push('/login');
};
</script>
