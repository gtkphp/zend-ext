<?php
/**
 * Zend Extension (https://github.com/Glash-Gnome)
 *
 * @link      https://github.com/Glash-Gnome/zend-ext for the canonical source repository
 * @copyright Copyright (c) 2021-2021 Glash. <5312910@php.net>
 * @license   GPL 3.0
 */

namespace Zend\Ext\Models;

use Zend\Ext\Models\ObjectGenerator;

class UnionGenerator extends ObjectGenerator
{
    /**
     * @var MemberGenerator[] Array of VarGenerator
     */
    public $members = [];

    public function setMembers(array $members):UnionGenerator {
        $this->members = $members;
        return $this;
    }

    public function getMembers():array {
        return $this->members;
    }

    static public function Create($data):UnionGenerator {
        $name = $data['name'];
        if(!empty($name) && $name[0]='_') $name = substr($name, 1);
        $this_union = new UnionGenerator($name);
        $members = array();
        foreach($data['members'] as $member) {
            switch ($member['type']) {
                case 'struct':
                    //$struct = StructGenerator::Create($member);
                    $struct = VarGenerator::Create($member);
                    //$struct->setType(TypeGenerator::Create($member));
                    $members[$member['name']] = $struct;
                    break;
                case 'union':
                    break;
                default:
                    //echo 'Unimplemented members' . PHP_EOL;
                    //TypeGenerator;
                    break;
            }
        }
        $this_union->members = $members;
        return $this_union;
    }

}
