<template>
  <div class="form-layout">
    <v-row justify="center" align="center">
      <v-col cols="8" class="form-layout-content">
       <slot></slot>
      </v-col>
    </v-row>
  </div>
</template>

<script>
  export default {
  }
</script>

<style lang="scss" scoped>
  .form-layout {
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .form-layout-content {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    min-height: 200px;
  }
</style>
