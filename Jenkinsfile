node {
   sh script: '${COMPOSER_BIN} update'
   sh script: './bin/codecept build'
   sh script: './bin/codecept run unit --report --steps'
   deleteDir()
}