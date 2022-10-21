<template>
  <v-footer padless id="footer" align="center" justify-center>
    <v-col
      cols="12"
    >
      {{ new Date().getFullYear() }} — <strong>ForumApp</strong>
    </v-col>
  </v-footer>
</template>

<script>

</script>

<style scoped>
  #footer {
      position: absolute;
      bottom: 0px;
      width: 100%;
  }
</style>
