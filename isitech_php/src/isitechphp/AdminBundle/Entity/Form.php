<?php
namespace isitechphp\AdminBundle\Entity;

class Form
{
protected $form;

public function getForm()
{
return $this->form;
}
public function setForm($form)
{
$this->form = $form;
}
}