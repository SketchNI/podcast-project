<?php

namespace App\Enums;

enum Publish: string
{
    case DRAFT = 'Draft';
    case PUBLISHED = 'Published';
    case ARCHIVED = 'Archived';
    case REMOVED = 'Removed';
}
