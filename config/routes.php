<?php

Routes::root('welcome#index');
Routes::add('POST', 'welcome/signup', 'welcome#signup');
