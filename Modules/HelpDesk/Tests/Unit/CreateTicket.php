<?php
use Modules\HelpDesk\Entities\Ticket;


it('users can create a ticket', function(){
    Ticket::factory()->create();
});