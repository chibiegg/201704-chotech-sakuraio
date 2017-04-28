# 201704-chotech-sakuraio

このスクリプトは、2017年4月の超技術書典にて頒布した「sakura.ioを用いたIoT入門」で利用するサンプルスクリプトです。


## デプロイ

PHPが実行可能なWebサーバに設置し、MySQLと合わせて利用します。

設置の際には `config.php.sample` を参考に `config.php` を作成する必要があります。


### Clone

設置するディレクトリに `git clone` でリポジトリをクローンしてください。

```bash
git clone https://github.com/chibiegg/201704-chotech-sakuraio.git sakuraio
```


### Create config file

`config.php.sample` を参考に `config.php` を作成してください。

```bash
cd sakuraio
cp config.php.sample config.php
vim config.php
```


### Create table

`schema.sql` をMySQLで実行し、データベースにテーブルを作成してください。


### sakura.io

設置したら、sakura.ioにて、Outgoing Webhookのサービス連携を作成し、設置したリポジトリ内の `webhook.php` のURLを指定してください。
