FROM php:8.2-apache

# ติดตั้ง libcurl ก่อน
RUN apt-get update \
    && apt-get install -y libcurl4-openssl-dev \
    && docker-php-ext-install curl \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# คัดลอกไฟล์ทั้งหมดเข้า Apache
COPY . /var/www/html/

EXPOSE 80
