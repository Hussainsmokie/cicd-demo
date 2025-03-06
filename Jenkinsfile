pipeline {
    agent {
        docker {
            image 'node:18' // Runs inside a Node.js container
            args '--user root' // Ensures necessary permissions
        }
    }

    environment {
        DOCKERHUB_CREDENTIALS = credentials('docker-hub-credentials') // Jenkins credential ID 
        SONARQUBE_SERVER = 'SonarQube'
        DOCKER_REPO = 'cicd'
    }

    stages {
        stage('Checkout Code') {
            steps {
                git branch: 'main', url: 'https://github.com/Hussainsmokie/cicd-demo'
            }
        }

        stage('SonarQube Analysis') {
            agent {
                docker {
                    image 'sonarsource/sonar-scanner-cli' // Runs in SonarScanner container
                }
            }
            steps {
                script {
                    withSonarQubeEnv('SonarQube') {
                        sh 'sonar-scanner -Dsonar.projectKey=my-project -Dsonar.sources=.'
                    }
                }
            }
        }

        stage('Build Docker Images') {
            agent {
                docker {
                    image 'docker:latest' // Runs inside Docker container
                    args '--privileged -v /var/run/docker.sock:/var/run/docker.sock'
                }
            }
            steps {
                sh """
                docker build -t $DOCKER_REPO/react-frontend:latest -f frontend/Dockerfile .
                docker build -t $DOCKER_REPO/php-backend:latest -f backend/Dockerfile .
                """
            }
        }

        stage('Push to Docker Hub') {
            steps {
                script {
                    sh """
                    echo $DOCKERHUB_CREDENTIALS_PSW | docker login -u $DOCKERHUB_CREDENTIALS_USR --password-stdin
                    docker push $DOCKER_REPO/react-frontend:latest
                    docker push $DOCKER_REPO/php-backend:latest
                    """
                }
            }
        }

        stage('Deploy to Minikube') {
            agent {
                docker {
                    image 'bitnami/kubectl' // Runs inside a Kubectl container
                }
            }
            steps {
                sh "kubectl apply -f k8s/"
            }
        }
    }

    post {
        success {
            echo 'Deployment successful!'
        }
        failure {
            echo 'Deployment failed!'
        }
    }
}

