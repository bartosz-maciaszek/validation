<?php

namespace Validation;

interface Visitor
{
    /**
     * @param Visitable $visitable
     */
    public function visit(Visitable $visitable);
}
