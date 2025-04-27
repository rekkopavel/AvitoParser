FROM postgres:17

RUN mkdir -p /etc/postgresql

COPY ./postgresql.conf /etc/postgresql/postgresql.conf


CMD ["postgres", "-c", "config_file=/etc/postgresql/postgresql.conf"]
