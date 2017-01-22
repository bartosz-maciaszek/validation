<?php

namespace Validation;

interface Visitable
{
    /**
     * @param Visitor $visitor
     */
    public function accept(Visitor $visitor);
}
