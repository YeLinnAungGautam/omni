pipeline {
  agent any
  options {
    buildDiscarder(logRotator(numToKeepStr: '5'))
  }
  environment {
    HEROKU_API_KEY = credentials('hroku-api-key')
    DOCKERHUB_CREDENTIALS=credentials('docker')
    HEROKU_TOKEN=credentials('heroku-token')
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
        bat 'echo %DOCKERHUB_CREDENTIALS_PSW%'
        bat 'echo %HEROKU_API_KEY% | docker login --username=_ --password=%HEROKU_TOKEN% registry.heroku.com'
      }
    }
    stage('Push to Heroku registry') {
      steps {
        bat '''
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