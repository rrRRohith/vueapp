import axios from 'axios';
import { createStore } from 'vuex'
import sharedMutations from 'vuex-shared-mutations';

export default createStore({
    state() {
        return {
            user: null
        }
    },
    getters: {
        user(state) {
            return state.user;
        }
    },
    mutations: {
        setUser(state, payload) {
            state.user = payload;
        }
    },
    actions: {
        /**
         * Try autheticate user
         * @param {Array} payload 
         */
        async login({ dispatch }, payload) {
            try {
                await axios.get('/sanctum/csrf-cookie');
                await axios.post('/api/auth/login', payload).then((res) => {
                    return dispatch('getUser');
                }).catch((err) => {
                    throw err.response
                });
            } catch (e) {
                throw e
            }

        },
        /**
         * Register new user and dispatch login
         * @param {Aarry} payload 
         */
        async register({ dispatch }, payload) {
            try {
                await axios.post('/api/auth/register', payload).then((res) => {
                    return dispatch('login', { 'email': payload.email, 'password': payload.password })
                }).catch((err) => {
                    throw (err.response)
                })
            } catch (e) {
                throw (e)
            }
        },

        /**
         * Logout user
         */
        async logout({ commit }) {
            await axios.post('/api/auth/logout').then((res) => {
                commit('setUser', null);
            }).catch((err) => {
                throw err.response
            })

        },
        /**
         * Get current user
         */
        async getUser({ commit }) {
            await axios.get('/api/auth/user').then((res) => {
                commit('setUser', res.data);
            }).catch((err) => {
                //throw err.response
            })
        },
    },
    plugins: [sharedMutations({ predicate: ['setUser'] })],
})
