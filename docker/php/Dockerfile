# https://hub.docker.com/_/phpにあるイメージファイルを指定
FROM php:8.2-fpm

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

COPY php.ini /usr/local/etc/php/

# RUNコマンドは、buildしたときに元となるdockerイメージに対して実行する処理を記述する。
# \（バックスラッシュ）を用いて、複数行に分けることが可能。
# パッケージ一覧を更新
RUN apt update \
    # zlibはデータの圧縮に関するアルゴリズムをライブラリ化したもの
    # vimをインストール
    # MariaDBデータベースのクライアントアプリケーションである「mysql」を使えるように「mariadb-client」をインストール
    # libzip-devはzip圧縮時に必要となるライブラリ(libzip は、zlib を使用する)
    && apt install -y zlib1g-dev mariadb-client vim libzip-dev libpng-dev libjpeg62-turbo-dev \
    # docker-php-ext-installはPHPに標準で備わっている拡張パッケージのインストール＆有効化ができるコマンド
    # PDO_MYSQL は、PHP から MySQL データベースへのアクセスを可能にするための PHP Data Objects (PDO) インターフェイス を実装したドライバ。
    && docker-php-ext-install zip pdo_mysql \
    # gdをインストール
    && apt-get install -y libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype \
    # JPEG 対応(上記に追加した場合は、エラーになったので再度、インストールを実行)
    && docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    # gitのインストール
    && apt install -y git \
    && apt install -y ffmpeg \
    && apt install -y libgmp-dev \
    && docker-php-ext-install gmp

# @exif_read_data()対応
RUN docker-php-ext-install exif

RUN apt-get -y install unzip

# Composerのインストール & パス通す
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# nodeインストール(aptだとNodejsは古いため、パッケージマネージャの n を使用してインストール)
RUN apt install -y npm \
    && npm install n -g \
    && n stable

# rootでのインストールを許可
ENV COMPOSER_ALLOW_SUPERUSER 1

ENV PATH $PATH:/composer/vendor/bin

# RUN , CMD , ENTRYPOINT , COPY , ADD を実行する時のワーキングディレクトリを指定
WORKDIR /var/www
