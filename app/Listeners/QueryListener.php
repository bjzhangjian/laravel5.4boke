<?php
namespace App\Listeners;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
class QueryListener
{
/**
* Create the event listener.
*
* @return void
*/
public function __construct()
{
//
}

/**
* Handle the event.
*
* @param  QueryExecuted  $event
* @return void
*/
public function handle($event)
{
//
    $sql = str_replace("?", "'%s'", $event->sql);
    $log = vsprintf($sql, $event->bindings);
    Log::info($log);
}
} 