# Use official Nginx image as base
FROM nginx:alpine

# Remove the default website
RUN rm -rf /usr/share/nginx/html/*

# Copy your custom website files into container
COPY . /usr/share/nginx/html

# Expose port 80 for web traffic
EXPOSE 80

# Start Nginx automatically
CMD ["nginx", "-g", "daemon off;"]
