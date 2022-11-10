<template>
    <div>
        <h3>Lista de Vendedores</h3>
        <ul v-for="(seller,index) in sellers" :key="index">
            <li>
                <b>-</b>
                Id: {{seller.id}}
                Nome: {{seller.name}}
                email: {{seller.email}}
            </li>
        </ul>
    </div>
</template>

<script>
import api from '@/services/api.js';

export default {
    name: 'ListSellers',
    data() {
        return {
            sellers: []
        }
    },
    methods: {
        async getSellers() {
            console.log('aqui');
            await api.get('/seller/show/').then(response => {
                this.sellers = response.data.message;
            });
        }
    },
    mounted() {
        this.getSellers();
    }
}
</script>
<style scoped>
    div {
        width: 100%;
        text-align: center;
        position: relative;
        top: 50%;
        transform: translateY(50%);
    }
</style>