FROM mattrayner/lamp:latest-1804
MAINTAINER XO <shreyassubhedar@gmail.com>

#copy application file
ADD . /app/
#Open port 80
EXPOSE 80
#start 
CMD ["/run.sh"]