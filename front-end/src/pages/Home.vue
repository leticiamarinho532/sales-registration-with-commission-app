<template>
    <main>
        <div>
            <h1>Bem Vindo ao Sistema!</h1>

            <h3>Navege pelo menu acima para cadastrar um vendedor, 
            listar todos os vendedores, cadastrar uma venda e listar vendas de um vendedor.</h3>
        </div>
    </main>
</template>

<script>
export default {
    name: 'Home'
}
</script>
<style scoped>
    main {
        width: 100%;
        
    }

    div {
        text-align: center;
        position: relative;
        top: 50%;
        transform: translateY(50%);
    }
</style>