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
   php artisan db:seed --class=CarSeeder
   npm install
   npm run build

4. Teste
   ```bash
   #entre dentro do container
   php artisan optimize
   ./vendor/bin/pest


## Adicione produtos / carro
   php artinsa app:add-cars-command (quantidade de itens)
  
## Importante

Se dê algum erro ao criar o container
docker system prune -a --force (Atenção isso vai apagar tudo do docker)

- Repita o Passo 3


## Configure seu Host se necessário
#Windows

Abra o Bloco de Notas como administrador.

Edite o arquivo: C:\Windows\System32\drivers\etc\hosts

Adicione: 127.0.0.1 meuapp.local

Salve e abra http://meuapp.local no navegador.

#Mac

No Terminal, digite: sudo nano /etc/hosts

Adicione: 127.0.0.1 meuapp.local

Salve (Ctrl + O) e saia (Ctrl + X).

(Opcional) Limpe o cache DNS:
sudo dscacheutil -flushcache; sudo killall -HUP mDNSResponder

Pronto! Você pode acessar seu app usando http://meuapp.local.   


