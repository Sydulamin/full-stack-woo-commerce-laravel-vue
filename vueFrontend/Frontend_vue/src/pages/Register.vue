<template>
  <div class="flex flex-col min-h-screen">
    <Nav />

    <!-- Main Content -->
    <div class="flex-grow">
      <div class="max-w-md mx-auto mt-20 p-6 bg-white rounded-xl shadow">
        <h2 class="text-2xl font-bold mb-4">Register</h2>

        <p v-if="errorMessage" class="text-red-500 text-sm mb-4">{{ errorMessage }}</p>

        <form @submit.prevent="register">
          <input v-model="name" type="text" placeholder="Name" class="w-full p-2 mb-4 border rounded" required />
          <input v-model="email" type="email" placeholder="Email" class="w-full p-2 mb-4 border rounded" required />
          <input v-model="password" type="password" placeholder="Password" class="w-full p-2 mb-4 border rounded" required />
          <input v-model="password_confirmation" type="password" placeholder="Confirm Password" class="w-full p-2 mb-4 border rounded" required />

          <button class="bg-green-500 text-white px-4 py-2 rounded w-full" :disabled="loading">
            {{ loading ? 'Registering...' : 'Register' }}
          </button>
        </form>

        <p class="mt-4 text-sm">
          Already have an account?
          <router-link to="/login" class="text-blue-600 underline">Login</router-link>
        </p>
      </div>
    </div>

    <!-- Footer pushed to bottom -->
    <Footer class="mt-auto" />
  </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from '../axios';
import { useRouter } from 'vue-router';
import Nav from '../components/Nav.vue';
import Footer from '../components/Footer.vue';

const name = ref('');
const email = ref('');
const password = ref('');
const password_confirmation = ref('');
const loading = ref(false);
const errorMessage = ref('');

const router = useRouter();

const register = async () => {
  loading.value = true;
  errorMessage.value = '';

  try {
    const response = await axios.post('/register', {
      name: name.value,
      email: email.value,
      password: password.value,
      password_confirmation: password_confirmation.value,
    });

    const token = response.data.token;
    localStorage.setItem('token', token);
    axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;

    router.push('/dashboard');
  } catch (error) {
    if (error.response) {
      const data = error.response.data;
      if (data.errors) {
        errorMessage.value = Object.values(data.errors).flat().join(', ');
      } else {
        errorMessage.value = data.message || 'Registration failed';
      }
    } else {
      errorMessage.value = 'Something went wrong. Please try again.';
    }
  } finally {
    loading.value = false;
  }
};
</script>
