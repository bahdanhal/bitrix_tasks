<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
	<div>
		<h3> Разделов: <?=$arResult['ELEMENTS_COUNT'];?></h3>
	    <ul>
            <?php foreach ($arResult as $key => $firm):?>   
                <?php if ($key == 'ELEMENTS_COUNT'):?>
                    <?php continue;?>
                <?php endif;?>
                <?php $info = '<b>' . $firm['FIRM_NAME'] . '</b>';?>
                <li> <?=$info;?></li>   
                <?php foreach ($firm['ELEMENTS'] as $element):?>   
                        <ul>
                            <li> 
                                <?php echo $element['NAME'] . ' - ' . $element['PROPERTY_PRICE_VALUE'] . ' - ' . $element['PROPERTY_MATERIAL_VALUE'] . ' - ' . $element['PROPERTY_ARTNUMBER_VALUE'];?>
                            </li>
                        </ul>
                <?php endforeach;?>
            <?php endforeach;?>
	    </ul>
    </div>