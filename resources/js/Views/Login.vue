<template>
    <div class="w-100 vh-100 d-flex align-content-center">
        <div class="auth-box m-auto w-100">
            <form action="" @submit.prevent="login">
                <div class="card border-0 shadow-sm text-dark">
                    <div class="card-body">
                        <div class="card-title fs-2">Login</div>
                        <div class="mb-3">
                            <label for="email" class="form-label mb-0 ">Email</label>
                            <input type="email" v-model="email" class="form-control shadow-sm rounded-1" name="email"
                                id="email" placeholder="john@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label mb-0 ">Password</label>
                            <input type="password" v-model="password" class="form-control shadow-sm rounded-1"
                                name="password" id="password" placeholder="Secret">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn d-block w-100 btn-primary  rounded-1 shadow-none">{{
                                busy? 'Please hold on': 'Log in'
                            }}</button>
                        </div>
                        <router-link :to="{ name: 'register' }" class="text-decoration-none ">New member?
                            register here</router-link>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<script>

export default {
    data() {
        return {
            email: '',
            password: '',
            errors: null,
            busy: false,
        }
    },
    methods: {
        async login() {
            this.busy = true;
            this.errors = null
            try {
                await this.$store.dispatch('login', { 'email': this.email, 'password': this.password })
                this.$router.push({ name: 'products' })
            }
            catch (e) {
                this.$helper.apiError(this, e);
            };
            this.busy = false;
        }
    },
}
</script>
