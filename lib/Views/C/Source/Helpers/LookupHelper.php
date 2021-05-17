<?php

namespace Zend\Ext\Views\C\Source\Helpers;

use Zend\View\Helper\AbstractHelper;

use Zend\View\Renderer\PhpRenderer;


class LookupHelper extends AbstractHelper
{
    public function __invoke(PhpRenderer $renderer)
    {
        
        $properties = array();
        foreach($renderer->members as $property) {
            $properties[$property->name] = $property->type;
        }
        //var_dump($properties);
        // step one, groupe by length, group by first pattern, etc

        $this->nameFunction = $renderer->nameclassHelper($renderer->name);
        //$this->nameMacro = strtoupper($this->nameFunction);
        
        $this->index = $this->makeIndex($properties);


        $output = '';
        $group = $this->groupByLength($properties);

        $output .= 'const struct Php'.$renderer->camelcaseHelper($renderer->name).'Property*'.PHP_EOL;
        $output .= 'php_'.$this->nameFunction.'_properties_lookup (const char *str, size_t len)'.PHP_EOL;
        $output .= '{'.PHP_EOL;
        
        $glue = '    ';
        foreach($group as $ln=>$items) {
            $output .= $glue . 'if (len == '. $ln .') {'.PHP_EOL;
            
            $output .= $this->printGroup($items, 0, 2);
            
            $output .= '    }';
            $glue = ' else ';
        }

        $output .= PHP_EOL;
        $output .= '    return 0;'.PHP_EOL;
        $output .= '}'.PHP_EOL;

        return $output;
    }
    public function makeIndex(array $properties)
    {
        $index = [];
        $i=0;
        foreach ($properties as $property=>$type) {
            $index[$property] = $i++;
        }
        
        return $index;
    }
    public function groupByLength(array $properties)
    {
        $group = [];
        foreach ($properties as $property=>$type) {
            $len = strlen($property);
            if (isset($group[$len])) {
                $group[$len][] = $property;
            } else {
                $group[$len] = array($property);
            }
        }
        
        return $group;
    }

    public function printCondition($motif, $start)
    {
        $output = '';
        $glue = '';
        $max = 4;
        $n = 1;
        $ln = strlen($motif);
        for($i=0; $i<$ln; $i++, $n++) {
            $output .= $glue . 'str['.($start+$i).'] == \''. $motif[$i] .'\'';
            if ($n!=0 && $n%$max == 0 && $i<($ln-1)) {
                $output .= PHP_EOL.'        ';
            }
            $glue = ' && ';
        }
        return $output;
    }

    public function printCheck(string $item, $index, $indent)
    {
        $tab = '    ';
        $ws = str_repeat($tab, $indent);
        $output = '';
        $glue = '';
        $max = 4;
        $n = 1;
        $ln = strlen($item);
        for($i=$index; $i<$ln; $i++, $n++) {
            $output .= $glue . 'str['.$i.'] == \''. $item[$i] .'\'';
            if ($n!=0 && $n%$max == 0 && $i<($ln-1)) {
                $output .= PHP_EOL.$ws;
            }
            $glue = ' && ';
        }

        return $output;
    }

    public function printGroup($group, $index = 0, $indent=0)
    {
        $output = '';
        $tab = '    ';
        $ws = str_repeat($tab, $indent);
        $glue = $ws;
        foreach($group as $motif=>$items) {
            $ln = 0;
            $ln = strlen($motif);

            if (is_array($items)) {
                    $output .= $glue . 'if ('.$this->printCondition($motif, $index).') {'.PHP_EOL;
                    $output .= $this->printGroup($items, $index + $ln, $indent+1);
            } else {
                $output .= $glue.'if ('.$this->printCheck($items, $index, 2).') {'.PHP_EOL;
                //$output .= $ws.'    //'.$items.PHP_EOL;
                $output .= $ws.'    return &php_'.$this->nameFunction.'_properties['.$this->index[$items].'];'.PHP_EOL;
            }

            $output .= $ws.'}';
            $glue = ' else ';
        }
        $output .= PHP_EOL;
        /*
        $output .= ' else {'.PHP_EOL;
        $output .= $ws.'    // NOTFOUND'.PHP_EOL;
        $output .= $ws.'}'.PHP_EOL;
        */

        return $output;
    }

}
