<template>
  <div class="container">
    <h1>Lista de Itens</h1>

    <!-- Botão Voltar -->
    <div class="back-container">
      <router-link to="/" class="btn">⬅ Voltar para Home</router-link>
    </div>

    <!-- Filtros -->
    <div class="filter-container">
      <label for="filterCodigo">Código:</label>
      <input id="filterCodigo" v-model="filterCodigo" />

      <label for="filterNome">Nome:</label>
      <input id="filterNome" v-model="filterNome" />

      <button class="btn" @click="fetchItems">Filtrar</button>
      <button class="btn btn-secondary" @click="clearFilters">Limpar</button>
    </div>

    <!-- Tabela de Itens -->
    <table>
      <thead>
        <tr>
          <th>Código</th>
          <th>Nome</th>
          <th>Descrição</th>
          <th>Quantidade</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in items" :key="item.id">
          <td>{{ item.codigo }}</td>
          <td>{{ item.nome }}</td>
          <td>{{ item.descricao }}</td>
          <td>{{ item.quantidade }}</td>
        </tr>
      </tbody>
    </table>

    <!-- Paginação -->
    <div class="pagination">
      <button class="btn" @click="prevPage" :disabled="!pagination.prev_page_url">⬅ Anterior</button>
      <span>Página {{ pagination.current_page }} de {{ pagination.last_page }}</span>
      <button class="btn" @click="nextPage" :disabled="!pagination.next_page_url">Próxima ➡</button>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      items: [],
      filterCodigo: '',
      filterNome: '',
      pagination: {
        current_page: 1,
        last_page: 1,
        prev_page_url: null,
        next_page_url: null
      }
    }
  },
  mounted() {
    this.fetchItems()
  },
  methods: {
    fetchItems(page = 1) {
      let params = { page }

      if (this.filterCodigo) params.codigo = this.filterCodigo
      if (this.filterNome) params.nome = this.filterNome

      axios.get('http://localhost/api/items', { params })
        .then(response => {
          this.items = response.data.data
          this.pagination = {
            current_page: response.data.current_page,
            last_page: response.data.last_page,
            prev_page_url: response.data.prev_page_url,
            next_page_url: response.data.next_page_url
          }
        })
        .catch(error => console.error('Erro ao buscar itens:', error))
    },
    prevPage() {
      if (this.pagination.prev_page_url) {
        this.fetchItems(this.pagination.current_page - 1)
      }
    },
    nextPage() {
      if (this.pagination.next_page_url) {
        this.fetchItems(this.pagination.current_page + 1)
      }
    },
    clearFilters() {
      this.filterCodigo = ''
      this.filterNome = ''
      this.fetchItems(1) // Recarrega a primeira página sem filtros
    }
  }
}
</script>
