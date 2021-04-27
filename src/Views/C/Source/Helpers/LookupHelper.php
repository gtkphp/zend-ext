<?php

namespace Zend\Ext\Views\C\Source\Helpers;

use Zend\View\Helper\AbstractHelper;

use Zend\View\Renderer\PhpRenderer;


class LookupHelper extends AbstractHelper
{
    public function __invoke(PhpRenderer $renderer)
    {
        $properties = $renderer->properties;
        // step one, groupe by length, group by first pattern, etc
        array(
            'aaaa',
            'baaa',
            'bbaa',
            'bbaaaaa',
            'caaaaaaaa',
        );
        $this->nameFunction = $renderer->nameFunction;
        $this->index = $this->makeIndex($properties);


        $output = '';
        $group = $this->groupByLength($properties);

        $output .= 'const struct Php'.$renderer->nameType.'Property*'.PHP_EOL;
        $output .= 'php_'.$renderer->nameFunction.'_properties_lookup (const char *str, size_t len)'.PHP_EOL;
        $output .= '{'.PHP_EOL;
        
        $glue = '    ';
        foreach($group as $ln=>$items) {
            $output .= $glue . 'if (len == '. $ln .') {'.PHP_EOL;

$output .= '        //case: "'.join('", "', $items).'"'.PHP_EOL;
$output .= $this->printGroupByChar($this->groupByChar($items, 0));

            $output .= '    }';
            $glue = ' else ';
        }
        $output .= ' else {'.PHP_EOL;
        $output .= '        // NOTFOUND'.PHP_EOL;
        $output .= '    }'.PHP_EOL;


        $output .= '    return 0;'.PHP_EOL;
        $output .= '}'.PHP_EOL;
        return $output;//'//TODO'.count($renderer->nameFunction).PHP_EOL;
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
    // Group by nth letter
    public function groupByChar(array $properties, $index)
    {
        $tab = '        ';
        $group = [];
        foreach ($properties as $property) {
            if (empty($property)) {
                var_dump($property);
                echo 'property is null'.PHP_EOL;
                continue;
            }
            $c = $property[$index];
            if (isset($group[$c])) {
                $group[$c][] = $property;
            } else {
                $group[$c] = array($property);
            }
        }
        
        return $group;
    }
    public function printGroupByChar(array $group/*, $tab*/)
    {
        $output = '';
        $tab = '        ';
        $glue = $tab;
        foreach($group as $c=>$items) {
            $num = count($items);
            // if one
            $output .= $glue . 'if ('.$this->printCheck($items[0], 0) .') {'.PHP_EOL;
            
                //$output .= $glue . 'if (str[0] == \''. $c .'\') {'.PHP_EOL;
            // else redo a group

            $output .= $tab.'    //case: "'.join('", "', $items).'"'.PHP_EOL;
            $output .= $tab.'    return &php_'.$this->nameFunction.'_properties['.$this->index[$items[0]].'];'.PHP_EOL;


            $output .= $tab.'}';
            $glue = ' else ';
        }
        $output .= ' else {'.PHP_EOL;
        $output .= $tab.'    // NOTFOUND'.PHP_EOL;
        $output .= $tab.'}'.PHP_EOL;

        
        return $output;
    }

    public function printCheck(string $item, $index)
    {
        $output = '';
        $glue = '';
        $max = 4;
        $n = 1;
        for($i=$index; $i<strlen($item); $i++, $n++) {
            $output .= $glue . 'str['.$i.'] == \''. $item[$i] .'\'';
            if ($n!=0 && $n%$max == 0) {
                $output .= PHP_EOL.'        ';
            }
            $glue = ' && ';
        }
        return $output;
    }
}
