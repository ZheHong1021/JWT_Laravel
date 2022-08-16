<template>
  <div>
  <!-- <v-app> -->
      <h3>haha {{test}}</h3>

      <div>
        <router-link v-for="route in routes" :key="route.path" :to="route.path">
          {{ route.name }}
        </router-link>
      </div>

      <router-view></router-view>

      <br>

      <v-card width="200" height="200" color="orange lighten-4"
        class="d-flex justify-center align-center">
          <v-btn color="primary">測試</v-btn>
      </v-card>

  </div>
  <!-- </v-app> -->
</template>

<script>
export default {
  name: "App",
  data(){
    return{
      test: '123',
      routes: [
        {name: '首頁', path: '/'},
        {name: '關於我們', path: '/about'},
      ],
    }
  }
}
</script>

<style>

</style>