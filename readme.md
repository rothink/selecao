

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

    composer install && npm install

## 3) rodar a migrate

    php artisan migrate:install
    php artisan migrate:refresh --seed
    
##  4) publicar o swagger
    php artisan vendor:publish --provider "L5Swagger\L5SwaggerServiceProvider"

##  5) inicializar a aplicação
    php artisan serve
    
##  6) gerar documentação swagger api
    php artisan l5-swagger:generate
    
## Crud de pessoa.

http://localhost:8000

## Documentação api com swagger

http://localhost:8000/api/documentation
    
    
    




