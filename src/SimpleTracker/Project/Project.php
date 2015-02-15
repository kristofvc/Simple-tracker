<?php

namespace SimpleTracker\Project;

class Project
{
    private $name;
    private $slug;

    public static function named($name)
    {
        $project = new Project();
        $project->name = $name;
        $project->slug = $project->getSlug();

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

    public function getSlug()
    {
        return strtolower(str_replace(' ', '-', $this->name));
    }
}
