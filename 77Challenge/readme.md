
<h1 align="center"> 77Sol Challenge</h1>


###  Desenvolvedor<Br>
LUCAS GOIANA MALICIA<br>

# Como utilizar o backend

### Pré-requisitos

- PHP =>7.1.3
- MYSQL
- Lumen
- Postman
- Composer
- Executar o passo a passo a seguir.

 <p> 1 - Clone ou Extraia o projeto em um diretório de sua preferência:</p>

    "diretório de sua preferencia"
    git clone https://github.com/LucasGoiana/77FullChallenge.git

ou

    "diretório de sua preferencia"
    unzip file.zip

<p> 2 - Entre na Pasta do Projeto:</p>

    cd 77Challenge

<p> 3 - No terminal execute o comando:</p>

    composer install

<p> 4 - No terminal execute o comando:</p>

    cp .env.example .env

<p> 5 - No arquivo .env editar as Variáveis de conexão do mysql:</p>

<p> 6 - No terminal execute o comando:</p>

    php artisan migrate

<p> 7 - No terminal execute o comando:</p>

    php artisan db:seed --class=UsersSeeder

> <b>Obs.:</b> Para fins de facilitar os testes deixo um seed e um usuario criados com o <br><strong>Email:</strong> lucasgoianam@77Sol.com.br <br><strong>Senha:</strong> 77Sol  

<p> 8 - No terminal execute o comando para gerar o HASH JWT:</p>

    php artisan jwt:secret
<p> 9 - Por último precismos servir nossa aplicação com o comando:</p>

    php -S localhost:8000 -t public

