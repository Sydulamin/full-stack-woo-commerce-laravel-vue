<template>
  <nav class="bg-gradient-to-r from-blue-700 to-blue-500 text-white shadow-lg">
    <div class="max-w-7xl mx-auto px-6 py-4 flex flex-wrap md:flex-nowrap items-center justify-between">
      <!-- Logo / Home Link -->
      <router-link
        to="/"
        class="text-2xl font-extrabold tracking-wide hover:text-yellow-300 transition-colors duration-300"
      >
        MyApp
      </router-link>

      <!-- Navigation Links -->
      <div class="flex flex-wrap items-center space-x-6 mt-4 md:mt-0">
        <router-link
          to="/login"
          class="text-white hover:text-yellow-300 font-semibold transition-colors duration-300"
          >Login</router-link
        >
        <router-link
          to="/register"
          class="text-white hover:text-yellow-300 font-semibold transition-colors duration-300"
          >Register</router-link
        >

        <router-link
          to="/cart"
          class="text-white hover:text-yellow-300 font-semibold transition-colors duration-300"
          >Cart</router-link
        >
        <router-link
          to="/dashboard"
          class="text-white hover:text-yellow-300 font-semibold transition-colors duration-300"
          >Dashboard</router-link
        >

        <router-link
          to="/profile"
          class="text-white hover:text-yellow-300 font-semibold transition-colors duration-300"
          >Profile</router-link
        >
      </div>

      <!-- User Info and Logout -->
      <div
        class="flex items-center space-x-4 bg-blue-800 bg-opacity-40 rounded-xl px-4 py-2 shadow-md"
      >
        <span class="font-semibold text-yellow-300 tracking-wide">Welcome, {{ userName }}</span>

        <img
          class="w-10 h-10 rounded-full border-2 border-yellow-300 shadow-lg"
          src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJkAAACUCAMAAAC3HHtWAAAAYFBMVEX///8AAADm5uY7Ozvp6en6+vrY2Njc3Nzs7OwmJiby8vKioqLU1NSBgYFFRUXh4eGzs7OVlZVmZmZra2tOTk6Li4u/v78REREYGBh1dXVcXFzFxcXMzMyrq6syMjJUVFQMvBpAAAADhElEQVR4nO2b2ZaqMBBFCTLIIIMyq/j/f9miTTdqgJRWKj7UfroPd63eK5BK6hRaFsMwDMMwDMMwDMN8K65/zPdJLepknx9917TOH250CMQ/wSH6Djd7J17Z2aa1LCvvJWJC9JFhLy+Reg0knkmxrJkVE6LJzIlFC14DuSmxckVMiNKMWL4qZmjVzgpiQpzpxeJayayJqcUceRl7ZbMlNpMVfjnEu+CkLCYE6fN0W4DZjtIMsmS0i3YAmREumgsSE4LO7Ag0O5KZrR+Yj5AVDhf2mgmxp7p9hxegWUF1DtgboFngE5n5wbrMAzXVxRtsRlZrv9fMnm+Y5DRUTxO8N8l2ALiekVUNwLXxDlmltTKgGV0HZQPNTmRmFtCMTgx42aDsUWKQGWUo9L0dCqhFIc7R1BeNOnSxVdODhDo9UO1SyA7zCSrxmZGUSq2omclD3fWD3VAauq6Wm5ulLIbbtcHU3bKq+eKRkOegN07tb1YRzjzRYHz3jy3hHej6FOvrcRje/x13kgc5TsQG8ZpuBPX75gdjxONE7bRr7/+niMd7/7ej2gnjIk0Ww46rvO2Ky6E8x+mfRzQm8x2JVzpZn2KpXfMnbekm1S+2fYhbgtmS5eYPnbz+sYD/nAM1uWz8a+fP88WN5m7YkQRUwa4KH/5TWO0kycfG0Sm2LV7/4m3hirLyUmfrpF5VFjPjWJ2duispXVO/ZmlErHWHQpPjZ7RdPaChwSuaznhbbaK5RK3nM47ll0yNiw6xz5/lgIbnaYPDWSkB/vP8dF+OoO9PH0lMCOxTSq27VAG50bOXqzuEBvdNW/sCCALu5Rtvya6LhikGHQIvgzkihg4AlkEMIR3ooGmZBO8OCfs8Yx283hir/o/gnQOqyacqPZYYdJizDlaxxbn/TMG6C0HGEmq0OGLINWMAqW6k0M8z1sGKOXzMU3OgQbujvYQZn4EZcYC/t1kUQ72gpXi7IEGO0rbQbzTmuKDnLvZMDASk0NClg78fkXHQkiWHn6sdwvU/8xbRh5mLxsFA9YlaXekTuz7R/dtineZ021X7wcIrZ/1zlPSdjbAnmFRcyaClbUM2TXcjSGfQk/7MLoxUD9Ik0lXDZt0qFbcko/a64efLoXKXm/tpXRhHc7vhcvaMLNcULyvbLunvCXPQJ11bZlSfqa4TOqkXD/ipY3ypGIZhGIZhGIZhGGaeH6eILI5MiMS0AAAAAElFTkSuQmCC"
          alt="User Avatar"
        />
        <button
          @click="logout"
          class="bg-yellow-400 hover:bg-yellow-300 text-blue-900 font-bold rounded px-4 py-2 shadow-md transition-colors duration-300"
        >
          Logout
        </button>
      </div>
    </div>
  </nav>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import api from '../axios'; // your configured axios instance with token interceptor

const userName = ref('Loading...');

async function fetchUser() {
  try {
    const response = await api.get('/user'); // Adjust this endpoint to your backend
    userName.value = response.data.name || 'User';
  } catch (error) {
    console.error('Failed to fetch user info:', error);
    userName.value = 'Guest';
  }
}

onMounted(() => {
  fetchUser();
});

function logout() {
  localStorage.removeItem('token');
  window.location.href = '/login';
}
</script>

