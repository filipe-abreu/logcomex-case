<template>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Código</th>
        <th>Nome</th>
        <th>Descrição</th>
        <th>Quantidade</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="item in items" :key="item.id">
        <td>{{ item.id }}</td>
        <td>{{ item.codigo }}</td>
        <td>{{ item.nome }}</td>
        <td>{{ item.descricao }}</td>
        <td>{{ item.quantidade }}</td>
      </tr>
    </tbody>
  </table>
</template>

<script>
export default {
  name: 'ItemList',
  props: {
    // Recebe a lista de itens carregados no DetailsView
    items: {
      type: Array,
      required: true
    }
  }
}
</script>
