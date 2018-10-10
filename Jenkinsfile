pipeline {
  agent any
  stages {
    stage('Build') {
      agent {
        docker {
          image 'alpine:3.8'
        }

      }
      steps {
        sh '''apk update && apk add git wget php7 php7-phar && \\
cd /tmp/ && \\
wget https://getcomposer.org/download/1.7.2/composer.phar -O /usr/bin/composer && \\
chmod +x /usr/bin/composer && \\
git clone https://github.com/kabudu/forecast-tools.git && \\
cd forecast-tools && \\
git checkout jenkins-pipeline && \\
/usr/bin/composer install'''
      }
    }
    stage('Tests') {
      parallel {
        stage('Unit') {
          steps {
            sh 'echo Tests'
          }
        }
        stage('Performance') {
          steps {
            sh 'echo "Step Performance"'
          }
        }
      }
    }
    stage('Static Analysis') {
      steps {
        sh 'echo "Static Analysis"'
      }
    }
    stage('Deploy') {
      steps {
        sh 'echo Deploy'
      }
    }
  }
}