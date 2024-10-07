FROM debian

LABEL maintainer="Hamid Shariati"

ARG WWWGROUP
ARG NODE_VERSION=16
ARG POSTGRES_VERSION=14

WORKDIR /var/www/html

ENV DEBIAN_FRONTEND noninteractive
ENV TZ=UTC

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update \
    && apt-get install -y gnupg gosu curl ca-certificates zip unzip git supervisor sqlite3 libcap2-bin libpng-dev
#Run apt-get install -y python2

#    && mkdir -p ~/.gnupg \
#    && chmod 600 ~/.gnupg \
#    && echo "disable-ipv6" >> ~/.gnupg/dirmngr.conf \
#    && echo "keyserver hkp://keyserver.ubuntu.com:80" >> ~/.gnupg/dirmngr.conf \
#    && gpg --recv-key 0x14aa40ec0831756756d7f66c4f4ea0aae5267a6c \
#    && gpg --export 0x14aa40ec0831756756d7f66c4f4ea0aae5267a6c > /usr/share/keyrings/ppa_ondrej_php.gpg \
#    && apt-get update \
RUN apt-get install -y php-cli php-dev \
       php-pgsql php-sqlite3 php-gd \
       php-curl \
       php-imap php-mysql php-mbstring \
       php-xml php-zip php-bcmath php-soap \
       php-intl php-readline \
       php-ldap \
       php-msgpack php-igbinary php-redis

# RUN apt-get install -y php-swoole
#RUN apt-get install -y php-memcached php-pcov php-xdebug \
RUN php -r "readfile('https://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer \
    && curl -sLS https://deb.nodesource.com/setup_$NODE_VERSION.x | bash - \
    && apt-get install -y nodejs

RUN apt-get install -y npm

RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | gpg --dearmor | tee /usr/share/keyrings/yarn.gpg >/dev/null \
    && echo "deb [signed-by=/usr/share/keyrings/yarn.gpg] https://dl.yarnpkg.com/debian/ stable main" > /etc/apt/sources.list.d/yarn.list \
    && curl -sS https://www.postgresql.org/media/keys/ACCC4CF8.asc | gpg --dearmor | tee /usr/share/keyrings/pgdg.gpg >/dev/null \
    && echo "deb [signed-by=/usr/share/keyrings/pgdg.gpg] http://apt.postgresql.org/pub/repos/apt jammy-pgdg main" > /etc/apt/sources.list.d/pgdg.list \
    && apt-get update \
    && apt-get install -y yarn
#    && apt-get install -y mysql-client \
# apt-get install -y postgresql-client-$POSTGRES_VERSION \
RUN apt-get -y autoremove


#RUN apt-get clean \
#    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

#RUN #setcap "cap_net_bind_service=+ep" /usr/bin/php


RUN groupadd --force -g $WWWGROUP sail
RUN useradd -ms /bin/bash --no-user-group -g $WWWGROUP -u 1337 sail

COPY start-container /usr/local/bin/start-container
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY php.ini /etc/php//cli/conf.d/99-sail.ini
RUN chmod +x /usr/local/bin/start-container

EXPOSE 8000

ENTRYPOINT ["start-container"]
