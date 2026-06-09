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
sudo microk8s kubectl create -f app-laravel.yaml

sudo microk8s kubectl replace -f app-laravel.yaml

sudo microk8s kubectl get pod 


sudo microk8s kubectl port-forward app-laravel 8080:8080

sudo microk8s kubectl port-forward pod/app-laravel 5000:8080
sudo microk8s kubectl port-forward app-laravel 8080:8000

sudo microk8s kubectl delete pod "app-laravel"

sudo microk8s kubectl delete pods --all

sudo microk8s kubectl delete deployment --all