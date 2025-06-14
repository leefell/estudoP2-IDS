FROM mysql:5.7
ADD ./tabela.sql /docker-entrypoint-initdb.d
RUN chmod -R 775 /docker-entrypoint-initdb.d
ENV MYSQL_ROOT_PASSWORD=senha_da_nasa
