<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
	<div>
		<a href="<?=$arResult['LINK']?>"> Результат с фильтром </a>
	    <ul>
            <?php $elementsCount = 0;?>
            <?php foreach ($arResult['ELEMENTS_BY_FIRMS'] as $firm => $elements):?>   
                <?php $info = '<b>' . $arResult['FIRMS'][$firm]['FIRM_NAME'] . '</b>';?>
                <li> <?=$info;?></li>   
                <?php foreach ($elements as $element):?>   
                    <ul>
                    <?
                    $this->AddEditAction(
                        ++$elementsCount, 
                        $element["ADD_LINK"], 
                        CIBlock::GetArrayByID($element["IBLOCK_ID"], "ELEMENT_ADD")
                    );
                    $this->AddEditAction(
                        $elementsCount, 
                        $element["EDIT_LINK"], 
                        CIBlock::GetArrayByID($element["IBLOCK_ID"], "ELEMENT_EDIT")
                    );
	                $this->AddDeleteAction(
                        $elementsCount, 
                        $element["DELETE_LINK"], 
                        CIBlock::GetArrayByID($element["IBLOCK_ID"], "ELEMENT_DELETE"),
                        array("CONFIRM" => "Вы уверены?")
                    );
	                ?>
                    <div id="<?=$this->GetEditAreaId($elementsCount);?>">
                        <li> 
                            <?php echo $element['NAME'] . ' - ' . $element['PROPERTY_PRICE_VALUE'] 
                                . ' - ' . $element['PROPERTY_MATERIAL_VALUE'] . ' - ' . $element['PROPERTY_ARTNUMBER_VALUE'];
                            ?>
                            <a href="<?= $element['DETAIL_PAGE_URL']?>">
                                Перейти
                            </a>
                        </li>
                    </div>
                            
                    </ul>
                <?php endforeach;?>
            <?php endforeach;?>
	    </ul>
    </div>