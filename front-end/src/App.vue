<script setup>
import Header from './components/Header.vue';
import './styles/global.css';
</script>

<template>
  <Header />
  <router-view path='$router.key'/>
</template>