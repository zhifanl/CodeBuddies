# CodeBuddies💻
![alt text](https://github.com/zhifanl/CodeBuddies/blob/main/demo/img/CodeBuddies.png?raw=true)


## The platform to help you boost programming skills🛠


[![Build Status](https://app.travis-ci.com/zhifanl/Docker-CI-CD.svg?branch=main)

✨ ✨CodeBuddies is our CPSC471 Final Project✨ ✨

- Team member: Zhifan Li, Tianfan Zhou, Taimoor Abrar


## 💡Features💡

- Allow users to send request to learn courses via CodeBuddies website
- User will receive email notification for the booked appointment with our teachers
- Users can view the orders, and list of courses and tutors.
- Admin can manager the user status, course status, tutor status, order status (approval, rejection), see the request list.




## 💡Technology used💡


- php
- HTML 
- CSS 
- Javascript
- MySQL
- SendGrid API



## 💡How to run it💡

* Clone our repository
* Download XAMPP
* run the Apache web server and MySQL database on XAMPP
* copy the ``demo`` folder from this repository to the inside of ``htdocs`` folder at XAMPP's general folder
* Go to browse to enter ``http:localhost{{your port#}}/phpmyadmin``, then create a new database called `471`, then import the sql file from the DB_Backup folder, that will be our database for the website. 
* Now you can access the website via ``http:localhost/demo``
* If it does not work, make sure the port number is correct (you will know which port the Apache server is using by finding it on XAMPP, mine is 80, someone's port is 8080), then try ``http:localhost:{{your port#}}/demo``
* To use sending email features, you need to go to XAMPP appilcation folder: xamppfiles/etc, then go to httpd.config file and add ``SetEnv SENDGRID_API_KEY {{YOUR_API_KEY}}`` at the very end of the file and save it. Then restart XAMPP.
* To login as Admin, simply create a new user on your localhost with username: admin
* The webiste still has areas of improvement we are still developing it to make it look better :/



## 💡Development💡

Want to contribute? Great!
