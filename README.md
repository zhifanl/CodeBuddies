# CodeBuddies💻
![alt text](https://github.com/zhifanl/CodeBuddies/blob/main/demo/img/CodeBuddies.png?raw=true)


## The platform to help you boost programming skills🛠


[![Build Status](https://travis-ci.org/joemccann/dillinger.svg?branch=master)](https://travis-ci.org/joemccann/dillinger)

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
* Remember that the password must be longer than 5 characters.
* If you log in as a student: you can see a list of courses, list of teachers, a list of the courses that you have ordered, a list of appointments that you have with your mentor, an area for updating your personal information, and at the end there is a form for submitting a request to take a course.
* First you can view the courses and teachers, then go to the end of the page to submit a request if you want to take a course.
* By entering your username, email, teacher’s name and course name, then clicking
submit, this request will be shown on the admin’s end.
* Now, for the purpose of testing, you can log out and log in as an admin
* You can register as an admin by creating a user with username as admin with any
password you like.
* As admin, you can first see a form for sending emails, and a list of orders and
requests,list of teachers and list of courses, you can view the users and have full access to them, at the end there is a form for creating appointments with students.
* Now, you will see there is a new request and new order listed at the same time. The list of requests is for recording the requests that the student has sent, and the admin can delete it, the purpose of request is just for the admin to look up, nothing else. The list of orders is for the admin to approve or reject: the last column of the table has two icons: first is approving the request, second one is rejecting it. Once the admin approves the order, this order will be added to the student's list of ordered courses. Once the admin ignores the order, it will be removed from the order list from both admin and student sides.
* Now you can approve that order, and log out
* Now login as a student, you will see that there’s a new row added at the List of Courses You Have section. That is the course that you just ordered.
* Now since the course is ordered, the admin can login and at the Send Email section:
Send an email to student for asking appointments. Now they can communicate through
email, which is a faster and safer way since the message is encrypted on both ends.
* Once they confirm the date and other stuff. Admin can use the Add Appointment feature located at the end of the admin's website.
* Admin will enter the student’s email, name, teacher’s name, course and date, then click submit. This appointment information will be added to both Admin’s Web UI, and normal student’s Web UI.
* Now once the student is logged in, the appointment that the admin added will be shown to the student.
* This website has error checking functionalities, so everytime you put some wrong input, it will prompt you to enter again.
* These are the full functionality of this website. This will also be included in the user manual at the last section of this report.


## 💡Development💡

Want to contribute? Great!
