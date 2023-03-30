pipeline {
  agent any
  options {
    buildDiscarder(logRotator(numToKeepStr: '5'))
  }
  environment {
    HEROKU_API_KEY = credentials('hroku-api-key')
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
        bat 'echo $HEROKU_API_KEY | docker login --username=_ --password-stdin registry.heroku.com'
      }
    }
    stage('Push to Heroku registry') {
      steps {
        bat '''
          docker tag $IMAGE_NAME:$IMAGE_TAG registry.heroku.com/$APP_NAME/web
          docker push registry.heroku.com/$APP_NAME/web
        '''
      }
    }
    stage('Release the image') {
      steps {
        bat '''
          heroku container:release web --app=$APP_NAME
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