<?php

namespace SimpleTracker\Project;

class Project
{
    private $name;

    public static function named($name)
    {
        $project = new Project();
        $project->name = $name;

        return $project;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}
