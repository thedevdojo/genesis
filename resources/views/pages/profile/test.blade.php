<?php

use function Livewire\Volt\{state};

state(['count' => 0]);

?>

<div>
    @volt
    {{ $count }}
    @endvolt
</div>
