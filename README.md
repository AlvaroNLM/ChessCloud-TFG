# ChessCloud

Final project fo my Computer Science degree following the **Laravel** (**MVC**) framework for the **chess** games managment.

In the following, I proceed to explain the main folders and files of the project.

app/
* Http/
    * **Controller**/ -> contains the **database connection** (**MySQL**) for each funcion inside each class (for example, the CRUD).
    * Middleware/     -> check the permissions.
* **Model** files for each **class** that extends it.
   

database/ -> database information like seeds (to create the db) and migrations.

public/
* css/ -> css configs that we applied in the different views. 
* js/  -> js functions that the project needs to work.

resources/
* **views**/ -> .blade.php files that show the view for the users. All of them extend ``../layouts/master.blade.php``.

**routes**/
* ``web.php``: here we verify the indexed routes and who can access (middlewares). Moreover, here we also **link the view with the controller**.

storage/ -> files generated after executing Laravel for each developer (that is why is empty)

test/
* Feature/ -> composer phpunit test applied

``ChessCloud.png`` -> project logo.
``server.php``     -> launch the project.