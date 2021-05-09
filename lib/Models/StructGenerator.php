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

class StructGenerator extends ObjectGenerator
{
    /**
     * @var Array of VarGenerator
     */
    public $members = [];

    public function setName(string $name): AbstractGenerator
    {
        $this->name = $name;
        return $this;
    }
    public function setType(string $type): StructGenerator
    {
        // $type == 'struct'
        return $this;
    }

    public function setMembers(array $members): StructGenerator
    {
        $this->members = [];
        foreach($members as $var_name=>$member) {

            $this->addMember($member);
        }
        return $this;
    }
    public function addMember($member): StructGenerator
    {
        if (is_array($member)) {
            $package = $this->getOwnPackage();
            $var = $package->createVar($member['name']);
            $type = $package->createtype($member['type']);
            $var->setType($type);
            $this->members[$var->getName()] = $var;

        } else if ($member instanceof VarGenerator) {
            $this->members[$member->getName()] = $member;
        }
        return $this;
    }
    public function getMembers(): array
    {
        return $this->members;
    }

    static public function Create($data):StructGenerator {
        $name = $data['name'];
        if(!empty($name) && $name[0]='_') $name = substr($name, 1);
        $this_union = new StructGenerator($name);
        $members = array();
        foreach($data['members'] as $member_name=>$member) {
            switch ($member['type']) {
                case 'struct':
                    $members[$member_name] = StructGenerator::Create($member);
                    break;
                case 'union':
                    break;
                default:
                    $members[$member_name] = TypeGenerator::Create($member);
                    break;
            }
        }
        $this_union->members = $members;
        return $this_union;
    }

}
