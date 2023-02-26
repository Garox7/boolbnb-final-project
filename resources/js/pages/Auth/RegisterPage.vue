<template>
    <div>
        <h1>Pagina di registrazione</h1>
        <form @submit.prevent="submitForm">
            <div>
                <label for="first_name">Nome</label>
                <input
                    type="text"
                    id="first_name"
                    :class="{ 'is-invalid': errors.first_name }"
                    v-model="form.first_name"
                />
                <div v-if="errors.first_name">{{ errors.first_name }}</div>
            </div>

            <div>
                <label for="last_name">Cognome</label>
                <input
                    type="text"
                    id="last_name"
                    :class="{ 'is-invalid': errors.last_name }"
                    v-model="form.last_name"
                />
                <div v-if="errors.last_name">{{ errors.last_name }}</div>
            </div>

            <div>
                <label for="email">E-mail</label>
                <input
                    type="email"
                    id="email"
                    :class="{ 'is-invalid': errors.email }"
                    v-model.trim="form.email"
                />
                <div v-if="errors.email">{{ errors.email }}</div>
            </div>

            <div>
                <label for="date_of_birth">Data di nascita</label>
                <input
                    type="date"
                    id="date_of_birth"
                    :class="{ 'is-invalid': errors.date_of_birth }"
                    v-model="form.date_of_birth"
                />
                <div v-if="errors.date_of_birth">{{ errors.date_of_birth }}</div>
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

            <div>
                <label for="password_confirmation">Conferma password</label>
                <input
                    type="password"
                    id="password_confirmation"
                    :class="{ 'is-invalid': errors.password_confirmation || errors.general }"
                    v-model.trim="form.password_confirmation"
                />
                <div v-if="errors.password_confirmation">{{ errors.password_confirmation }}</div>
            </div>

            <button type="submit">Registrati</button>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            form: {
                first_name: '',
                last_name: '',
                email: '',
                date_of_birth: '',
                password: '',
                password_confirmation: ''
            },
            errors: {},
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
                this.register()
            };
        },
        isFormValid() {
            const errors = {};
            if(!this.form.first_name) errors.first_name = 'il campo Nome non può essere vuoto';
            if(!this.form.last_name) errors.last_name = 'il campo Cognome non può essere vuoto';
            if(!this.form.email) errors.email = 'il campo Email non può essere vuoto';
            if(!this.form.date_of_birth) errors.date_of_birth = 'il campo Data di nascita non può essere vuoto';
            if(!this.form.password) errors.password = 'il campo password non può essere vuoto';
            if (!this.form.password_confirmation) {
                errors.password_confirmation = 'devi confermare la password';
            } else if(this.form.password_confirmation !== this.form.password) {
                errors.password_confirmation = 'Le password non coincidono';
            }
            this.errors = errors;
        },
        register() {
            axios.post('/api/register', {
                first_name: this.form.first_name,
                last_name: this.form.last_name,
                email: this.form.email,
                password: this.form.password,
                password_confirmation: this.form.password_confirmation,
                date_of_birth: this.form.date_of_birth,
            })
            .then(response => {
                console.log(response); // DEBUG
                localStorage.setItem('access_token', response.data.token);
                this.$router.push({ name: 'admin' });
            })
            .catch(error => {
                if (error.response) {
                    console.log(error.response.data);
                    this.errors = { general: error.response.data.message };
                } else {
                    console.error(error);
                }
            });
        }
    }
}
</script>

<style>
    .is-invalid {
        border-color: red;
    }
</style>
