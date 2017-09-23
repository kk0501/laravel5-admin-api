# laravel5 api
## 这是一个使用laravel5.5 + dingo + jwt + cors + laravel admin开发的一个api框架.

## 安装步骤
### use composer 
```
composer create-project kk0501/laravel5-admin-api
php artisan api:install
```
### or 
### use git
```
1. git clone https://github.com/kk0501/laravel5-admin-api.git
2. cp .env.example .env
3. 修改数据库配置
4. php artisan jwt:secret
5. php artisan api:install
```
执行完上面的步骤， 即可开始使用
## useage:
- 访问:http://your-domain:port/admin, 默认登录信息为admin/admin

## 参考
- [Laravel5.5](https://github.com/laravel/laravel)
- [Laravel Debugbar](https://github.com/kk0501/laravel-debugbar)
- [Laravel-admin](https://github.com/kk0501/laravel-admin)
- [Dingo Api](https://github.com/dingo/api)
- [Jwt auth](https://github.com/tymondesigns/jwt-auth)
- [Laravel cors](http://github.com/barryvdh/laravel-cors)
