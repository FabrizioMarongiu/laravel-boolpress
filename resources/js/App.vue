<template>
  <div>
    <Header />

    <main>
      <!-- IL COMPONENTE MECCHATO DALLA ROUTE VERRà RENDERIZZATO QUI -->
      <router-view></router-view>
    </main>
  </div>
</template>

<script>
import axios from "axios";
import Header from "./components/Header.vue";

export default {
  name: "App",
  components: {
    Header,
  },
};
</script>

<style lang="scss">
@import "../sass/frontoffice/utilities";

body {
  font-family: sans-serif;
}
.navigation {
  .active-page {
    background-color: dodgerblue;
  }
}
</style>