# Sử dụng hình ảnh cơ sở từ Ubuntu
FROM ubuntu:20.04

# Cài đặt các công cụ cần thiết và Elasticsearch
RUN apt-get update && \
    apt-get install -y wget gnupg curl && \
    wget -qO - https://artifacts.elastic.co/GPG-KEY-elasticsearch | apt-key add - && \
    echo "deb https://artifacts.elastic.co/packages/8.x/apt stable main" | tee -a /etc/apt/sources.list.d/elastic-8.x.list && \
    apt-get update && \
    apt-get install -y elasticsearch && \
    apt-get clean

# Sao chép entrypoint.sh và lib.sh vào container
COPY entrypoint.sh /entrypoint.sh
COPY lib.sh /lib.sh

# Đảm bảo các tệp có quyền thực thi nếu cần
RUN chmod +x /entrypoint.sh

# Đặt entrypoint
ENTRYPOINT ["/entrypoint.sh"]

# Chạy Elasticsearch khi container khởi động
CMD ["elasticsearch"]
