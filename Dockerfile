FROM tutum/lamp

#将所需文件放到容器中
COPY . /jnuctf_setup

RUN rm -rf /var/www/html  \
 && mv jnuctf_setup/html /var/www  \
 && mv jnuctf_setup/php.ini /etc/php5/apache2  \
 && chmod +x /jnuctf_setup/setup.sh  

#设置容器启动时执行的命令
#CMD ["/jnuctf_setup/setup.sh"]

