<?php

namespace CodeEduUser\Annotations\Mapping;

/**
 * @Annotation
 * @Target("METHOD")
 */
class Action
{
    public $name;
    public $description;
}