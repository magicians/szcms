<?php
/**
 * @author: mojifan [<https://github.com/mojifan>]
 */
namespace common\widgets;

use common\components\CategoryTree;
use yii;
use yii\helpers\Html;

class CategoryDropDownLists extends yii\bootstrap\Widget{

    public $model;
    public $attribute;
    public $options=[];
	public $optionsb=[];
	public $ainputStr;

    public $currentOptionDisabled=false;//当前选项是否禁止选择


    private $_categories=[];

    private $_inputStr;


    public function init(){

        parent::init();

        $this->options['encodeSpaces']=true;
        $this->options['prompt']='不选择';

        $categories=CategoryTree::getInstance()->getAllCategories();
        if(!empty($categories)){
            foreach($categories as $v){
                $tempArr=[];
                $tempArr[$v['id']]=str_repeat('    ',$v['depth']-1).$v['title'];
                $this->_categories+=$tempArr;

                if($this->currentOptionDisabled){
                    $model=$this->model;
                    $this->options['options'][$model->id]=['disabled' => true];
                }

            }
        }


        $this->_inputStr='<div class=" channel">';

        $this->_inputStr.=Html::activeLabel($this->model,$this->attribute,$this->options).$this->ainputStr;

        $this->_inputStr.=Html::activeDropDownList($this->model,$this->attribute,$this->_categories,$this->optionsb);

        $this->_inputStr.=' </div> </div>';


    }

    public function run(){


        return $this->_inputStr;


    }
}