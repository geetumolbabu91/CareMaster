#  Documentation.

 <h3>Frontend folder – CMP_frontend(Vue)</h3>
<h3> Backend folder -  CMP_backend (laravel) </h3>

<b>Frontend Login using Vue. </b>
Username : admin@admin.com
Password: password
(Created database seeds for user).

<b>Authentication </b>
<p>Using Laravel sanctum. A token is created on user login and used as a Bearer token for making API calls. The token is destroyed while logout. This token will be displayed on the home page for checking API requests through Postman for the time being.</p>
 

<b> Companies </b>
<ul>
<li>created migration and factories (for initial 15 employees) </li>
<li> Resource controller index, store, update and delete function for CRUD operation.</li>
<li>Created symbolic link from public/storage to storage/app/public for logos.</li>
<li>	Validation is done using Request classes.</li>
<li>	Used mail trap for sending email notifications whenever a new company is stored.</li>
<li>	Used Laravel pagination to list(backend).</li>
</ul>
<b>	Employees</b>
<ul>
 <li>Created migration<li>
<li>Used Resource controller index, store, update and delete function for CRUD operation.</li>
<li>Validation is done using Request classes</li>
</ul>
All routes are listed in the routes/api.php file.

<b>Testing with PHPUnit</b>
<p>Testing is done for companies and employees (CRUD operation and validation checking).</p>




<i>Ready to revise code and add more features if necessary</i>
