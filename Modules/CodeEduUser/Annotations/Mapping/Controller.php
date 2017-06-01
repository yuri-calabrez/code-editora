<?php

namespace CodeEduUser\Annotations\Mapping;

/**
 * @Annotation
 * @Target("CLASS")
 */
class Controller
{
    public $name;
    public $description;
}