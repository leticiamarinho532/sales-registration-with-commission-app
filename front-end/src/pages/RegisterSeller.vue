<template>
    <div>
        <form @submit="createSeller">
            <label for="name">Nome:</label><br>
            <input type="text" id="name" name="name" v-model="name" /><br>
            <label for="email">E-mail:</label><br>
            <input type="text" id="email" name="email" v-model="email"/><br><br>
            <input type="submit" value="Submit">
        </form> 
    </div>
</template>

<script>
import api from '@/services/api.js';

export default {
    name: 'RegisterSeller',
    data() {
        return {
            name: null,
            email: null
        }
    },
    methods: {
        async createSeller(e) {
            e.preventDefault();

            const data = {
                name: this.name,
                email: this.email
            };

            await api.post('/seller/create/', data).then(response => {

                if (response.data.retcode !== 'SUCCESS') {
                    alert('Não foi possível cadastar o vendedor!');
                }

                alert('Vendedor Cadastrado com sucesso!');
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