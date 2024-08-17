docker stop king-study-website  || true
docker container rm -f king-study-website || true
docker rmi king-study-website || true
docker system prune
docker build -t king-study-website .
docker run -d -p 3000:3000 --name king-study-website king-study-website
