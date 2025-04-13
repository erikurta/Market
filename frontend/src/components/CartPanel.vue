<template>
  <div>
    <h2>Корзина</h2>
    <ul v-if="cart.length > 0">
      <li v-for="item in cart" :key="item.id">
        {{ item.product.name }} — {{ item.quantity }} шт.
      </li>
    </ul>
    <div v-else>Корзина пуста</div>

    <button v-if="cart.length > 0" @click="placeOrder">
      🧾 Оформить заказ
    </button>
  </div>
</template>

<script>
export default {
  name: 'CartPanel',
  data() {
    return {
      cart: []
    }
  },
  mounted() {
    this.loadCart()
  },
  methods: {
    loadCart() {
      this.$http.get('/cart').then(res => {
        this.cart = res.data
      })
    },
    placeOrder() {
      this.$http.post('/order')
          .then(res => {
            alert('✅ Заказ оформлен! Номер заказа: ' + res.data.order_id)
            this.cart = []
          })
          .catch(err => {
            alert(err.response?.data?.message || 'Ошибка при оформлении заказа')
          })
    }
  }
}
</script>