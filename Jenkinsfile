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
        sh 'echo "Build stage"        '
        sh 'ssh-add -l'
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