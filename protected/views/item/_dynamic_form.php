<?php

$parent_category_id=$categoryModel->parent_id;
$category_id=$categoryModel->id;
$category_code=$categoryModel->code;

switch($parentCategoryModel->code){
    
                    case 'work':
                        $model = new Work();
                        $model->status=Work::STATUS_ENABLED;
                        $model->salary="";
                        $model->currency=  ItemForm::CURRENCY_MANAT;
                        $this->renderPartial('//work/_item_form', array('model' => $model), false,false);

//                        if($category_code=='employees'){
//                            $model = new Employees();
//                            $model->status=Employees::STATUS_ENABLED;
//                            $model->salary="";
//                            $model->currency=  ItemForm::CURRENCY_MANAT;
//                            $this->renderPartial('//employees/_item_form', array('model' => $model), false,false);
//                        }elseif($category_code=='employers'){
//                            $model = new Employers();
//                            $model->salary="";
//                            $model->currency=  ItemForm::CURRENCY_MANAT;
//                            $model->status=Employers::STATUS_ENABLED;
//                            $this->renderPartial('//employers/_item_form', array('model' => $model),false,false);
//                        }
                    break;
                    
                    
                    
                    case 'auto':
                        $model = new Auto();
                        $model->status=Auto::STATUS_ENABLED;
                        $model->auto_condition= Auto::AUTO_CONDITION_OLD;
                        $model->odometer_unit = Auto::ODOMETER_KM;
                        $model->transmission = Auto::TRANSMISSION_MECHANIC;
                        $model->drivetrain = Auto::DRIVETRAIN_FRONT;
                        $model->currency = ItemForm::CURRENCY_MANAT;

                        $this->renderPartial('//auto/_item_form', array('model' => $model), false, false);
                    break;
                    
                
                
                    case 'estate':
                        $model = new Estates();
                        $model->status=Estates::STATUS_ENABLED;
                        $model->currency = ItemForm::CURRENCY_MANAT;
                        $model->price='';
                        
                        $this->renderPartial('//estates/_item_form', array('model' => $model),false,false);
                    break;
                
                
                
                
                    case 'advert':
                        $model = new Advert();
                        $model->status=  Advert::STATUS_ENABLED;
                        $model->currency = ItemForm::CURRENCY_MANAT;
                        $model->parent_category_id = $category_id;
                        $model->price = '';
                        $this->renderPartial('//advert/_item_form', array('model' => $model),false, false);
                    break;
                
                
                
                
                    default:
                        $model = new Catalog();
                        $model->status=  Catalog::STATUS_DISABLED;
                        $model->currency = ItemForm::CURRENCY_MANAT;
                        $model->parent_category_id = $category_id;
                        $model->price = '';
                        $this->renderPartial('//catalog/_item_form', array('model' => $model),false, false);
                }
?>