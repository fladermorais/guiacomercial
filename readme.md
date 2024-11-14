## Sobre este sistema

Guia Comercial Desenvolvido em Laravel
Este sistema possui um sistema de permisoes de usuários por meio de funções/ cargos

O Sistema conta atualmente com dois níveis de acessos:
- Administrador ( Acesso a todo o sistema );
- Cliente ( Todos os usuários registrados pertencem a este cargo/função - Tem permissão a alterar seus dados pessoais e a inserir um anúncio );

É possível criar outros cargos/ funções através do menu "Cargos" 

## Requisitos Mínimos ##

Debian 10 
PHP 7.4
MariaDB
Composer


## Instalação

### PHP
```
sudo apt install apt-transport-https ca-certificates curl software-properties-common zip gnupg git
sudo curl -fsSL https://packages.sury.org/php/apt.gpg | sudo apt-key add -
sudo add-apt-repository "deb https://packages.sury.org/php/ $(lsb_release -cs) main"
sudo apt update
sudo apt install php7.4-common php7.4-cli libapache2-mod-php7.4
sudo apt-get install php7.4-mbstring php7.4-xml php7.4-mysql
```

### Composer
```
sudo curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
sudo chmod +x /usr/local/bin/composer
```

### MYSQL
```
sudo apt update
sudo apt install mariadb-server
```

Acesse o Mysql de sua máquina como o usuário root
```
mysql -u root
```

Criando o Banco:
```
create database guiacomercial;

CREATE USER 'guiacomercialUser'@'localhost' IDENTIFIED BY 'password';

GRANT ALL PRIVILEGES ON guiacomercial.* TO 'guiacomercialUser'@'localhost';

FLUSH PRIVILEGES;

quit;

```

## Projeto
Acessar a pasta
```
cd /var/www/html
```

Remover arquivo index.html
```
rm /var/www/html/index.html
```


Clonar o Projeto
```
sudo git clone https://github.com/fladermorais/guiacomercial.git guia_comercial
```

Acessar a pasta do projeto
```
cd guia_comercial
```

Copiando o arquivo .env
```
cp .env.example .env
```

Altere as configurações referente ao banco nas linhas correspondentes ao '''mysql''' e '''configurações '''
```
APP_URL=http://meudominio.com.br


DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=guiacomercial
DB_USERNAME=guiacomercialUser
DB_PASSWORD=password
```

Instalando dependencias:
```
composer update
```

Agora que o arquivo .env foi criado e configurado o banco de dados é necessário gerar a chave(key) do Laravel e criar um link para a pasta storage dentro diretorio public
```
php artisan key:generate

php artisan storage:link
```

### Criando as tabelas no Banco de Dados
Para gerar as tabelas no banco execute o seguinte comando
```
php artisan migrate --seed
```
O Comando acima irá gerar todas as tabelas junto com as permissões de usuários, os dois cargos/ funções e um usuário Administrador e ainda vai relacionar as permissões padrões para o cargo Cliente

## Ativar o mode rewrite
```
sudo a2enmod rewrite
```

## Dando permissão para a pasta storage
É necessário dar permissão para a pasta storage, para o sistema gerar alguns logs e arquivos necessários.
Dentro da pasta raiz do projeto execute o seguinte comando:
```
sudo chmod -R 777 storage
```

### Usuário padrão do sistema
```
usuário:    admin@admin.com.br
senha:      Mudar123@
```



## Configuracoes Adicionais (manuais)

### Apache

Edite o arquivo sites-enabled/guia_comercial.conf e adicione os certificados corretos
Tem um exemplo dentro da pasta common/apache