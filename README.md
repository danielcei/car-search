# CarSearch - Sistema de Busca de Carros

Sistema de busca de carros com filtros combinados desenvolvido em Laravel Livewire com arquitetura MVC + DDD.

## Requisitos

- Docker
- Docker Compose
- PHP 7.4 fora do docker
- User o PowerShel para rodar os commandos

## Instalação Windows

1. Clone o repositório:
   ```bash
   git clone https://github.com/danielcei/car-search.git 
   cd car-search
   cp .env.example .env

2. Configure o Ambiente:
   ```bash
   composer install

3. Criar o container:
   ```bash
   bash ./vendor/bin/sail up -d
   
   #Talvez não precise do bash
   #bash vendor/bin/sail up -d
   
   #Talvez tenha que tirar ./
   #bash vendor/bin/sail up -d
   
4. Entre no Container
   ```bash
    # Listar todos os containers em execução
    docker ps
    
    # Acessar o container (substitua CONTAINER_ID pelo ID do seu container)
    # O ID geralmente aparece na primeira coluna do comando docker ps
    docker exec -it CONTAINER_ID bash

5. Dentro do Container
   ```bash
   composer install
   php artisan migrate
   php artisan db:seed --class=CarSeeder
   npm install
   npm run build
   
6. Pronto! Você pode acessar seu app usando
   ```bash
    http://localhost:8181.

7. Teste
   ```bash
   #entre dentro do container
   php artisan optimize
   ./vendor/bin/pest

## Adicione produtos - carro

1. Digite o comando a baixo para adicionar novos produtos (faker)
    ```bash
    php artinsa app:add-cars-command (quantidade de itens)
   
## Teste com Pest

1. Entre dentro do container
    ```bash
   php artisan optimize
   ./vendor/bin/pest


## Configure seu Host se necessário
Em alguns casos será necessário configurar o seu host para acessar o sistema via browser.
1. Windows
   ```bash
        #Abra o Bloco de Notas como administrador.
        #Edite o arquivo: 
            C:\Windows\System32\drivers\etc\hosts
        #Adicione: 
            127.0.0.1 localhost
        Renicie computador ou recrie o container  

2. Mac
   ```bash
   #No Terminal, digite: 
         sudo nano /etc/hosts
         sudo dscacheutil -flushcache
         sudo killall -HUP mDNSResponder
   #Adicione: 
         127.0.0.1 localhost
   
Abra o Browser
http://localhost:8181


## Importante

1. Durante a criação do container, existem alguns bibliotecas que estão demorando a ser baixado, levando muito tempo para ser contrruido.
Muitas das vezesn dando erros, Se dê algum erro ao criar o container
   ```bash
        docker system prune -a --force 

(Atenção isso vai apagar tudo do docker, se vc tiver em algum projeto)
- Repita o Passo 3
