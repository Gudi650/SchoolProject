<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Teacher;
use App\Models\AssignedRole;

foreach (Teacher::all() as $t) {
    $roles = AssignedRole::where('teacher_id', $t->id)->with('teacherRole')->get();
    echo "Teacher {$t->id} ({$t->fname}) user_id={$t->user_id}\n";
    foreach ($roles as $r) {
        echo "  role: {$r->teacherRole?->name} class_id={$r->{'class-available_id'}}\n";
    }
}
