<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
	<div>
		<h3> Разделов: <?=$arResult['ELEMENTS_COUNT'];?></h3>
	    <ul>
            <?php foreach ($arResult['ELEMENTS_BY_FIRMS'] as $firm => $elements):?>   
                <?php $info = '<b>' . $arResult['FIRMS'][$firm]['FIRM_NAME'] . '</b>';?>
                <li> <?=$info;?></li>   
                <?php foreach ($elements as $element):?>   
                        <ul>
                            <li> 
                                <a href="<?= $element['DETAIL_PAGE_URL']?>">
                                    <?php echo $element['NAME'] . ' - ' . $element['PROPERTY_PRICE_VALUE'] 
                                        . ' - ' . $element['PROPERTY_MATERIAL_VALUE'] . ' - ' . $element['PROPERTY_ARTNUMBER_VALUE'];
                                    ?>
                                </a>
                            </li>
                            
                        </ul>
                <?php endforeach;?>
            <?php endforeach;?>
	    </ul>
    </div>