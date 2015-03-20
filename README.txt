Hair Salon Program

Allows to add Stylists and list of clients for that Stylist into the database.

To CREATE DATABASE:
In psql type:
CREATE DATABASE hair_salon;
\c hair_salon;
CREATE TABLE clients (id serial PRIMARY KEY, name varchar, phone varchar, email varchar, stylist_id int);
CREATE TABLE stylists (id serial PRIMARY KEY, name varchar);
CREATE DATABASE hair_salon_test WITH TEMPLATE hair_salon;

Copyright 2015, Evan Butler
