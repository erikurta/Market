import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        cart: []
    },
    mutations: {
        setCart(state, cart) {
            state.cart = cart
        }
    },
    actions: {
        loadCart({ commit }) {
            return axios.get('/cart').then(res => {
                commit('setCart', res.data)
            })
        }
    },
    getters: {
        cartItemCount: state => state.cart.length,
        cartItems: state => state.cart
    }
})