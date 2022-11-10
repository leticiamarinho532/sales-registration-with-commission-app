<template>
    <div>
        <h3>Lista de Vendedores</h3>
        <ul v-for="(seller,index) in sellers" :key="index">
            <li>
                <b>-</b>
                Id: {{seller.id}}
                | Nome: {{seller.name}}
                | email: {{seller.email}}
                | Comissão: {{seller.commission}}
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
            await api.get('/seller/show/').then(response => {
                this.sellers = response.data.data;
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

    }

    li {
        border: 1px solid #000000;
    }
</style>