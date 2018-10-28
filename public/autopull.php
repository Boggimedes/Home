<?php
$pullResponse = `git pull 2>&1`;

// $migrateResponse = `php ../artisan migrate:fresh --seed`;

echo '<h2>Pull Responsse: </h2><pre>'.$pullResponse.'</pre>';
// echo '<pre>'.$migrateResponse.'</pre>';
