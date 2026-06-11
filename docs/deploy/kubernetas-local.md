-----------------
deploy docker
-----------------
docker build -t heriyantojob/laravel-app:latest .
docker login
docker images | grep laravel-app

docker push heriyantojob/laravel-app:latest

docker run -d \
  --name laravel-app \
  -p 8080:8080 \
  --env-file .env \
  heriyantojob/laravel-app:latest
  
  docker rm -f laravel-app

-----------------
deploy kubernetas
-----------------
sudo  kubectl create -f app-laravel.yaml

sudo  kubectl replace -f app-laravel.yaml

sudo  kubectl get pod 


sudo  kubectl port-forward app-laravel 8080:8080

sudo  kubectl port-forward pod/app-laravel 5000:8080
sudo  kubectl port-forward app-laravel 8080:8000

sudo  kubectl delete pod "app-laravel"

sudo  kubectl delete pods --all

sudo  kubectl delete deployment --all