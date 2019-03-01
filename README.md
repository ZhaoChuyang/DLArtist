# DLArtist

DLArtist是一个基于人工智能的，对用户输入的文章进行自动排版，图片进行智能裁剪，并且提供插图自动生成的排版设计网站。

## 开始部署

这些说明将为您提供在本地计算机上启动和运行的项目副本，以进行开发和测试。有关如何在实时系统上部署项目的说明，请参阅部署。

### 配置要求

布置该项目前需要安装好这些环境

```
1. Ubuntu 16.04 LTS
2. apache2
3. mysql 5.7
4. php 7.2
5. composer
6. npm
7. python 2.7和python 3.6
```

### 安装

1. clone该项目到你的本地目录下
2. 在你的终端中用`cd`进入到项目文件夹下
3. 在你的终端中运行`composer install`
4. 将`.env.emample`文件复制到项目主目录下的`.env`文件
5. 打开`.env`文件，并将DB_DATABASE改成你相应的数据库名称，DB_USERNAME改成相应的数据库用户名, DB_PASSWORD改成相应的用户密码
6. 运行 `php artisan key:generate`
7. 运行 `php artisan migrate`
8. 运行 `php artisan serve`
9. 浏览器访问`localost:8000`

