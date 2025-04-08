<?php


use Illuminate\Support\Facades\Schedule;

Schedule::command('parser:run')->everyTenMinutes();
