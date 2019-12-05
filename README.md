# DLArtist

DLArtist是一个基于人工智能的，对用户输入的文章进行自动排版，图片进行智能裁剪，并且提供插图自动生成的排版设计网站。

## 开始部署

这些说明将为您提供在本地计算机上启动和运行的项目副本，以进行开发和测试。有关如何在实时系统上部署项目的说明，请参阅部署。

### 配置要求

布置该项目前需要安装好这些环境

```
1. Ubuntu 16.04+
2. nginx
3. swoole
4. mysql 5.5+
5. php 7.1+
6. composer
7. npm
8. python 2.7 & python 3.6
```

### 修改cron文件
```
用该命令打开cron目录
crontab -e

Here is the only Cron entry you need to add to your server:

* * * * * php /path/to/artisan schedule:run >> /dev/null 2>&1

This Cron will call the Laravel command scheduler every minute. Then, Laravel evaluates your scheduled tasks and runs the tasks that are due.
```

### .env配置
```
APP_NAME=DLArtist
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=redis
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=smtp.163.com
MAIL_PORT=465
MAIL_USERNAME=dlartist@163.com
MAIL_PASSWORD=dlartist123
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=dlartist@163.com
MAIL_FROM_NAME=goodfellow

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

```

### 安装

1. clone该项目到你的本地目录下
2. 在你的终端中用`cd`进入到项目文件夹下
3. 在你的终端中运行`composer install`
4. 将`.env.example`文件复制到项目主目录下的`.env`文件
5. 打开`.env`文件，并将DB_DATABASE改成你相应的数据库名称，DB_USERNAME改成相应的数据库用户名, DB_PASSWORD改成相应的用户密码
6. 运行 `php artisan key:generate`
7. 运行 `php artisan migrate`
8. 运行 `php artisan serve`
9. 浏览器访问`localost:8000`

