<template>
    <div>
        <form @submit="listSellerSale">
            <label for="sellerId">Id do Vendedor:</label><br>
            <input type="text" id="sellerId" name="sellerId" v-model="sellerId" /><br><br>
            <input type="submit" value="Submit">
        </form> 

        <ul v-for="(sale,index) in sales" :key="index">
            <li>
                <b>-</b>
                Id: {{sale.id}}
                Valor da Venda: {{sale.value}}
                Seller_id: {{sale.seller_id}}
            </li>
        </ul>
    </div>
</template>

<script>
import api from '@/services/api.js';

export default {
    name: 'ListSellerSales',
    data() {
        return {
            sellerId: null,
            sales: []
        }
    },
    methods: {
        async listSellerSale(e) {
            e.preventDefault();

            const data = {
                sellerId: parseInt(this.sellerId),
            };

            await api.get('/sale/' + data.sellerId + '/show/').then(response => {
                this.sales = response.data.data;
            })
            
        }
    }
}
</script>
<style scoped>
    div {
        width: 100%;
        
    }

    div {
        text-align: center;
        position: relative;
        top: 50%;
        transform: translateY(50%);
    }
</style>