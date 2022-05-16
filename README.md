# simple-mvc

平平无奇MVC

## nginx配置

需要在server里面的location中加入
try_files $uri $uri/ /index.php$args;
