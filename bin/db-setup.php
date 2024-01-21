<?php
    $host = "";
    $port = "";
    $database = "";
    $user = "";
    $password = ""; 

    $dbHandle = pg_connect("host=$host port=$port dbname=$database user=$user password=$password");

    if ($dbHandle) {
        echo "Success connecting to database";
    } else {
        echo "An error occurred connecting to the database";
    }

    // Drop tables and sequences
    $res  = pg_query($dbHandle, "drop sequence if exists user_seq cascade;");
    $res  = pg_query($dbHandle, "drop sequence if exists countstat_seq cascade;");
    $res  = pg_query($dbHandle, "drop sequence if exists ratestat_seq cascade;");
    $res  = pg_query($dbHandle, "drop sequence if exists pctstat_seq cascade;");
    $res  = pg_query($dbHandle, "drop table if exists users cascade;");
    $res  = pg_query($dbHandle, "drop table if exists count_statistic cascade;");
    $res  = pg_query($dbHandle, "drop table if exists rate_statistic cascade;");
    $res  = pg_query($dbHandle, "drop table if exists pct_statistic cascade;");

    // Create sequences
    $res  = pg_query($dbHandle, "create sequence user_seq;");
    $res  = pg_query($dbHandle, "create sequence countstat_seq;");
    $res  = pg_query($dbHandle, "create sequence ratestat_seq;");
    $res  = pg_query($dbHandle, "create sequence pctstat_seq;");

    // Create tables
    $res  = pg_query($dbHandle, "create table users (
            id  int primary key default nextval('user_seq'),
            name text,
            email text,
            password text,
            bio text,
            acctCreationDate date,
            profilePic byteA);");

    $res = pg_query($dbHandle, "create table count_statistic (
            id int primary key default nextval('countstat_seq'),
            description text,
            featured boolean,
            tags text[],
            value int,
            creatorId int REFERENCES users (id));");
    
    $res = pg_query($dbHandle, "create table rate_statistic (
            id int primary key default nextval('ratestat_seq'),
            description text,
            featured boolean,
            tags text[],
            numerator int,
            denominator int,
            creatorId int REFERENCES users (id));");
    
    $res = pg_query($dbHandle, "create table pct_statistic (
            id int primary key default nextval('pctstat_seq'),
            description text,
            featured boolean,
            tags text[],
            numerator int,
            denominator int,
            creatorId int REFERENCES users (id));");

