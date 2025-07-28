<template>
  <div class="min-h-screen bg-white flex flex-col">
    <!-- Navigation -->
    <Nav />

    <!-- Main content -->
    <main class="flex-grow px-4 py-8">
      <!-- Hero Section -->
      <!-- <div class="text-center max-w-xl mx-auto mb-12">
        <h2 class="text-4xl font-bold text-gray-800 mb-4">Welcome to MyApp</h2>
        <p class="text-gray-600 text-lg mb-6">
          This is a simple, modern Vue 3 application with Laravel API backend. Use the navigation above to log in or register.
        </p>
        <router-link to="/register" class="inline-block px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition">
          Get Started
        </router-link>
      </div> -->
      

      <!-- Product List -->
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 max-w-6xl mx-auto">
        <div
          v-for="product in products"
          :key="product.id"
          class="border rounded-xl p-4 shadow hover:shadow-lg transition"
        >
          <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ product.name }}</h3>
          <p class="text-gray-600 mb-2">{{ product.description }}</p>
          <p class="font-bold text-blue-600 mb-1">$ {{ product.price }}</p>
          <p class="text-sm text-gray-500">Stock: {{ product.stock }}</p>
          <button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">add to cart</button>
          <button class="mt-4 ml-1 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            View Details
          </button>

        </div>
        
      </div>
    </main>

    <!-- Footer -->
    <Footer />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import api from '../axios';
import Swal from 'sweetalert2';
import Nav from '../components/Nav.vue';
import Footer from '../components/Footer.vue';

const products = ref([]);

onMounted(async () => {
  const token = localStorage.getItem('token');

  if (!token) {
    Swal.fire({
      icon: 'warning',
      title: 'Login Required',
      text: 'Please log in to view products.',
      confirmButtonText: 'OK',
    });
    return;
  }

  try {
    const response = await api.get('/products');
    products.value = response.data;
  } catch (error) {
    console.error('Failed to fetch products:', error);
    Swal.fire({
      icon: 'error',
      title: 'Fetch Error',
      text: 'Unable to fetch products. Please try again.',
    });
  }
});
</script>
