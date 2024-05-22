<template>
  <div class="w-100 vh-100 d-flex align-content-center">
    <div class="auth-box m-auto w-100">
      <div v-if="user">
        <p>Yay, you are logged in😊</p>
        <div class="mb-4">
          <router-link class="text-decoration-none" :to="{ name: 'products' }">
            <div class="card border-0 shadow-sm text-dark">
              <div class="card-body">
                <div class="card-title fs-2">Products</div>
                <p class="card-text">Import and view your products</p>
              </div>
            </div>
          </router-link>
        </div>
        <a class="text-decoration-none" href="#" @click="logout">Logout</a>
      </div>
      <div v-else>
        <div class="mb-4">
          <router-link class="text-decoration-none" :to="{ name: 'login' }">
            <div class="card border-0 shadow-sm text-dark">
              <div class="card-body">
                <div class="card-title fs-2">Login</div>
                <p class="card-text">Login with your email and password</p>
              </div>
            </div>
          </router-link>
        </div>
        <div>
          <router-link class="text-decoration-none" :to="{ name: 'register' }">
            <div class="card border-0 shadow-sm bg-primary text-white">
              <div class="card-body">
                <div class="card-title fs-2">Register</div>
                <p class="card-text">Register with your email</p>
              </div>
            </div>
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      auth: true
    }
  },
  computed: {
    user() {
      return this.$store.getters.user;
    }
  }, methods: {
    async logout() {
      await this.$store.dispatch('logout');
      this.$router.push({ name: 'login' });
    }
  }
}
</script>
