FROM nginx:1.18-alpine
WORKDIR /work
COPY default.conf /etc/nginx/conf.d/default.conf
# 上、開発用
#
# 以下、 ECR への PUSH 用COPY、開発時不要
# app ディレクトリを ./nginx 下に置いてから実行すること
# COPY ./app /work