ARG ELASTIC_VERSION

# https://www.docker.elastic.co/
FROM docker.elastic.co/elasticsearch/elasticsearch:${ELASTIC_VERSION}

# Sao chép entrypoint.sh vào thư mục gốc của container
COPY entrypoint.sh /entrypoint.sh

# Đảm bảo entrypoint.sh có quyền thực thi
RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]
