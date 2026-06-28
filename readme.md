# IIT Delhi US Trip — Registration Portal
 
A single-page registration website built with PHP and MySQL for an IIT Delhi US trip program. Visitors can view trip details and submit a registration form, which is validated on both the client and server side before being stored in a database.
 
## Preview
 
A landing page with a hero banner and trip highlights, followed by a registration form that collects participant details (name, age, gender, email, phone, and a short bio) and stores submissions in MySQL.
 
## Tech Stack
 
- **Backend:** PHP, MySQL (via `mysqli`)
- **Frontend:** HTML5, CSS3, vanilla JavaScript
- **Tools:** Git, GitHub, VS Code, XAMPP / WAMP / MAMP (or any local PHP + MySQL server)
## Features
 
- Landing page with hero section and trip highlights
- Client-side form validation (name, age, email) before submission
- Server-side validation and sanitization of all form inputs
- Confirmation and error messages rendered after submission
- Responsive layout for desktop and mobile
- Focus states and a confirm-before-clear reset action on the form
## Project Structure
 
```
us-trip-registration/
├── index.php          # Main page: markup, styling, PHP form handler, and JS validation
└── README.md
```
 
## Database Setup
 
This project expects a MySQL database named `USTravel` with a `Trip` table.
 
1. Create the database:
```sql
   CREATE DATABASE USTravel;
```
 
2. Create the table:
```sql
   USE USTravel;
 
   CREATE TABLE Trip (
       id     INT AUTO_INCREMENT PRIMARY KEY,
       name   VARCHAR(100) NOT NULL,
       age    INT NOT NULL,
       gender VARCHAR(30),
       email  VARCHAR(150) NOT NULL,
       phone  VARCHAR(20),
       other  TEXT,
       date   DATETIME NOT NULL
   );
```
 
3. Update the database connection details in `index.php` to match your local environment:
```php
   $server   = "localhost";
   $username = "root";
   $password = "";
   $database = "USTravel";
```
 
   The default credentials in this project (`root` / empty password) are intended for local development only. Update them before deploying anywhere publicly accessible.
 
## Getting Started
 
1. Clone the repository
```bash
   git clone https://github.com/Maynkbisht/registrationForm.git
```
 
2. Move the project folder into your local server's web root (for example, `htdocs` for XAMPP, or `www` for WAMP).
3. Start your local Apache and MySQL services.
4. Set up the database as described above.
5. Open the project in your browser:
```
   http://localhost/us-trip-registration/index.php
```
 
## Form Validation
 
- **Client-side:** Checks that the name and email fields are filled, the email contains an `@`, and the age is a positive number, before the form is submitted.
- **Server-side:** All inputs are sanitized with `mysqli_real_escape_string` (and `intval` for age) before being inserted into the database, and the database connection is checked before any query runs.
## Future Improvements
 
- Move database credentials to environment variables instead of hardcoding them
- Use prepared statements instead of escaped string interpolation
- Add server-side email format validation (e.g. `filter_var` with `FILTER_VALIDATE_EMAIL`)
- Add a confirmation email to registrants after successful sign-up
- Add an admin view to list and export registrations
## Contributing
 
Contributions are welcome. Feel free to fork this repository and submit a pull request.
 
## License
 
This project is open-source and available under the [MIT License](LICENSE).
 
