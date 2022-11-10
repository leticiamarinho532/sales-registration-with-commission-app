<template>
    <div>
        <form @submit="createSale">
            <label for="sellerId">Id do Vendedor:</label><br>
            <input type="text" id="sellerId" name="sellerId" v-model="sellerId" /><br>
            <label for="saleValue">Valor da Venda:</label><br>
            <input type="text" id="saleValue" name="saleValue" v-model="saleValue"/><br><br>
            <input type="submit" value="Submit">
        </form> 
    </div>
</template>

<script>
import api from '@/services/api.js';

export default {
    name: 'RegisterSale',
    data() {
        return {
            sellerId: null,
            saleValue: null
        }
    },
    methods: {
        async createSale(e) {
            e.preventDefault();

            const data = {
                sellerId: parseInt(this.sellerId),
                value: parseFloat(this.saleValue)
            };

            await api.post('/sale/create', data).then(response => {
                alert(response.data.message);
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