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
        sh '''apk update && apk add git wget libressl php7 php7-phar php7-json php7-iconv php7-mbstring php7-openssl php7-dom php7-tokenizer php7-pear php7-dev build-base tar && \\
pecl install redis-4.1.1 && \\
echo "extension=redis.so" > /etc/php7/conf.d/redis.ini && \\
cd /tmp/ && \\
wget https://getcomposer.org/download/1.7.2/composer.phar -O /usr/bin/composer && \\
chmod +x /usr/bin/composer && \\
git clone https://github.com/kabudu/forecast-tools.git && \\
cd forecast-tools && \\
git checkout jenkins-pipeline && \\
/usr/bin/composer install && \\
cd /tmp/ && \\
tar -zcvf forecast-tools-build.tar.gz jenkins-pipeline/'''
        stash(name: 'Built repo code', includes: '/tmp/forecast-tools-build.tar.gz')
      }
    }
    stage('Tests') {
      parallel {
        stage('Unit') {
          steps {
            unstash 'forecast-tools-build.tar.gz'
            sh 'echo "Tests"'
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