<template>
  <div>
    <h2>Hello World!</h2>
    <p>{{ message }}</p>
  </div>
</template>

<script>
export default {
  name: 'HelloWorld',
  props: {
    message: {
      type: String,
      default: 'Componente de Exemplo'
    }
  }
}
</script>
