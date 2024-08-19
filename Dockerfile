FROM node:21.1.0 AS builder

WORKDIR /app

COPY package.json yarn.lock ./
COPY .env.prod ./.env.prod
COPY .env.prod ./.env
RUN yarn install

COPY . .

RUN yarn build:prod


FROM node:21.1.0 AS runner

WORKDIR /app

COPY --from=builder /app/.next ./.next
COPY --from=builder /app/public ./public
COPY --from=builder /app/.env.prod ./.env.prod
COPY --from=builder /app/.env.prod ./.env
COPY --from=builder /app/package.json ./package.json
COPY --from=builder /app/next.config.mjs ./next.config.mjs

RUN yarn install
EXPOSE 3000

CMD ["yarn", "start:prod"]
