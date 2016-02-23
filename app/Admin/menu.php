<?php

Admin::menu()->url('/')->label('Start page')->icon('fa-dashboard');
Admin::menu('BuildGrid\User')->label('Users')->icon('fa-user');
Admin::menu('BuildGrid\Boms')->label('Boms')->icon('fa-file-text');
Admin::menu()->url('files')->label('Files')->icon('fa-archive');
