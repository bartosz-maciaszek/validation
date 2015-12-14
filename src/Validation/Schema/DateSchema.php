<?php

namespace Validation\Schema;

use Validation\Assertions;

class DateSchema extends AnySchema
{
    public function __construct()
    {
        $this->assert(new Assertions\IsDate());
    }

    /**
     * @param bool $convert
     * @return $this
     */
    public function dateTimeObject($convert = true)
    {
        $this->assert(new Assertions\DateTimeObject(['convert' => $convert]));

        return $this;
    }

    /**
     * @param $time
     * @return $this
     */
    public function after($time)
    {
        $this->assert(new Assertions\DateAfter(['time' => $time]));

        return $this;
    }

    /**
     * @param $time
     * @return $this
     */
    public function before($time)
    {
        $this->assert(new Assertions\DateBefore(['time' => $time]));

        return $this;
    }

    /**
     * @param $time1
     * @param $time2
     * @return $this
     */
    public function between($time1, $time2)
    {
        $this->assert(new Assertions\DateBetween(['time1' => $time1, 'time2' => $time2]));

        return $this;
    }
}
