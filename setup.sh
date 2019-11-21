#!/bin/bash

echo 'starting mysql....'
service mysql start
sleep 3

echo 'setup mysql....'
mysql < /jnuctf_setup/mysql_setup.sql
echo 'setup finished'
