FROM php:7.3.0-apache
RUN apt-get update -y && \
	docker-php-ext-install mysqli && \
	docker-php-ext-install pdo_mysql
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY . ./PHPapp
WORKDIR ./PHPapp
CMD ["php", "-S", "0.0.0.0:3000", "-t","public"]
ENV DB_P=germania
ENV DB_U=root
ENV DB_S=msinformation.cpxn66rywhwf.us-east-1.rds.amazonaws.com
ENV DB_N=MS_Information
