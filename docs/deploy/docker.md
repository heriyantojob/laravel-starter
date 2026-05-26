docker build -t laravel_starter:test -f Dockerfile .

docker run -p 8080:8080 laravel_starter:test