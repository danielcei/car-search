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

4. Dentro do Container
   ```bash
   composer install
   php artisan migrate
   npm install
   npm run build

## Importante

Se dê algum erro ao criar o container
docker system prune -a --force (Atenção isso vai apagar tudo do docker)

Repita o Passo 3


   


