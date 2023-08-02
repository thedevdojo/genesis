<?php

use function Livewire\Volt\{state};
 
state(['count' => 0]);

?>

<div>
    {{ $count }}
</div>
