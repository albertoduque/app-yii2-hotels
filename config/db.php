<?php

$server = 'ec2-174-129-24-148.compute-1.amazonaws.com';
$username = 'xusvbyovpywkup';
$password = '9fdc354e3dabdfdd49b568861125854d8c0e171162dfe8481ef6b15ea91be57f';
$db = 'dfa4pqm9hvqdnp';


return [
  'class' => 'yii\db\Connection',
  'dsn' => 'pgsql:host='.$server.';dbname='.$db,
  'username' => $username,
  'password' => $password,
  'charset' => 'utf8',
  'schemaMap' => [
      'pgsql' => [
        'class' => 'yii\db\pgsql\Schema',
        'defaultSchema' => 'public' //specify your schema here, public is the default schema
      ]
  ]
  
  // Schema cache options (for production environment)
  //'enableSchemaCache' => true,
  //'schemaCacheDuration' => 60,
  //'schemaCache' => 'cache',
];
