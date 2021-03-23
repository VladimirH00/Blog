<?php


class CreateAuthor extends Author
{
    public $passwordRepeat;
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        $rules = parent::rules();
        $rules = array_merge($rules, array(
            array('passwordRepeat', 'required'),
            array('passwordRepeat', 'length', 'max'=>255),
            array('passwordRepeat', 'length', 'min'=>4),
            array('passwordRepeat', 'compare', 'compareAttribute'=>'password'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('passwordRepeat', 'safe', 'on'=>'search'),
        ));

        return $rules;
    }
    public function attributeLabels()
    {
        $attributes = parent::attributeLabels();
        $attributes = array_merge($attributes,
            array('passwordRepeat'    =>  'Повторите пароль',));
        return $attributes;
    }
}