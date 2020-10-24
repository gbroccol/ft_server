# **************************************************************************** #
#                                                                              #
#                                                         :::      ::::::::    #
#    Dockerfile                                         :+:      :+:    :+:    #
#                                                     +:+ +:+         +:+      #
#    By: gbroccol <marvin@42.fr>                    +#+  +:+       +#+         #
#                                                 +#+#+#+#+#+   +#+            #
#    Created: 2020/06/29 14:29:15 by gbroccol          #+#    #+#              #
#    Updated: 2020/06/29 14:29:15 by gbroccol         ###   ########.fr        #
#                                                                              #
# **************************************************************************** #

FROM debian:buster

LABEL maintainer="gbroccol@student.21-school.com"

EXPOSE 80 443

# update			синхронизация и обновление индексных файлов пакетов
# upgrade			обновление всего установленного на данный момент софта в системе
# nginx				HTTP-сервер и обратный прокси-сервер, почтовый прокси-сервер
#					а также TCP/UDP прокси-сервер общего назначения

RUN apt-get update && apt-get upgrade && apt-get -y install\
			wget\
			vim\
			tar\
			nginx\
			openssl\
			mariadb-server\
			php7.3 php7.3-fpm php7.3-common php7.3-mysql php7.3-gd php7.3-cli\
				php-imagick php-phpseclib php-php-gettext php7.3-common\
				php7.3-imap php7.3-json php7.3-curl php7.3-zip php7.3-xml\
				php7.3-mbstring php7.3-bz2 php7.3-intl php7.3-gmp

RUN mkdir -p var/www/html/phpmyadmin

#PhpMyAdmin
#--strip-components 1 -C		куда разархивировать
RUN wget https://files.phpmyadmin.net/phpMyAdmin/4.9.0.1/phpMyAdmin-4.9.0.1-all-languages.tar.gz && \
	tar -xvf phpMyAdmin-4.9.0.1-all-languages.tar.gz --strip-components 1 -C /var/www/html/phpmyadmin &&\
	rm phpMyAdmin-4.9.0.1-all-languages.tar.gz

#Wordpress
RUN wget https://ru.wordpress.org/latest-ru_RU.tar.gz && \
	tar -xvf latest-ru_RU.tar.gz && \
	mv wordpress /var/www/html && \
	rm latest-ru_RU.tar.gz

# изменение конфигурационных файлов
# wp-config.php			Wordpress
RUN rm var/www/html/wordpress/wp-config-sample.php
COPY srcs/wp-config.php ./var/www/html/wordpress

# default				nginx
COPY /srcs/default ./etc/nginx/sites-available/default

#config.inc.php			PhpMyAdmin
RUN rm var/www/html/phpmyadmin/config.sample.inc.php
COPY srcs/config.inc.php ./var/www/html/phpmyadmin

#MySQL
COPY srcs/mysql.sql ./tmp
RUN service mysql start && mysql -u root --password= < ./tmp/mysql.sql

COPY srcs/autoindex.sh ./

# ssl
# req					генерация запросов на подпись сертификата
# -x509					генерируем самоподписанный сертификат
# -nodes				без пароля
# -newkey rsa:2048		если у нас ещё нет ключа,он будет создан автоматически
# -days 365				количество дней, в течении которых будет действовать данный сертификат
# -keyout /etc...		в какой файл положить ключ
# -out /etc...			сюда положим наш сертификат
# -subj					доп. параметры
RUN openssl req -x509 -nodes -newkey rsa:2048 -days 365 \
	-keyout /etc/ssl/private/localhost.key \
	-out /etc/ssl/certs/localhost.crt \
	-subj "/C=RU/ST=MOSCOW/L=MOSCOW/O=school_21/CN=localhost"

RUN chown -R www-data /var/www/html/*
RUN chmod -R 755 /var/www/html/*

CMD		service mysql start;\
		service php7.3-fpm start;\
		service nginx start;\
		bash
