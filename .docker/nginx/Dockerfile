FROM nginx:alpine

# Remove a configuração padrão
RUN rm /etc/nginx/conf.d/default.conf

# Copia nosso arquivo de configuração customizado
COPY .docker/nginx/default.conf /etc/nginx/conf.d/