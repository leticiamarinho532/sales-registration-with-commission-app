# Desafio Técnico
## Api de cadastro de vendas e calculo de comissão

### Sumário

1. Tecnologias
2. BoilerPlate
3. Como usar na sua máquina
    - Colando
    - Definindo Variáveis de Ambiente
    - Rodando
4. Tests
    - Unidade / Integração
    - Como Está sendo usado o banco de dados
5. Rotas
6. Explicações de Algumas Funcionalidades
    - Envio automático de emails diário
    - Banco de Dados
    - Front-end

## **1. Tecnologias**
1. PHP 8
2. Laravel 9
3. Composer
4. MYSql
6. PHPUnit
7. Nginx
8. Vue Js
9. Docker

## **2. Boilerplate**

No back-end:

Com o uso do laravel, existe pastas que são default.
Código que foi feito por mim está localizado nas seguintes pastas:

```
.
├── app                    
│   ├── Console
|       ├── Kernel.php                          # Here
|       ├── Commands                            # Here
│   ├── Mail                                    # Here
│   ├── Models                                  # Here
│   ├── Repositories                            # Here
│   ├── Services                                # Here
│   └── Http                                    # Here
│   └── ... 
├── ...
├── nginx                                       # Here
├── database                                    # Here
├── resources                                   # Here
├── ...               
├── ...
├── routes                                      # Here
├── ...
├── tests                                       # Here
├── dockerFile-app                              # Here
├── dockerFile-cronjob                          # Here
├── dockerFile-dependency-manager-composer      # Here
└──
```

No front-end:

Com o uso do Vue js, existe pastas que já vem default.
Código que foi feito por mim está localizado nas seguintes pastas:

```
.
├── src                    
│   ├── components                              # Here
│   ├── pages                                   # Here
│   ├── routes                                  # Here
│   ├── services                                # Here
│   ├── styles                                  # Here
│   └── App.vue                                 # Here
│   └── main.js 
├── ...
└──
```

## **3. Como usar na sua máquina**

#### Clonando
- Instale o Docker no seu local [site Docker](https://docs.docker.com/desktop/).
- Clone  esse repositório.

#### Definindo Variáveis de Ambiente
- Copie a .env.example para o arquivo .env
#### Rodando
```
Aviso: Não é necessário rodar comandos para instar as depencias dos projetos pois já existe uma configuração automatica em conjunto com as configurações do docker.
```


- Rode esse comando `docker compose up` na pasta raiz (onde o arquivo docker-compose.yaml está).
- Use seu Ip local para usar as rotas do back-end que estão listadas no tópico `Rotas`
- Para usar o front-end, é necessário ter o node.js instalada na sua máquina, e usar o comando `npm run dev` que abrirá uma porta `5173` para usar com seu Ip local.
- Já tem migrations e seeders prontas para uso! para utliza-las é necessário fazer o passo a passo citado no `tópico testes` para entrar no container e então rodar o comando `php artisan migrate --seed`.

## **4. Testes**
- Unidade / Integração

    Os testes de unidade foram aplicados para assegurar comportamento correto nos menores pedaços de código, que nesse projeto se encontram nos `Services`.

    Os testes de integração foram aplicados para assegurar que a junção de tecnologias, que no caso foi a junção com banco de dados, funcione corretamente.

    Para executar os testes, entre no container do projeto back-end `nome do container: app-backend` usando o comando `docker exec -it ID_DO_CONTAINER exec` e utilize artisan para rodar os testes com o comando `php artisan test`.

- Como Está sendo usado o banco de dados
    Para os testes não poluirem o banco principal, foi utilizado um banco de dados in memomy `SQLite`. para que isso pudesse acontecer, foi utilizado um arquivo `.env` de testes, com nome de `env.testing`.

## **5. Rotas**

### Currencies

- POST /seller/create/

    Cadastrar um vendendedor.

    **Explicação do body que DEVE ser enviado**

    - name = string
    - email = email

    **Exemplo de Body**

    ```
    {
        "name": "Joana",
        "email": "joana@email.com"
    }
    ```

    **Respostas da API**

    Em sucesso
    ```
    {
        "retcode": "SUCCESS",
        "data": {
            "id": 23,
            "name": "Joana",
            "email": "joana@email.com"
        },
        "message": ""
    }
    ```

- GET /seller/show/

    Retorna todos os vendedores com as comissões.

    **Explicação do body que DEVE ser enviado**

    Não é necessário enviar parametros.

    **Respostas da API**

    Em sucesso
    ```
    {
        "retcode": "SUCCESS",
        "data": [
            {
            "id": 1,
            "name": "YU8js6Od7v",
            "email": "jconroy@ritchie.com",
            "commission": "R$2.125"
            }
        ],
        message: ""
    }
    ```

    
- POST /sale/create/

    Cadastra uma venda.

    **Explicação do body que DEVE ser enviado**

    - sellerid = integer 
    - value = float

    **Exemplo de Body**

    ```
    {
        "sellerId": 4,
        "value": 20
    }
    ```

     **Respostas da API**

    In Success
    ```
    {
        "retcode": "SUCCESS",
        "data": {
            "id": 25,
            "name": "LnNEyJfJ46",
            "email": "leticia.marinho532@gmail.com",
            "commission": "R$1.7",
            "value": "R$20",
            "sale_date": "2022-11-10T07:41:10.000000Z"
        },
        "message": ""
    }
    ```

- POST /sale/{sellerId}/show/

    Exibe todas as vendas de um vendedor com a comissão

    **Explicação de paramentros de rota**

    - sellerId = integer

    **Explicação do body que DEVE ser enviado**

    Não é necessário enviar parametros.

    **Respostas da API**

    In Success
    ```
    {
        "retcode": "SUCCESS",
        "data": {
            "id": 25,
            "name": "LnNEyJfJ46",
            "email": "leticia.marinho532@gmail.com",
            "commission": "R$1.7",
            "value": "R$20",
            "sale_date": "2022-11-10T07:41:10.000000Z"
        },
        "message": ""
    }
    ```

## **6. Explicações de Algumas Funcionalidades**
- Envio automático de emails diário

- Banco de Dados

- Front-end