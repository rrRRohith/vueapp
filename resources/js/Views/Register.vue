<template>
    <div class="w-100 vh-100 d-flex align-content-center">
        <div class="auth-box m-auto w-100">
            <form action="" @submit.prevent="register">
                <div class="card border-0 shadow-sm text-dark">
                    <div class="card-body">
                        <div class="card-title fs-2">Register</div>
                        <div class="mb-3">
                            <label for="name" class="form-label mb-0">Name</label>
                            <input type="name" v-model="name" class="form-control shadow-sm rounded-1" name="name"
                                id="name" placeholder="John doe">
                        </div>
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
                                busy? 'Please hold on': 'Register'
                            }}</button>
                        </div>
                        <router-link :to="{ name: 'login' }" class="text-decoration-none ">Existing member?
                            login here</router-link>
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
            name: '',
            email: '',
            password: '',
            errors: null,
            busy: false,

        }
    },
    methods: {
        async register() {
            this.busy = true;
            this.errors = null
            this.success = ''
            try {
                await this.$store.dispatch('register', {
                    'name': this.name,
                    'email': this.email,
                    'password': this.password,
                });
                this.$router.push({ name: 'products' })
            } catch (e) {
                this.$helper.apiError(this, e);
            }
            this.busy = false;
        }
    }
}
</script>
