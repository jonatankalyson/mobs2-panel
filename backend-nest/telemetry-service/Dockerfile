# Imagem base
FROM node:18-alpine

# Diretório de trabalho dentro do container
WORKDIR /app

# Copia apenas os arquivos de dependência primeiro
COPY package*.json ./

# Instala as dependências
RUN npm install

# Copia o resto do código
COPY . .

# Compila o projeto
RUN npm run build

# Expõe a porta do Nest
EXPOSE 3000

# Comando para rodar a aplicação
CMD ["npm", "run", "start:prod"]
