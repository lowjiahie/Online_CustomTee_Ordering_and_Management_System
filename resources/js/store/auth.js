import { defineStore } from 'pinia';
import axios from 'axios';
import router from '../routes'

export const useAuthStore = defineStore("auth", {
    state: () => ({
        authCus: null,
        authErrors: [],
        authStatus: false,
    }),
    persist: true,
    getters: {
        user: (state) => state.authCus,
        errors: (state) => state.authErrors,
        status: (state) => state.authStatus,
    },
    actions: {
        async getToken() {
            await axios.get("/sanctum/csrf-cookie");
        },
        async login(data) {
            this.authErrors = [];
            await this.getToken();

            await axios.post("/api/login", {
                email: data.email,
                password: data.password,
            }).then((response) => {
                this.authCus = response.data.cus
                localStorage.setItem("authToken", response.data.token);
                this.authStatus = true;
                router.push("/customer/");
            }).catch((error) => {
                if (error.response.status === 422) {
                    this.authErrors = error.response.data.errors;
                }
            })
        },
        async register(data) {
            this.authErrors = [];
            await this.getToken();
            await axios.post("/api/register", {
                name: data.name,
                email: data.email,
                password: data.password,
                password_confirmation: data.password_confirmation,
            }).then((response) => {
                console.log(response);
                alert("Successfully Register");
                router.push("/customer/login");
            }).catch((error) => {
                if (error.response.status === 422) {
                    this.authErrors = error.response.data.errors;
                }
            })
        },
        async logout() {
            axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('authToken')}`
            await axios.post("/api/logout", {
                cus_id: this.authCus.cus_id,
            }).then(() => {
                localStorage.removeItem('authToken');
                this.authStatus = false;
                this.authCus = null;
                router.push("/customer/login");
            }).catch((error) => {
                if (error.response.status === 422) {
                    this.authErrors = error.response.data.errors;
                }
            })
        },
        resetErrors() {
            console.log("reset data");
            this.authErrors = [];
        },
    },
})