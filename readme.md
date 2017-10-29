# eVALE

## Pré-requisitos
- [docker](#docker)
- [docker-compose](#docker-compose)
- [node](#node)
- [npm](#npm)

### Docker
```
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -
sudo add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable"
sudo apt-get update
apt-cache policy docker-ce
sudo apt-get install -y docker-ce
sudo usermod -aG docker ${USER}
```

### Docker compose
```
sudo curl -L https://github.com/docker/compose/releases/download/1.16.1/docker-compose-`uname -s`-`uname -m` -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose
```

### Node
```
curl -sL https://deb.nodesource.com/setup_8.x | sudo -E bash -
sudo apt-get install -y nodejs
```

### NPM
```
npm install npm@latest -g
```

## Instalação
Executar os segunte comandos no terminal

### Parar os containers (se der erro não tem problema):
```
docker stop $(docker ps -a -q)
```

### Remover os containers:
```
docker rm $(docker ps -a -q)
```

### Ajustar o host:
```
sudo sh -c 'echo "\n127.0.0.1 evale.dev" >> /etc/hosts'
```

### Copiar o .env
```
cp .env_example .env
```

### Subir o docker:
```
docker-compose up -d
```

### Aguardar o download das imagens e criação dos containers
- Entrar no phpMyAdmin (evale.dev:8080) e criar o banco evale:
 - Login: docker
 - Senha: docker
- New >> Inserir nome [evale] >> Criar

## Deploy
```
docker exec -ti php.docker sh "/var/www/html/eVALE/deploy.sh" && npm install && npm run dev
```

# Acessar
- APP: http://evale.dev
- phpMyAdmin: http://evale.dev:8080
