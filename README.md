<h1>Como rodar localmente a API: </h1>
<h3>REQUISITOS:</h3>
<ul>
<li>Docker / Docker Desktop</li>
<li>WSL 2 (Windows) </li>
</ul>
<h3>COMANDOS:</h3>
<p>Configure seu arquivo <code>.env</code> conforme o arquivo <code>.env.example</code> e <code>docker-compose.yml</code></p>

```
cp .env.example .env
```

```
...

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=back_scaleao_teste
DB_USERNAME=sail
DB_PASSWORD=password

...

QUEUE_CONNECTION=database

...
```

<p>O comando a seguir subira os containers pelo sail 8.2(lastest): Laravel 10.x, MySQL, Mailpit e Redis</p>

```
./vendor/bin/sail up -d
```

<p>Crie uma coneexão no seu SGDB favorito, e suba as <code>migrations</code></p>

```
./vendor/bin/sail artisan migrate
```

<h3>COMANDOS UTEIS:</h3>

<p>Rodar os <code>SCHEDULE</code> (agendamentos)</p>

```
./vendor/bin/sail artisan schedule:work
```

<p>Rodar os <code>QUEUE</code> (fila)</p>

```
./vendor/bin/sail artisan queue:work
```

<p>Rodar os <code>TEST</code> (testes)</p>
<p><code>OBSERVAÇÕES:</code> configurar o arquivo <code>phpunit.xml</code> correspondente ao <code>.env</code>. Dentro do arquivo <code>phpunit.xml</code> tem essa sessão para configuração, preencha com os dados do arquivo <code>.env</code>:<p>

```
<!-- DEFINA OS VALORES DAS VARIAVEIS DE .ENV -->
<env name="DB_CONNECTION" value="mysql"/> 
<env name="DB_HOST" value="mysql"/> 
<env name="DB_PORT" value="3306"/> 
<env name="DB_DATABASE" value=""/>
<env name="DB_USERNAME" value=""/>
<env name="DB_PASSWORD" value=""/> 
<!--  -->
```

```
./vendor/bin/sail artisan test
```

<h3>API DOCUMENTAÇÃO</h3>
<p>full url: <code>URL BASE</code> + <code>ENDPOINT</code></p>
<p>URL BASE:</p>
<ul>
<li><code>PRODUCTION:</code> http://15.229.23.85</li>
<li><code>DEVELOPMENT:</code> http://localhost:80</li>
</ul>
<p>STATUS CODE:</p>
<ul>
<li><code>200 :</code> sucesso</li>
<li><code>404 :</code> não encontrado</li>
<li><code>422 :</code> algum parametro invalido</li>
<li><code>500 :</code> erro internado | falha com banco</li>
</ul>
<h4>ENDPOINTS:</h4>
<p>Vendedores</p>
<ul>
<li><code>GET</code> <code>/vendedores</code> listar todos os vendedores</li>
<ul>
<li>
RESPONSE:

```
[
    {
		"id": number,
		"name": string,
		"email": string,
		"created_at": string = date,
		"updated_at": string = date,
		"total_commission": double,
		"sales": []
    },
]
```

</li>
</ul>
<li><code>POST</code> <code>/vendedores</code> criar um novo vendedor</li>
<ul>
<li>
BODY REQUEST ESPERADA:

```
{
    "name": string, // EXEMPLO: Joao
    "email": string // EXEMPLO: joaoscaleao@hotmail.com
}
```

</li>
<li>
RESPONSE:

```
{
    "id": number,
    "name": string,
    "email": string,
    "updated_at": string = date,
    "created_at": string = date
}
```

</li>
</ul>
<li><code>PUT / PATCH</code> <code>/vendedores/{id}</code> atualizar um vendedor, espera um id do tipo number valido</li>
<ul>
<li>
BODY REQUEST ESPERADA:

```
{
    "name": string, // EXEMPLO: Joao1 | nome a ser editado
    "email": string // EXEMPLO: joaoscaleao1@hotmail.com | email a ser editado
}
```

</li>
<li>
RESPONSE:

```
{
    "id": number,
    "name": string,
    "email": string,
    "updated_at": string = date,
    "created_at": string = date
}
```

</li>
</ul>
<li><code>GET</code> <code>/vendedores/{id}</code> consultar um vendedor, espera um id do tipo number valido</li>
<ul>
<li>
RESPONSE:

```
{
    "id": number,
    "name": string,
    "email": string,
    "updated_at": string = date,
    "created_at": string = date
}
```

</li>
</ul>
<li><code>DELETE</code> <code>/vendedores/{id}</code> deletar um vendedor, espera um id do tipo number valido</li>
<ul>
<li>
RESPONSE:

```
{
    "message": "Vendedor deletado com sucesso",
    "data": "true"
}
```

</li>
</ul>
</ul>
<hr>
<p>Venda</p>
<ul>
<li><code>GET</code> <code>/venda/{id}</code> listar todos os venda por vendedor, espera um id do tipo number valido</li>
<ul>
<li>
RESPONSE:

```
[
    {
        "id": number,
        "seller_id": number,
        "name": string,
        "email": string,
        "amount": double,
        "comission": double,
        "created_at": string = date,
        "updated_at": string = date,
    }
]
```

</li>
</ul>
</ul>
<li><code>POST</code> <code>/venda</code> criar um novo vendedor</li>
<ul>
<li>
BODY REQUEST ESPERADA:

```
{
    "seller_id": number,
    "amount": double
}
```

</li>
<li>
RESPONSE:

```
{
    "id": number,
    "seller_id": number,
    "amount": double,
    "name": string,
    "email": string,
    "comission": double,
    "updated_at": string = date,
    "created_at": string = date
}
```

</li>
</ul>
</ul>