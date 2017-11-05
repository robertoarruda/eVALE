<?php

namespace Nero\Evale\Traits;

trait DateTrait
{
    /**
     * @var \Carbon\Carbon
     */
    protected $carbon;

    /**
     * Retorna da data informada ou atual
     *
     * @param string $baseDate Data base
     * @param string $format Formato da data
     * @return \Carbon\Carbon
     */
    public function date(string $baseDate = '', string $format = 'Y-m-d')
    {
        if (empty($baseDate)) {
            return $this->carbon->now();
        }

        return $this->carbon->createFromFormat($format, $baseDate);
    }

    /**
     * Retorna o primeiro dia do mes informado ou atual
     *
     * @param string $baseDate Data base
     * @return \Carbon\Carbon
     */
    public function startOfMonth(string $baseDate = '')
    {
        return $this->date($baseDate)->startOfMonth();
    }

    /**
     * Retorna o ultimo dia do mes informado ou atual
     *
     * @param string $baseDate Data base
     * @return \Carbon\Carbon
     */
    public function endOfMonth(string $baseDate = '')
    {
        return $this->date($baseDate)->endOfMonth();
    }

    /**
     * Retorna dia informado ou o primeiro dia do mes atual
     *
     * @param string $date Data
     * @return \Carbon\Carbon
     */
    public function dateOrStartOfMonth(string $date = '')
    {
        if (!empty($date)) {
            return $this->date($date)->hour(0)->minute(0)->second(0);
        }

        return $this->startOfMonth();
    }

    /**
     * Retorna dia informado ou o ultimo dia do mes atual
     *
     * @param string $date Data
     * @return \Carbon\Carbon
     */
    public function dateOrEndOfMonth(string $date = '')
    {
        if (!empty($date)) {
            return $this->date($date)->hour(23)->minute(59)->second(59);
        }

        return $this->endOfMonth();
    }
}
