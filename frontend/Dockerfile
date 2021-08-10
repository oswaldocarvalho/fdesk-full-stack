# Stage 1 - gera um build
FROM node:14 as react-build
WORKDIR /app
COPY /frontend ./
RUN yarn
RUN yarn build

# Stage 2 - ambiente de produção
FROM nginx:alpine
COPY /configs/web/default.conf /etc/nginx/conf.d/default.conf
COPY --from=react-build /app/build /usr/share/nginx/html
EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]