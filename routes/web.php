<?php

Route::any('/{any?}', 'AppController@renderApp')->where('any', '^(?!api).*$');
