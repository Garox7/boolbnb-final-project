<template>
    <div>
        <h1>Pagina di login</h1>
        <form @submit.prevent="submitForm">
            <div>
                <label for="email">E-mail</label>
                <input
                    type="email"
                    id="email"
                    :class="{ 'is-invalid': errors.email || errors.general }"
                    v-model.trim="form.email"
                />
                <div v-if="errors.email">{{ errors.email }}</div>
            </div>
            <div>
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    :class="{ 'is-invalid': errors.password || errors.general }"
                    v-model.trim="form.password"
                />
                <div v-if="errors.password">{{ errors.password }}</div>
            </div>
            <div v-if="errors.general">{{ errors.general }}</div>
            <button type="submit">Login</button>
        </form>
        <p>Non hai un'account? <router-link :to="{name: 'registerPage'}">Effettua la registrazione</router-link></p>
    </div>
</template>

<script>
export default {
    data() {
        return {
            form: {
                email: '',
                password: '',
            },
            errors: {}
        }
    },
    computed: {
        formHasErrors() {
            return Object.keys(this.errors).length;
        },
    },
    methods: {
        submitForm() {
            this.errors = {};
            this.isFormValid();
            if(!this.formHasErrors) {
                this.login();
            }
        },
        isFormValid() {
            const errors = {};
            if(!this.form.email) errors.email = 'il campo email non può essere vuoto';
            if(!this.form.password) errors.password = 'il campo password non può essere vuoto';
            this.errors = errors;
        },
        login() {
            axios.post('/api/login', {
                email: this.form.email,
                password: this.form.password
            })
            .then(response => {
                console.log(response); // DEBUG
                localStorage.setItem('access_token', response.data.token);
                this.$router.push({ name: 'admin' });
            })
            .catch(error => {
                if (error.response) {
                    this.errors = { general: error.response.data.message };
                } else {
                    console.error(error);
                }
            });
        }
    }
}
</script>

<style lang="scss" scoped>
    .is-invalid {
        border-color: red;
    }
</style>
