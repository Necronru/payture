node {
   checkout([$class: 'GitSCM', branches: [[name: '*/master']], doGenerateSubmoduleConfigurations: false, extensions: [], submoduleCfg: [], userRemoteConfigs: [[credentialsId: '${CREDENTIALS_NAME}', url: 'https://github.com/Necronru/payture.git']]])
   sh script: '${COMPOSER_BIN} update'
   sh script: './bin/codecept build'
   sh script: './bin/codecept run unit --report --steps'
   deleteDir()
}