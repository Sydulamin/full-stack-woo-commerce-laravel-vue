<template>
  <div class="min-h-screen flex flex-col bg-gray-50">
    
    <Nav />
    
    <main class="flex-grow flex items-center justify-center">
      <div class="w-full max-w-md p-6 bg-white rounded-xl shadow">
        <h2 class="text-2xl font-bold mb-4 text-center">Login</h2>
        <form @submit.prevent="login">
          <input
            v-model="email"
            type="email"
            placeholder="Email"
            class="w-full p-3 mb-4 border rounded"
          />
          <input
            v-model="password"
            type="password"
            placeholder="Password"
            class="w-full p-3 mb-4 border rounded"
          />
          <button
            type="submit"
            class="bg-blue-600 text-white w-full py-3 rounded hover:bg-blue-700 transition"
            :disabled="loading"
          >
            {{ loading ? 'Logging in...' : 'Login' }}
          </button>
        </form>
        <p class="mt-4 text-sm text-center">
          Don't have an account?
          <router-link to="/register" class="text-blue-600 hover:underline">Register</router-link>
        </p>
      </div>
    </main>
    <Footer />
  </div>
</template>

<script setup>
import { ref } from 'vue';
import api from '../axios';
import { useRouter } from 'vue-router';
import Nav from '../components/Nav.vue';
import Footer from '../components/Footer.vue';

const email = ref('');
const password = ref('');
const loading = ref(false);
const router = useRouter();

const login = async () => {
  loading.value = true;
  try {
    const res = await api.post('/login', {
      email: email.value,
      password: password.value
    });

    localStorage.setItem('token', res.data.token);
    api.defaults.headers.common['Authorization'] = `Bearer ${res.data.token}`;
    router.push('/dashboard');
  } catch (err) {
    alert(err.response?.data?.message || 'Login failed');
  } finally {
    loading.value = false;
  }
};
</script>
