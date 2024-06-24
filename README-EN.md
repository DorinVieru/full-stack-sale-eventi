<a name="readme-top"></a>

<!-- BADGE -->
![GitHub Issues or Pull Requests](https://img.shields.io/github/issues/DorinVieru/full-stack-sale-eventi?style=for-the-badge&logo=github&color=abff84)
![GitHub commit activity](https://img.shields.io/github/commit-activity/t/DorinVieru/full-stack-sale-eventi?style=for-the-badge&logo=github&color=%23ABFF84)
![GitHub Repo stars](https://img.shields.io/github/stars/DorinVieru/full-stack-sale-eventi?style=for-the-badge&color=abff84)
[![LinkedIn][linkedin-shield]](https://www.linkedin.com/in/dorin-vieru-1997dev/)

<!-- LOGO -->
<br />
<div align="center">
  <a href="https://github.com/DorinVieru/full-stack-sale-eventi">
    <a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="Laravel Logo">
  </a>

  <h3 align="center">Event Room Management: ResEasy</h3>

  <p align="center">
     The management software that makes your organization easier!
    <br />
    <a href="https://github.com/DorinVieru/full-stack-sale-eventi"><strong>View code »</strong></a>
  </p>
</div>


<!-- Index -->
<details>
  <summary>Index</summary>
  <ol>
    <li>
      <a href="#multilanguage">Multilanguage</a>
    </li>
    <li>
      <a href="#covered-topics">Covered Topics</a>
    </li>
    <li>
      <a href="#project-delivery">Project Delivery</a>
      <ul>
        <li><a href="#technologies-used">Technologies Used</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
          <li><a href="#about-laravel">About Laravel</a></li>
      </ul>
    </li>
    <li><a href="#documentation">Documentation</a></li>
    <li><a href="#contacts">Contacts</a></li>
    <li><a href="#license">License</a></li>
  </ol>
</details>

<!-- Multilanguage -->
## Multilanguage
Read the README in other languages: [README-IT](readme.md).

<!-- Covered Topics -->
## Covered Topics
- DB Modeling
- Migrations and Seeders
- Models and Controllers
- Web and API Routing
- Authentication
- [Anonymous functions in PHP](https://www.php.net/manual/en/functions.anonymous.php)
- File storage and image upload
- Date management (Carbon)


<!-- Project Delivery -->
## Project Delivery

<div>
 <h4>Desktop View</h4>
  <strong>:warning: Work in progress</strong>
  <h4>Mobile View</h4>
  <strong>:warning: Work in progress</strong>
</div>
<br>

📚 📑 **Delivery** <br>
We are creating a Laravel application that manages the creation and booking of Events and Meeting Rooms interactively.
There is only one type of user: admin. The admin has access to the creation of Events and Meeting Rooms and the assignment of a single Event to a Meeting Room.

The following operations are possible on events: creation and assignment to a single Meeting Room within a given date range. An event must be assigned to a available meeting room on those dates at the time of creation.

### Milestones
1️⃣ **Milestone 1** <br>
Develop an ER diagram for the application's entities and relationships.

2️⃣ **Milestone 2** <br>
Following the diagram created in the first milestone, create and populate the database using migrations and seeders (using Faker is recommended for populating the resources).

Note that a Meeting Room entity must have at least the following attributes:

- id
- name
- description
- number of available seats

While an Event entity must have at least the following attributes:

- id
- title
- description
- start date
- end date
- image
and must also have an assigned meeting room.

3️⃣ **Milestone 3**

Set up the application with a backoffice and authentication reserved for a single admin user: the admin.

4️⃣ **Milestone 4**

Add the ability to create a new Event, which must also be assigned a meeting room. In the selection, we can include all the meeting rooms.

5️⃣ **Milestone 5**

Add the ability to create a new Meeting Room.

6️⃣ **Milestone 6**

Add the ability to assign a meeting room only if it is available on the selected dates during the event creation process, checking its availability within a given date range.
A meeting room can only have one event per day; an event can last several consecutive days and only in one meeting room.

A meeting room is considered occupied when:
- There is an event on that date
  
🌟**Bonus:** <br>
Create additional CRUD operations for the two entities in the project.

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- Technologies Used -->
### Technologies Used

Here are the technologies used for creating ResEasy:

|      Nome Tecnologia      |                         Icona                                                                |
| :----------------------:  | :------------------------------------------------------------------------------------------: |
|         `Html`            |    [![My Skills](https://skillicons.dev/icons?i=html)](https://skillicons.dev)               |
|         `Css`             |  [![My Skills](https://skillicons.dev/icons?i=css)](https://skillicons.dev)                  |
|         `SASS`            |     [![My Skills](https://skillicons.dev/icons?i=sass)](https://skillicons.dev)              |
|       `Bootstrap`         |       [![My Skills](https://skillicons.dev/icons?i=bootstrap)](https://skillicons.dev)       |
|      `Javascript`         |       [![My Skills](https://skillicons.dev/icons?i=js)](https://skillicons.dev)              |
|        `Laravel`          |    [![My Skills](https://skillicons.dev/icons?i=laravel)](https://skillicons.dev)            |
|          `PHP`            |    [![My Skills](https://skillicons.dev/icons?i=php)](https://skillicons.dev)                |
|         `MySQL`           |    [![My Skills](https://skillicons.dev/icons?i=mysql)](https://skillicons.dev)              |
|          `npm`            |    [![My Skills](https://skillicons.dev/icons?i=npm)](https://skillicons.dev)                |

<p align="right">(<a href="#readme-top">back to top</a>)</p>


<!-- Getting Started -->
## Getting Started
### :no_entry: The instructions are not yet completed, so please wait before proceeding to clone the project locally. :no_entry: 

If you want to install the application locally, there are several steps to follow. I have summarized them below; if there are complications, I refer you to the official documentation for every command you need to enter.
<!-- Prerequisites -->
### Prerequisites

First of all, it is essential to initialize/create a new folder locally. We will use the terminal, typing the necessary command to install Laravel.

  ```
  composer create-project laravel/laravel project_name
  ```
By "project_name" we mean the name of your personal project that you want to create, not the project to clone from GitHub.

<!-- Installation -->
### Installation

_Below is an example of how to clone the repo locally, but it is not the only method. If you are aware of a better method, use it._

1. Once inside Visual Studio Code, open the terminal by going to the menu item 'Terminal' and then 'New Terminal'
2. Clone the repo by typing the following command:
   ```
   git clone https://github.com/DorinVieru/full-stack-sale-eventi.git
   ```
3. Install composer
   ```
   composer install
   ```
4. Start PHP Launcher (if you use Windows) or MAMP (if you use Mac)
5. Then you can run the command for npm
   ```
   npm run dev
   ```
6. Finally, start the application with php
   ```
   php artisan serve
   ```

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- LARAVEL TO LEARN MORE -->
## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- Documentation -->
## Documentation

Here is the list of official documentation for the services used:
- [npm](https://www.npmjs.com/)
- [Laravel](https://laravel.com/docs)
- If you want to learn more about Laravel, here's where you can: [Laravel Bootcamp](https://bootcamp.laravel.com) or [Laracasts](https://laracasts.com).
- [PHP](https://www.php.net/docs.php)
- [MySQL](https://dev.mysql.com/doc/) (for database)
- [Bootstrap](https://getbootstrap.com/) (project styling)
- [Google Fonts](https://fonts.google.com/) for the project's font

<p align="right">(<a href="#readme-top">back to top</a>)</p>


<!-- Contacts -->
## Contacts

Dorin Vieru
- Linkedin: https://www.linkedin.com/in/dorin-vieru-1997dev/
- Email: <a href="mailto:info@dorinvieru.it">info@dorinvieru.it</a>

Project link: [https://github.com/DorinVieru/full-stack-sale-eventi](https://github.com/DorinVieru/full-stack-sale-eventi)

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- License -->
## License
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

<p align="right">(<a href="#readme-top">back to top</a>)</p>


<!-- MARKDOWN LINKS -->
[linkedin-shield]: https://img.shields.io/badge/-LinkedIn-black.svg?style=for-the-badge&logo=linkedin&colorB=555
[linkedin-url]: https://linkedin.com/in/othneildrew
