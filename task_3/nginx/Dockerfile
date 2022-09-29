FROM nginx
WORKDIR /usr/share/nginx/html-s
# If you add a custom CMD in the Dockerfile, be sure to include -g daemon off;
# in the CMD in order for nginx to stay in the foreground, so that Docker can track the process properly
# (otherwise your container will stop immediately after starting)!
CMD ["nginx", "-g", "daemon off;"]