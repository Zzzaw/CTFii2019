use mysql;
update user set password=password("password") where user='root';
flush privileges;
source jnuctf_setup/ctf_01.sql;
