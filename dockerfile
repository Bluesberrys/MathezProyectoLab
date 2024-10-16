FROM node:20

WORKDIR /usr/src/app

COPY package*.json ./

RUN npm install express mysql2 body-parser jsonwebtoken bcrypt

COPY . .

ENV PORT=8080

EXPOSE 8080

CMD [ "node", "server.js" ]