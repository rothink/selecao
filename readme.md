

## Seleção

laravel 
vue
sqlite
swagger


Passo a passo

## 1) clone o repositorio

    git clone https://github.com/rothink/selecao.git
    
    cd selecao

## 2) rodar composer e npm

    composer clear-cache && composer install && npm install

## 3) rodar a migrate

    touch database/database.sqlite
    
## 4) cria o arquivo de banco  
    
    php artisan migrate
    php artisan migrate:refresh --seed
    
## 5) publicar arquivos necessários

    npm run dev
    
##  6) gerar documentação swagger api

    php artisan l5-swagger:generate
    
##  7) inicializar a aplicação

    php artisan serve
    
## Crud de pessoa.

http://localhost:8000

## Documentação api com swagger

http://localhost:8000/api/documentation

## Tests

    ./vendor/bin/phpunit
