<?php

namespace Calendar\View\Helper;

use Cake\Chronos\Chronos;
use Cake\Chronos\ChronosInterface;
use Cake\View\Helper;
use Cake\View\View;

/**
 * Calendar helper
 */
class CalendarHelper extends Helper
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [
        'class' => 'table',
        'thClass' => 'table-header',
        'tdClass' => 'table-cell',
        'headers' => ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        'displayOtherMonth' => true,
    ];

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->_defaultConfig['innerHtml'] = function($date){
            return $date->day;
        };
    }


    /**
     * @param array $options
     * @return string String as complete table HTML
     */
    public function table($options = [])
    {
        $time = Chronos::today();

        $matrix = null;
        for ($day = $time->copy()->startOfMonth()->startOfWeek(), $i = 0; $day->lte($time->copy()->lastOfMonth()) || !$day->isMonday(); $i++, $day = $day->addDay()) {
            $matrix[intval($i/7)][$day->dayOfWeek] = $day->copy();
        }

        $options = $options + $this->_defaultConfig;
        $html = "<table class=\"{$options['class']}\">";
        $html .= "<thead><tr>";
        for ($i = 0; $i < 7; $i++) {
            $html .= "<th class=\"{$options['thClass']} ".$this->__generateDayOfWeekClass($i+1)."\">" . __($options['headers'][$i]) . "</th>";
        }
        $html .= "</tr></thead>";
        $html .= "<tbody>";
        for ($r = 0; $r < $time->endOfMonth()->weekOfMonth; $r++) {
            $html .= "<tr>";
            for ($c = 1; $c <= 7; $c++) {
                if($matrix[$r][$c]->month != $time->month){
                    if($options['displayOtherMonth']){
                        $html .= "<td class='".$options['tdClass']." is-anothermonth ".$this->__generateDayOfWeekClass($matrix[$r][$c]->dayOfWeek)."'>".$options['innerHtml']($matrix[$r][$c])."</td>";
                    } else {
                        $html .= "<td class='".$options['tdClass']." is-anothermonth ".$this->__generateDayOfWeekClass($matrix[$r][$c]->dayOfWeek)."'> </td>";
                    }
                } else {
                    $html .= "<td class='".$options['tdClass']." is-thismonth ".$this->__generateDayOfWeekClass($matrix[$r][$c]->dayOfWeek)."'>".$options['innerHtml']($matrix[$r][$c])."</td>";
                }
            }
            $html .= "</tr>";
        }
        $html .= "</tbody>";
        $html .= "</table>";
        return $html;
    }

    private function __generateDayOfWeekClass($dayOfWeekNumber){
        switch($dayOfWeekNumber){
            case 1:
                return "is-monday";
            case 2:
                return "is-tuesday";
            case 3:
                return "is-wednesday";
            case 4:
                return "is-thursday";
            case 5:
                return "is-friday";
            case 6:
                return "is-saturday";
            case 7:
                return "is-sunday";
        }
        return "";
    }
}
