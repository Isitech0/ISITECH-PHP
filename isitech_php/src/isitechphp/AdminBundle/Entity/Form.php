<?php
namespace isitechphp\AdminBundle\Entity;

class Form
{
protected $form;
protected $idUser;

public function getForm()
{
return $this->form;
}
public function setForm($form)
{
$this->form = $form;
}
        public function getIdUser()
        {
            return $this->idUser;
        }
    public function setIdUser($id)
    {
        $this->idUser = $id;
    }
}