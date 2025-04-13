<template>
  <div>
    <h2>Каталог товаров</h2>
    <div v-if="products.length === 0">Загрузка...</div>
    <ul v-else>
      <li v-for="product in products" :key="product.id">
        <h3>{{ product.name }}</h3>
        <p>{{ product.description }}</p>
        <p>Цена: {{ product.price }} ₽</p>
        <button @click="addToCart(product.id)">Добавить в корзину</button>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: 'HomeView',
  data() {
    return {
      products: [
        {
          id: 1,
          name: 'Кепка',
          description: 'Крутая кепка',
          price: 499
        }
      ]
    }
  },
  mounted() {
    this.$http.get('/products').then(res => {
      this.products = res.data
    })
  },
  methods: {
    addToCart(productId) {
      this.$http.post('/cart', { product_id: productId }).then(() => {
        alert('Добавлено в корзину')
        this.$store.dispatch('loadCart')
      })
    }
  }
}
</script>