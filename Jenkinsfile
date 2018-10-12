pipeline {
  agent any
  stages {
    stage('Build') {
      agent {
        docker {
          image 'alpine:3.7'
        }

      }
      steps {
        sh '''apk update && apk add git wget libressl php7 php7-phar php7-json php7-iconv php7-mbstring php7-openssl php7-dom php7-tokenizer php7-pear php7-redis php7-dev build-base tar && \\
wget https://getcomposer.org/download/1.7.2/composer.phar -O /usr/bin/composer && \\
chmod +x /usr/bin/composer && \\
rm -rf forecast-tools && \\
git clone https://github.com/kabudu/forecast-tools.git && \\
cd forecast-tools && \\
git checkout jenkins-pipeline && \\
/usr/bin/composer install && \\
cd ../ && \\
tar -zcvf forecast-tools-build.tar.gz forecast-tools/'''
        stash(name: 'build-files', includes: 'forecast-tools-build.tar.gz')
      }
    }
    stage('Tests') {
      parallel {
        stage('Unit') {
          agent {
            docker {
              image 'alpine:3.7'
            }

          }
          steps {
            sh '''apk update && apk add git wget libressl php7 php7-phar php7-json php7-iconv php7-mbstring php7-openssl php7-dom php7-tokenizer php7-pear php7-dev php7-redis build-base tar && \\
pecl install redis-4.1.1 && \\
echo "extension=redis.so" > /etc/php7/conf.d/redis.ini && \\
cd /tmp/ && \\
wget https://getcomposer.org/download/1.7.2/composer.phar -O /usr/bin/composer && \\
chmod +x /usr/bin/composer'''
            unstash 'build-files'
            sh '''echo pwd && \\
ls -la'''
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