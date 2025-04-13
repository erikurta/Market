<template>
  <div>
    Backend Status: <strong>{{ pong === true ? 'Online' : 'Offline' }}</strong>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      pong: null
    }
  },
  mounted() {
    axios.get(`${process.env.VUE_APP_API_URL}/ping`)
        .then(res => {
          this.pong = res.data.pong
        })
        .catch(() => {
          this.pong = false
        })
  }
}
</script>