sudo microk8s kubectl create -f app-laravel.yaml

sudo microk8s kubectl get pod 


sudo microk8s kubectl port-forward app-laravel 8080:8080

sudo microk8s kubectl delete pod "app-laravel"

sudo microk8s kubectl delete pods --all

sudo microk8s kubectl delete deployment --all