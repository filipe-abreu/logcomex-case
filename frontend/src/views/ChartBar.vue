<template>
  <div class="chart-container">
    <canvas ref="barChart"></canvas>
  </div>
</template>

<script>
import { Chart, registerables } from 'chart.js'
Chart.register(...registerables)

export default {
  props: ['data'],
  mounted() {
    this.renderChart()
  },
  watch: {
    data: {
      handler() {
        this.renderChart()
      },
      deep: true
    }
  },
  methods: {
    renderChart() {
      if (this.chart) {
        this.chart.destroy()
      }
      const ctx = this.$refs.barChart.getContext('2d')
      this.chart = new Chart(ctx, {
        type: 'bar',
        data: this.data,
        options: {
          responsive: true,
          maintainAspectRatio: false
        }
      })
    }
  }
}
</script>
