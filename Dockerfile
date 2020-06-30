FROM mattrayner/lamp:latest-1804
MAINTAINER XO <shreyassubhedar@gmail.com>
#update repo
RUN apt-get update -y
RUN apt-get upgrade -y

#install php module
RUN apt-get install -y php7.0 libapache2-mod-php7.0 php7.0-cli php7.0-common php7.0-mbstring php7.0-gd php7.0-intl php7.0-xml php7.0-mysql php7.0-mysql php7.0-mcrypt php7.0-zip

#install 
RUN apt-get install mysql-server
#copy application file
RUN rm -rf /var/www/html/*
ADD . /var/www/html

#configure apache2
RUN chown -R www-data:www-data /var/www
RUN chmod 775 -R /var/www/
ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2


#Open port 80
EXPOSE 80

#start 
CMD ["/usr/sbin/apache2ctl","-D","FOREGROUND"]