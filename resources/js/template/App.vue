<template>
   <v-app>
      <app-header></app-header>

      <v-main>
         <router-view></router-view>
      </v-main>
   </v-app>
</template>
  
<script>
import Header from '../components/Header.vue'

   export default {
      components: { "app-header": Header },
      data: () => ({ 
         
      }),

   }
</script>
<style>
   main{
      background-color: #ECF2FF;
   }
   #app {  
   font-family: "Poppins"; 
   font-size: 13px; }
</style>