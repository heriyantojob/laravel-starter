# ☁️ How to Deploy to Google Cloud Run (Simple Guide)

Panduan lengkap deploy aplikasi (Laravel / API / Web) ke Google Cloud Run menggunakan Docker + Cloud Build.

---

# 📦 1. SET VARIABLE

Gunakan variable agar lebih fleksibel dan tidak hardcode:

```bash
export PROJECT_NAME="demo"
export APP_NAME="api"
export REGION="asia-southeast1"


gcloud auth login
gcloud config set project ${PROJECT_NAME}
gcloud config set run/region ${REGION}

gcloud builds submit \
  --tag gcr.io/${PROJECT_NAME}/${APP_NAME}:latest \
  --project ${PROJECT_NAME}

  gcloud run services replace service.yaml \
  --region ${REGION} \
  --project ${PROJECT_NAME}


  gcloud builds submit \
  --tag gcr.io/${PROJECT_NAME}/${APP_NAME}:latest

gcloud run services replace service.yaml \
  --region ${REGION} \
  --project ${PROJECT_NAME}