pipeline {
  agent any
  options {
    buildDiscarder(logRotator(numToKeepStr: '5'))
  }
  environment {
    HEROKU_API_KEY = credentials('hroku-api-key')
    DOCKERHUB_CREDENTIALS=credentials('docker')
    IMAGE_NAME = 'ztrade/omni'
    IMAGE_TAG = 'latest'
    APP_NAME = 'omni'
  }
  stages {
    stage('print'){
        steps{
             bat 'echo "Hello World"'
        }
    }
    stage('Docker') {
      steps {
        bat '''
        docker info 
        docker version
        docker compose version
        curl --version
        
        '''
      }
    }
    stage('Build') {
      steps {
        bat 'docker build -t ztrade/omni:latest .'
      }
    }
    stage('Login') {
      steps {
        bat 'echo $DOCKERHUB_CREDENTIALS_PSW | docker login -u $DOCKERHUB_CREDENTIALS_USR --password-stdin registry.heroku.com'
      }
    }
    stage('Push to Heroku registry') {
      steps {
        bat '''
          heroku login
          docker tag ztrade/omni:latest registry.heroku.com/omni/web
          docker push registry.heroku.com/omni/web
        '''
      }
    }
    stage('Release the image') {
      steps {
        bat '''
          heroku container:release web
        '''
      }
    }
  }
  post {
    always {
      bat 'docker logout'
    }
  }
}