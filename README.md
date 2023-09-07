<h1>Como rodar localmente a API: </h1>
<h3>REQUISITOS:</h3>
<ul>
<li>Docker / Docker Desktop</li>
<li>WSL 2 (Windows) </li>
</ul>
<h3>COMANDOS:</h3>
<p>O comando a seguir subira os containers pelo sail 8.2(lastest): Laravel 10.x, MySQL e Redis</p>

```
./vendor/bin/sail up -d
```

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