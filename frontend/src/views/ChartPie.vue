<template>
  <canvas ref="pieCanvas"></canvas>
</template>

<script>
import { ref, onMounted, watch } from 'vue'
import { Chart } from 'chart.js/auto'

export default {
  name: 'ChartPie',
  props: {
    data: {
      type: Object,
      required: true
    }
  },
  setup(props) {
    const pieCanvas = ref(null)
    let chartInstance = null

    onMounted(() => {
      chartInstance = new Chart(pieCanvas.value, {
        type: 'pie',
        data: props.data,
        options: {
          responsive: true,
          maintainAspectRatio: false
        }
      })
    })

    watch(() => props.data, (newVal) => {
      if (chartInstance) {
        chartInstance.data = newVal
        chartInstance.update()
      }
    })

    return {
      pieCanvas
    }
  }
}
</script>

<style scoped>
canvas {
  width: 100%;
  height: 400px;
}
</style>
