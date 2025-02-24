<template>
  <div class="container">
    <h1>Dashboard</h1>
    <!-- Botão Voltar -->
    <div class="back-container">
      <router-link to="/" class="btn">⬅ Voltar para Home</router-link>
    </div>
    <div class="chart-container">
      <ChartBar v-if="barChartData" :data="barChartData" />
      <ChartPie v-if="pieChartData" :data="pieChartData" class="pie-chart" />
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import ChartBar from '../views/ChartBar.vue'
import ChartPie from '../views/ChartPie.vue'

export default {
  components: {
    ChartBar,
    ChartPie
  },
  data() {
    return {
      barChartData: null,
      pieChartData: null
    }
  },
  mounted() {
    axios.get('http://localhost/api/dashboard')
      .then(response => {
        const items = response.data

        this.barChartData = {
          labels: items.map(item => item.codigo),
          datasets: [{
            label: 'Quantidade',
            data: items.map(item => item.quantidade),
            backgroundColor: 'rgba(54, 162, 235, 0.5)'
          }]
        }

        this.pieChartData = {
          labels: items.map(item => item.codigo),
          datasets: [{
            data: items.map(item => item.quantidade),
            backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4CAF50', '#9C27B0',
              '#FFC107', '#00BCD4', '#E91E63', '#8BC34A', '#3F51B5']
          }]
        }
      })
      .catch(error => console.error('Erro ao buscar dados do dashboard:', error))
  }
}
</script>
