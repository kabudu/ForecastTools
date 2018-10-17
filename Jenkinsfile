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
        withCredentials(bindings: [sshUserPrivateKey(credentialsId: "deployitan-github", keyFileVariable: 'KEY_FILE')]) {
          sh 'apk update && apk add openssh-client git'
          sh 'mkdir -p ~/.ssh && ssh-keyscan -t rsa github.com >> ~/.ssh/known_hosts'
          sh 'rm -rf offers-engine'
          sh "GIT_SSH_COMMAND='ssh -i $KEY_FILE' git clone git@github.com:DocnetUK/offers-engine.git"
        }

        sh 'echo "Build stage"'
        sh 'ls -la $(PWD) && cd offers-engine && ls -la'
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
            sh '''
            echo "Unit stage"
            '''
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
        withCredentials(bindings: [usernameColonPassword(credentialsId: 'test-creds', variable: 'USERPASS')]) {
          sh '''set +x
echo "Static Analysis" && echo "UserPass is: $USERPASS"
              '''
        }

      }
    }
    stage('Deploy') {
      steps {
        sh 'echo Deploy'
      }
    }
  }
}