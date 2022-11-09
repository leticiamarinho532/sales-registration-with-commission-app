<template>
    <header>

        <nav>
           <router-link to="/">Tela Principal</router-link>
           <router-link to="/cadastrar-vendedor">Cadastrar Vendedor</router-link>
           <router-link to="/listar-vendedores">Listar Vendedores</router-link>
           <router-link to="/cadastrar-venda">Cadastrar Venda</router-link>
           <router-link to="/listar-vendas-vendedor">Listar Vendas de Um Vendedor</router-link>
        </nav>
    </header>
</template>

<script>
export default {
    name: 'Header'
}
</script>

<style scoped>
    header{
        background-color: #e3e1e1;
        width: 100%;
        height: 100px;
    }

    nav{
        text-align: center;
        position: relative;
        top: 50%;
        transform: translateY(-30%);
    }

    a{
        margin: 1%;
        color: #000000;
    }
</style>